<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePort;
use App\Http\Requests\UpdatePort;
use App\Operator;
use App\Port;
use App\User;
use Auth;
use exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class PortController
 * @package App\Http\Controllers
 */
class PortController extends Controller
{
    /**
     * PortController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ports = Port::with('city')->get()->sortBy('name');

        return view('port.index', compact('ports'));
    }

    /**
     * Show the form for creating a new Port.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('port.create');
    }

    /**
     * Store a newly created Port in storage.
     *
     * @param StorePort $request
     * @return Response
     */
    public function store(StorePort $request)
    {
        $port = new Port($request->validated());
        $port->save();

        return redirect()->route('port.show', [$port->id])->with(['success' => 'The Port ' . $port->name . ' has been added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @param string  $slug
     * @return Response
     */
    public function show($id, $slug = null)
    {
        $port = Port::with(['city', 'operators' => function ($q) {
            return $q->orderBy('name');
        }])->findOrFail($id);

        return view('port.show', compact('port', 'slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     * @param string  $slug
     * @return Response
     */
    public function edit($id, $slug = null)
    {
        $port = Port::findOrFail($id);

        return view('port.update', compact('port', 'slug'));
    }

    /**
     * Update the specified Port in storage.
     *
     * @param UpdatePort $request
     * @param Port       $port
     * @return Response
     */
    public function update(UpdatePort $request, Port $port)
    {
        $port = $port::findOrFail($request->get('id'));
        $port->update($request->validated());

        return redirect()->route('port.show', [$port->id, $port->slug])->with(['success' => $port->name . ' has been updated!']);
    }

    /**
     * Remove the specified Port from storage.
     *
     * @param integer $id
     * @return Response
     * @throws exception
     */
    public function destroy($id)
    {
        $port = Port::with('operators')->findOrFail($id);
        if ($port->operators->count() > 0) {
            return back()->with(['warning' => $port->name . " can't be deleted, this Port still has operators!"]);
        }
        $port->admins()->detach();
        $port->taxes()->delete();
        $port->delete();

        return redirect()->route('port.index')->with(['success' => $port->name . " has been deleted!"]);
    }

    /**
     * This is a complex page where anybody with the right access can:
     * - edit port authority access
     * - edit vessel operators to and from this Port
     *
     * @return Factory|View
     */
    public function users()
    {
        if (Auth::user()->hasRole('port authority')) {
            $ports = Auth::user()->ports()->with(['city', 'operators' => function ($q) {
                return $q->where('is_port_authority', true)->with('city')->orderBy('name');
            }])->orderBy('name')->get();
        } else {
            $ports = Port::with(['admins' => function ($q) {
                return $q->with('city')->orderBy('name');
            }, 'operators'                => function ($q) {
                return $q->with('city')->orderBy('name');
            }, 'city'])->orderBy('name')->get();
        }

        $admins    = User::whereIsPortAuthority(true)->with(['city', 'ports' => function ($q) {
            return $q->orderBy('name');
        }])->orderBy('name')->get();
        $operators = Operator::with(['city', 'ports' => function ($q) {
            return $q->orderBy('name');
        }])->orderBy('name')->get();

        return view('port.users', compact('ports', 'admins', 'operators'));
    }

    /**
     * Sync the administrators of a Port
     *
     * @param Request $request
     * @return $this
     */
    public function portAdmins(Request $request)
    {
        $port = Port::findOrFail($request->get('port_id'));
        if (!$request->has('admin')) {
            return back()->with(['error' => "You can't disconnect all users with Port Authority to {$port->name}! At least one person needs access."]);
        }
        $admins = array_keys($request->get('admin'));
        $port->admins()->sync($admins);

        return redirect()->route('port.users')->with(['success' => 'The Port Authorities for ' . $port->name . ' has been updated.']);
    }

    /**
     * Sync the operators of a Port
     *
     * @param Request $request
     * @return $this
     */
    public function portOperators(Request $request)
    {
        $port = Port::findOrFail($request->get('port_id'));
        $ids  = $request->get('operator');
        if ($ids) {
            $operators = array_keys($request->get('operator'));
            $port->operators()->sync($operators);
        } else {
            $port->operators()->detach();
        }

        return redirect()->route('port.users')->with(['success' => 'The Operators for ' . $port->name . ' has been updated.']);
    }

    /**
     * Add a user as a Port Administrator to an existing port
     *
     * @param Request $request
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function addUser(Request $request)
    {
        $model = "\App\\" . decrypt($request->get('model'));
        $model = $model::findOrFail(decrypt($request->get('model_id')));
        $this->authorize('update', $model);
        $reason = decrypt($request->get('reason'));
        $title  = "Add a new user as a Port Authority of <strong>{$model->name}</strong> in {$model->city_name}";

        return view('user.add_user', compact('title', 'model', 'reason'));
    }
}
