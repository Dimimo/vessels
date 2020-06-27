<?php
//from https://stackoverflow.com/questions/24224175/logging-user-actions-in-laravel
namespace App\functions;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

function LogSystem($table, $action, $custom = null)
{
    $table::$action(function ($service) use ($action, $custom) {
        if (!is_null($custom)) {
            $url = '/panel/' . $custom . '/' . $service->id . '/edit';
        } else {
            $url = Request::fullUrl();
        }
        DB::table('log_activity')->insert([
            'subject' => $action . '::==' . $service->title,
            'url'     => $url,
            'method'  => Request::method(),
            'agent'   => Request::header('user-agent'),
            'ip'      => Request::ip(),
            'user_id' => Auth::check() ? Auth::user()->id : null,
        ]);
//
    });
}
