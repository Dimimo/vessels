<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Port;
use App\User;
use App\Vessel;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Schema;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var $model_name Port|Vessel
     */
    private $model_name;

    /**
     * @var $model Port|Vessel
     */
    private $model;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var array $data
     */
    private $data;

    /**
     * @var string $route
     */
    private $route;

    /**
     * @var string $reason
     */
    private $reason;

    /**
     * @var array $message
     */
    private $message;

    /**
     * @var bool $error
     */
    private $error = false;

    /**
     * UserController constructor
     *
     * @param Request $request
     * @return Response
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        if ($this->request->has('model_id')) {
            try {
                $this->id = decrypt($this->request->get('model_id'));
            } catch (DecryptException $e) {
                return back()->with(['error' => $e->getMessage()])->withInput();
            }
        }
        //prepare the model
        if ($this->request->has('model')) {
            try {
                $this->model_name = "\App\\" . decrypt($this->request->get('model'));
            } catch (DecryptException $e) {
                return back()->with(['error' => $e->getMessage()])->withInput();
            }
            $this->model = $this->model_name::findOrFail($this->id);
        }
        //figure out the reason (fex 'is_port_authority'
        if ($this->request->has('reason')) {
            try {
                $this->reason = decrypt($this->request->get('reason'));
            } catch (DecryptException $e) {
                return back()->with(['error' => $e->getMessage()])->withInput();
            }
        }
        //switch to the correct user creation function
        /*if ($this->request->has('new') && $this->request->get('new') === 'true') {
            $this->redirect();
        }*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!$this->request->session()->has('new_user')) {
            return redirect()->back()->with(['error' => 'Something went wrong, please try again!']);
        }
        $keys     = $this->request->session()->get('new_user');
        $reason   = $keys['reason'];
        $model    = $keys['model'];
        $model_id = $keys['model_id'];

        switch ($reason) {
            case 'is_port_authority':
                $port  = Port::findOrFail($model_id);
                $title = "Add a new user as a <u>Port Authority</u> of <strong>{$port->name}</strong> in {$port->city_name}";
                $model = 'Port';
                break;
        }

        return view('user.add_user', compact('title', 'reason', 'model', 'model_id'));
    }

    /**
     * Store a newly created Port in storage.
     *
     * @param StoreUser $request
     * @return Response
     */
    public function store(StoreUser $request)
    {
        $this->data = $request->validated();
        switch ($this->reason) {
            case 'is_port_authority':
                $this->addPortAuthority();
                break;

            default:
                $this->error = true;
        }
    }

    /**
     * Add a new user as a Port Authority
     */
    private function addPortAuthority()
    {
        $this->data                      = $this->request->all();
        $this->data['is_port_authority'] = true;
        $data                            = $this->prepareData();
        $user                            = User::create($data);
        $user->ports()->attach($this->model->id);

        // @TODO send out an email with an event

        $this->route   = 'port.users';
        $this->message = ['success' => 'The Port Authority account for <strong>' . $user->name . '</strong> is created!'];
    }

    /**
     * Prepare the data to add a new user.
     *
     * @return array
     */
    private function prepareData()
    {
        $password = bin2hex(openssl_random_pseudo_bytes(4)); //create random password 8 chars long
        return ['name'                 => $this->data['name'],
                'email'                => $this->data['email'],
                'password'             => Hash::make($password),
                'real_password'        => $password,
                'contact_nr'           => isset($this->data['contact_nr']) ? $this->data['contact_nr'] : null,
                'contact_name'         => isset($this->data['contact_name']) ? $this->data['contact_name'] : null,
                'is_super_admin'       => (isset($this->data['is_super_admin']) && $this->data['is_super_admin'] = true) ? true : false,
                'is_admin_admin'       => (isset($this->data['is_admin']) && $this->data['is_admin'] = true) ? true : false,
                'is_statistical'       => (isset($this->data['is_statistical']) && $this->data['is_statistical'] = true) ? true : false,
                'is_editor'            => (isset($this->data['is_editor']) && $this->data['is_editor'] = true) ? true : false,
                'is_port_authority'    => (isset($this->data['is_port_authority']) && $this->data['is_port_authority'] = true) ? true : false,
                'is_operator'          => (isset($this->data['is_operator']) && $this->data['is_operator'] = true) ? true : false,
                'is_operator_employee' => (isset($this->data['is_operator_employee']) && $this->data['is_operator_employee'] = true) ? true : false,
                'is_agent'             => (isset($this->data['is_agent']) && $this->data['is_agent'] = true) ? true : false,
                'is_captain'           => (isset($this->data['is_captain']) && $this->data['is_captain'] = true) ? true : false,
        ];
    }

    /**
     * Redirect the newly stored user to the right page
     *
     * @return Response
     */
    public function redirect()
    {
        if ($this->error == true) {
            return redirect()->back()->withInput()->with(['error' => 'Something went wrong when trying to add a user']);
        }
        return redirect()->route($this->route)->with($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User    $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Add a user as a specific speciality, for ex is_port_authority
     *
     * @return Factory|View
     */
    public function addUser()
    {
        $this->request->session()->put('new_user', ['reason' => $this->reason, 'model' => $this->model, 'model_id' => $this->id]);

        return redirect()->action('UserController@create');
    }

    /**
     * return a list with the user flags and the appropriate names (dynamic)
     *
     * @return array|null
     */
    private function getFlags()
    {
        $columns = Schema::getColumnListing('users');
        $flags   = array_flip(
            array_filter($columns, function ($f) {
                if (substr($f, 0, 3) === 'is_') {
                    return $f;
                }
            })
        );
        foreach ($flags as $flag => $studly) {
            $flags[$flag] = ucwords(str_replace('_', ' ', substr($flag, 3)));
        }

        return $flags;
    }
}
