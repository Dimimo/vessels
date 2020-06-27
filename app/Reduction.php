<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Reduction
 *
 * @property int                          $id
 * @property string                       $name
 * @property int|null                     $percentage
 * @property float|null                   $value
 * @property int|null                     $max_age
 * @property int|null                     $min_age
 * @property string|null                  $remark
 * @property int|null                     $issued_by Admin who created the reduction
 * @property bool                         $optional Some taxes are optional, fex disability or locals
 * @property bool                         $global Global means the tax is not port relative, fex BIR
 * @property Carbon|null                  $created_at
 * @property Carbon|null                  $updated_at
 * @property Carbon|null                  $deleted_at
 * @property-read User                    $admin
 * @property-read Collection|Passenger[]  $passengers
 * @property-read Collection|Permission[] $permissions
 * @property-read Collection|Role[]       $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction newQuery()
 * @method static Builder|Reduction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereIssuedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereOptional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reduction whereValue($value)
 * @method static Builder|Reduction withTrashed()
 * @method static Builder|Reduction withoutTrashed()
 * @mixin Eloquent
 */
class Reduction extends Model
{
    use SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'percentage',
        'value',
        'max_age',
        'Min_age',
        'remark',
        'issued_by',
        'optional',
        'global',
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
        'value' => 'float', 'optional' => 'boolean', 'global' => 'boolean'
    ];
    /**
     * For use of Laravel-permission, the package from spatie
     */
    protected $guard_name = 'web';

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

    /**
     * a reduction has many passengers
     *
     * @return HasMany Passenger
     */
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    /**
     * a reduction has been created by an admin
     *
     * @return BelongsTo Reservee
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
