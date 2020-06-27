<?php

namespace App\Http\Controllers\Admin;

use App\Events\RecreateCityList;
use Illuminate\Http\JsonResponse;

/**
 * Trait UpdatesTrait
 *
 * @package App\Http\Controllers\Admin
 */
trait UpdatesTrait
{
    /**
     * @return JsonResponse
     */
    public function cityListUpdate()
    {
        event(new RecreateCityList());

        return response()->json(['type' => 'success']);
    }
}
