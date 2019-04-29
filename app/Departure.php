<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Departure
 *
 * @property int                             $id
 * @property int                             $vessel_id
 * @property int                             $captain_id
 * @property \Illuminate\Support\Carbon      $departure
 * @property int                             $from_port_id
 * @property int                             $to_port_id
 * @property string|null                     $travel_time
 * @property bool                            $cancelled
 * @property string|null                     $reason
 * @property int|null                        $passengers
 * @property \Illuminate\Support\Carbon|null $real_departure
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Captain               $captain
 * @property-read \App\Port                  $from_port
 * @property-read \App\Port                  $to_port
 * @property-read \App\Vessel                $vessel
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Departure onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereFromPortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure wherePassengers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereRealDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereToPortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereTravelTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Departure whereVesselId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Departure withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Departure withoutTrashed()
 * @mixin \Eloquent
 */
class Departure extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vessel_id',
        'captain_id',
        'departure',
        'nickname',
        'from_port_id',
        'to_port_id',
        'travel_time,',
        'cancelled',
        'reason',
        'real_departure',
        'passengers',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'vessel_id'      => 'integer',
        'captain_id'     => 'integer',
        'departure'      => 'datetime',
        'from_port_id'   => 'integer',
        'to_port_id'     => 'integer',
        'in_service'     => 'boolean',
        'cancelled'      => 'boolean',
        'real_departure' => 'datetime',
        'passengers'     => 'integer',
    ];

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/
    /**
     * a departure belongs to a vessel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Vessel
     */
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    /**
     * a departure belongs to a captain
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Captain
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }

    /**
     * a departure belongs to a port of departure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Vessel
     */
    public function from_port()
    {
        return $this->belongsTo(Port::class, 'from_port_id');
    }

    /**
     * a departure belongs to a port of arrivals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Vessel
     */
    public function to_port()
    {
        return $this->belongsTo(Port::class, 'to_port_id');
    }
}
