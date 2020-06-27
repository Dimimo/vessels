<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Tax
 *
 * @property int                          $id
 * @property string                       $name
 * @property int|null                     $port_id
 * @property float                        $amount
 * @property string                       $tax_at
 * @property string|null                  $body
 * @property string|null                  $official_info
 * @property bool                         $optional Some taxes are optional, fex disability or locals
 * @property bool                         $global Global means the tax is not port relative, fex BIR
 * @property Carbon|null                  $created_at
 * @property Carbon|null                  $updated_at
 * @property Carbon|null                  $deleted_at
 * @property-read Collection|Departure[]  $departures
 * @property-read Collection|Permission[] $permissions
 * @property-read Port|null               $port
 * @property-read Collection|Role[]       $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newQuery()
 * @method static Builder|Tax onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereOfficialInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereOptional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax wherePortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereTaxAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereUpdatedAt($value)
 * @method static Builder|Tax withTrashed()
 * @method static Builder|Tax withoutTrashed()
 * @mixin Eloquent
 */
class Tax extends Model
{
    use SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'port_id',
        'amount',
        'tax_at',
        'body',
        'official_info',
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
    protected $casts = ['amount' => 'float', 'optional' => 'boolean', 'global' => 'boolean'];

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
     * a tax belongsTo a Port
     *
     * @return BelongsTo User
     */
    public function port()
    {
        return $this->belongsTo(Port::class, 'port_id', 'id');
    }

    /**
     * Taxes belongsTo many departures (many to many)
     *
     * @return BelongsToMany Departure
     */
    public function departures()
    {
        return $this->belongsToMany(Departure::class, 'departure_tax', 'tax_id', 'departure_id');
    }
}
