<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Passenger
 *
 * @property int                          $id
 * @property int                          $reservee_id
 * @property int                          $reservation_id
 * @property string                       $name
 * @property int|null                     $age
 * @property string|null                  $nationality
 * @property int|null                     $reduction_id
 * @property bool|null                    $wheelchair
 * @property float|null                   $price
 * @property float|null                   $taxes
 * @property float|null                   $reductions
 * @property bool                         $approved Pre approved by Vessel Operator
 * @property bool                         $departed By cashier, person has departed
 * @property int|null                     $user_id Cashier who approved boarding
 * @property Carbon|null                  $created_at
 * @property Carbon|null                  $updated_at
 * @property Carbon|null                  $deleted_at
 * @property-read User|null               $employee
 * @property-read Collection|Permission[] $permissions
 * @property-read Reduction|null          $reduction
 * @property-read Reservation             $reservation
 * @property-read Reservee                $reservee
 * @property-read Collection|Role[]       $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger newQuery()
 * @method static Builder|Passenger onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereDeparted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereReductionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereReductions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereReserveeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passenger whereWheelchair($value)
 * @method static Builder|Passenger withTrashed()
 * @method static Builder|Passenger withoutTrashed()
 * @mixin Eloquent
 */
class Passenger extends Model
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
        'name',
        'age',
        'nationality',
        'reduction_id',
        'wheelchair,',
        'price',
        'taxes',
        'reductions',
        'approved',
        'departed',
        'user_id', //the Operator worker who has boarded the person
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
        'wheelchair' => 'boolean',
        'approved'   => 'boolean',
        'departed'   => 'boolean',
        'price'      => 'float',
        'taxes'      => 'float',
        'reductions' => 'float',
    ];
    /**
     * For use of Laravel-permission, the package from spatie
     */
    protected $guard_name = 'web';

    /**
     * a passenger belongs to a reservee
     *
     * @return BelongsTo Reservee
     */
    public function reservee()
    {
        return $this->belongsTo(Reservee::class);
    }

    /**
     * a passenger belongs to a reservation
     *
     * @return BelongsTo Reservation
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * a passenger belongs to reduction
     *
     * @return BelongsTo Reduction
     */
    public function reduction()
    {
        return $this->belongsTo(Reduction::class);
    }

    /**
     * a passenger has been approved/boarded by an Operator employee
     *
     * @return BelongsTo Reservee
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
