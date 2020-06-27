<?php
/**
 * Copyright (c) 2017. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 * Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 */

namespace App\Listeners;

use App\City;
use App\Events\RecreateCityList;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;

/**
 * Class RecreateListForAutoComplete
 *
 * @package App\Listeners
 */
class RecreateListForAutoComplete implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param RecreateCityList $event
     *
     * @return void
     */
    public function handle(RecreateCityList $event)
    {
        //if (File::exists($event->fileLocation)) return 'yes'; else return 'no';
        if (!File::isWritable($event->fileLocation)) {
            File::chmod($event->fileLocation, 757);
        }
        //$cityList = sprintf('<script>%s</script>', City::cityListForAutoComplete());
        File::put($event->fileLocation, City::cityListForAutoComplete(), true);
    }

    /**
     *
     */
    public function __destruct()
    {
        //
    }
}
