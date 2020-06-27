<?php

namespace App\Providers;

use App\Events\RecreateCityList;
use App\Listeners\RecreateListForAutoComplete;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class       => [SendEmailVerificationNotification::class],
        //recreate the js city list for auto complete
        RecreateCityList::class => [RecreateListForAutoComplete::class],
        //registrations by admins, PA's or Operator

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
