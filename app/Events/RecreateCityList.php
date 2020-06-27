<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class RecreateCityList
 *
 * @package App\Events
 */
class RecreateCityList
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var $fileLocation string
     */
    public $fileLocation;

    /**
     * Create a new event instance.
     *
     */
    public function __construct()
    {
        $this->fileLocation = storage_path('app/public') . '/cities.js';
    }
}
