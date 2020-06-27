<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\UpdatesTrait;
use App\User;
use Artisan;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Parsedown;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    use UpdatesTrait;

    /**
     * @var Request
     */
    private $request;

    /**
     * AdminController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $users = User::with(['ports', 'operators', 'captain'])->get()->sortBy('name');

        return view('admin.index', compact('users'));
    }

    /**
     * The page for updates and tasks
     *
     * @return Factory|View
     */
    public function updates()
    {
        return view('admin.updates');
    }

    /**
     * Shows the detailed user permissions by group (roles)
     * This is a markdown page from the php artisan permission:show command
     *
     * @return Factory|View
     * @throws Throwable
     */
    public function permissionsList()
    {
        //get and clean the list directly from the artisan command
        if (!Artisan::call('permission:show web')) {
            $page  = Artisan::output();
            $page  = str_replace(['+', '·', "Guard: web\r\n"], ['|', '', null], $page);
            $page  = nl2br($page);
            $lines = explode('<br />', $page);
            array_shift($lines);
            array_pop($lines);
            array_pop($lines);
            $page         = implode('', $lines);
            $message      = "Data is from the database";
            $message_type = 'success';
        } else {
            $page         = view('admin.permissions_markup')->render();
            $message      = "Data coming from the static MarkDown page!!!!";
            $message_type = 'warning';
        }
        //parse the MarkDown text and send it to the view
        $parseDown = new Parsedown();
        $parseDown->setMarkupEscaped(true);
        $table = $parseDown->parse($page);
        //permissions and roles are needed to know the cell that is clicked in the table
        $permissions = Permission::all()->sortBy('name')->pluck('id', 'name')->toJson();
        $roles       = Role::all()->sortBy('name')->pluck('name');
        //flash the source of the table data
        $this->request->session()->flash($message_type, $message);

        return view('admin.permissions', compact('table', 'permissions', 'roles'));
    }

    /**
     * This is an AJAX call from the user permissions table. It changes the setting of a role and permission relation.
     *
     * @return string
     */
    public function permissionChange()
    {
        $data = $this->request->all();
        unset($data['_token']);
        $arr                = explode('_', $data['id']);
        $permissions        = Permission::all()->sortBy('name')->pluck('name', 'id');
        $roles              = Role::all()->sortBy('name')->pluck('name');//return json_encode($roles);
        $data['permission'] = $permissions[$arr[1]];
        $data['role']       = $roles[$arr[2]];
        $role               = Role::findByName($data['role']);

        //first check if there are admin changes, only super admins have access to this
        if (strstr($data['permission'], 'admin')) {
            if (!Auth::user()->hasRole('super admin')) {
                $data['error'] = 'Only super administrators can edit this permission';
            } else {
                if ($data['val'] === '1') {
                    $role->revokePermissionTo($data['permission']);
                    $data['val'] = '0';
                } else {
                    $role->givePermissionTo($data['permission']);
                    $data['val'] = '1';
                }
            }
        } //check all other requests
        else if ($data['val'] === '1') {
            $role->revokePermissionTo($data['permission']);
            $data['val'] = '0';
        } else {
            $role->givePermissionTo($data['permission']);
            $data['val'] = '1';
        }

        return json_encode($data);
    }
}
