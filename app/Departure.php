<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Departure
 *
 * @property int                           $id
 * @property int                           $vessel_id
 * @property int                           $captain_id
 * @property Carbon                        $departure
 * @property int                           $from_port_id
 * @property int                           $to_port_id
 * @property string|null                   $travel_time
 * @property bool                          $cancelled
 * @property string|null                   $reason
 * @property string|null                   $official_info
 * @property int|null                      $passengers
 * @property Carbon|null                   $real_departure
 * @property float                         $price
 * @property Carbon|null                   $created_at
 * @property Carbon|null                   $updated_at
 * @property Carbon|null                   $deleted_at
 * @property-read Captain                  $captain
 * @property-read Port                     $from_port
 * @property-read Collection|Reservation[] $reservations
 * @property-read Collection|Tax[]         $taxes
 * @property-read Port                     $to_port
 * @property-read Vessel                   $vessel
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Departure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departure newQuery()
 * @method static Builder|Departure onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Departure query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereCancelled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereFromPortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereOfficialInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure wherePassengers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereRealDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereToPortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereTravelTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departure whereVesselId($value)
 * @method static Builder|Departure withTrashed()
 * @method static Builder|Departure withoutTrashed()
 * @mixin Eloquent
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
        'price',
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
        'price'          => 'float',
    ];

    /**
     * The attributes that should be mutated to Carbon dates.
     *
     * @var array
     */
    protected $dates = [
        'departure',
        'real_departure',
    ];

    /**
     * Scope a query to only include the schedule of today
     *
     * @return boolean
     */
    public function today()
    {
        return $this->departure->isToday();
    }

    /**
     * Scope a query to only include the schedule in the future
     *
     * @return boolean
     */
    public function future()
    {
        return $this->departure->isFuture();
    }

    /**
     * Scope a query to only include the schedule in the past
     *
     * @return boolean
     */
    public function past()
    {
        return $this->departure->isPast();
    }


    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/
    /**
     * a departure belongs to a vessel
     *
     * @return BelongsTo Vessel
     */
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }

    /**
     * a departure belongs to a captain
     *
     * @return BelongsTo Captain
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }

    /**
     * a departure belongs to a port of departure
     *
     * @return BelongsTo Vessel
     */
    public function from_port()
    {
        return $this->belongsTo(Port::class, 'from_port_id');
    }

    /**
     * a departure belongs to a port of arrivals
     *
     * @return BelongsTo Vessel
     */
    public function to_port()
    {
        return $this->belongsTo(Port::class, 'to_port_id');
    }

    /**
     * a departure has many reservations
     *
     * @return HasMany Reservation
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * a departure has one operator through the vessel
     *
     * @return HasOneThrough Reservation
     */
    public function operator()
    {
        return $this->hasOneThrough(Operator::class, Vessel::class);
    }

    /**
     * a port has many possible taxes
     *
     * @return BelongsToMany Tax
     */
    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'departure_tax', 'departure_id', 'tax_id');
    }
}
