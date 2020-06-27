<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Reservation
 *
 * @property int                          $id
 * @property int                          $reservee_id
 * @property int                          $departure_id
 * @property int                          $operator_id
 * @property bool                         $confirmed By Reservee
 * @property int|null                     $confirmed_at
 * @property bool                         $accepted By Operator
 * @property int|null                     $accepted_at By Operator
 * @property bool                         $departed By cashier
 * @property int|null                     $departed_at By cashier, physically in the port, ready to embark
 * @property float|null                   $total_price
 * @property float|null                   $total_taxes
 * @property float|null                   $total_reductions
 * @property string|null                  $reservee_remark
 * @property string|null                  $operator_remark
 * @property Carbon|null                  $created_at
 * @property Carbon|null                  $updated_at
 * @property Carbon|null                  $deleted_at
 * @property-read Departure               $departure
 * @property-read Operator                $operator
 * @property-read Collection|Passenger[]  $passengers
 * @property-read Collection|Permission[] $permissions
 * @property-read Reservee                $reservee
 * @property-read Collection|Role[]       $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static Builder|Reservation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDeparted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDepartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereDepartureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereOperatorRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReserveeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReserveeRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalReductions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTotalTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 * @method static Builder|Reservation withTrashed()
 * @method static Builder|Reservation withoutTrashed()
 * @mixin Eloquent
 */
class Reservation extends Model
{
    use SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reservee_id',
        'departure_id',
        'operator_id',
        'confirmed',
        'confirmed_at',
        'accepted',
        'accepted_at',
        'departed',
        'departed_at',
        'total_price,',
        'total_taxes',
        'total_reductions',
        'reservee_remark',
        'operator_remark',
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
        'confirmed'        => 'boolean',
        'confirmed_at'     => 'timestamp',
        'accepted'         => 'boolean',
        'accepted_at'      => 'timestamp',
        'departed'         => 'boolean',
        'departed_at'      => 'timestamp',
        'total_price'      => 'float',
        'total_taxes'      => 'float',
        'total_reductions' => 'float',
    ];

    /**
     * For use of Laravel-permission, the package from spatie
     */
    protected $guard_name = 'web';

    /**
     * a reservation belongs to a reservee
     *
     * @return BelongsTo Reservee
     */
    public function reservee()
    {
        return $this->belongsTo(Reservee::class);
    }

    /**
     * a reservation belongs to a departure
     *
     * @return BelongsTo Departure
     */
    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    /**
     * a reservation belongs to an Operator
     *
     * @return BelongsTo Operator
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * a reservation has one vessel through a reservation
     *
     * @return HasOneThrough Reservation
     */
    public function vessel()
    {
        return $this->hasOneThrough(Vessel::class, Reservation::class);
    }

    /**
     * a reservation has many passengers
     *
     * @return HasMany Passenger
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
