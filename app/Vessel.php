<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


/**
 * App\Vessel
 *
 * @property int                          $id
 * @property string                       $name
 * @property string                       $slug
 * @property string|null                  $nickname
 * @property int                          $vessel_type_id
 * @property int                          $operator_id
 * @property int|null                     $captain_id
 * @property int|null                     $capacity
 * @property string|null                  $picture
 * @property string|null                  $description
 * @property string|null                  $body
 * @property bool                         $in_service
 * @property Carbon|null                  $operational_since
 * @property Carbon|null                  $decommissioned_since
 * @property string|null                  $reason Reason why it's out of service
 * @property Carbon|null                  $created_at
 * @property Carbon|null                  $updated_at
 * @property Carbon|null                  $deleted_at
 * @property-read Captain|null            $captain
 * @property-read Collection|Departure[]  $departures
 * @property-read Operator                $operator
 * @property-read Collection|Permission[] $permissions
 * @property-read Collection|Role[]       $roles
 * @property-read VesselType              $type
 * @method static Builder|Vessel active()
 * @method static Builder|Vessel findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static Builder|Vessel newModelQuery()
 * @method static Builder|Vessel newQuery()
 * @method static \Illuminate\Database\Query\Builder|Vessel onlyTrashed()
 * @method static Builder|Vessel permission($permissions)
 * @method static Builder|Vessel query()
 * @method static bool|null restore()
 * @method static Builder|Vessel role($roles, $guard = null)
 * @method static Builder|Vessel today()
 * @method static Builder|Vessel whereBody($value)
 * @method static Builder|Vessel whereCapacity($value)
 * @method static Builder|Vessel whereCaptainId($value)
 * @method static Builder|Vessel whereCreatedAt($value)
 * @method static Builder|Vessel whereDecommissionedSince($value)
 * @method static Builder|Vessel whereDeletedAt($value)
 * @method static Builder|Vessel whereDescription($value)
 * @method static Builder|Vessel whereId($value)
 * @method static Builder|Vessel whereInService($value)
 * @method static Builder|Vessel whereName($value)
 * @method static Builder|Vessel whereNickname($value)
 * @method static Builder|Vessel whereOperationalSince($value)
 * @method static Builder|Vessel whereOperatorId($value)
 * @method static Builder|Vessel wherePicture($value)
 * @method static Builder|Vessel whereReason($value)
 * @method static Builder|Vessel whereSlug($value)
 * @method static Builder|Vessel whereUpdatedAt($value)
 * @method static Builder|Vessel whereVesselTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|Vessel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Vessel withoutTrashed()
 * @mixin Eloquent
 */
class Vessel extends Model
{
    use SoftDeletes, HasRoles, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'nickname',
        'vessel_type_id',
        'operator_id',
        'captain_id,',
        'capacity',
        'picture',
        'description',
        'body',
        'in_service',
        'operational_since',
        'decommissioned_since',
        'reason',
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
        'capacity'             => 'integer',
        'in_service'           => 'boolean',
        'operational_since'    => 'date',
        'decommissioned_since' => 'date',
    ];

    /**
     * The attributes that should be mutated to Carbon dates.
     *
     * @var array
     */
    protected $dates = [
        'operational_since',
        'decommissioned_since',
    ];

    /**
     * For use of Laravel-permission, the package from spatie
     */
    protected $guard_name = 'web';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' =>
                    ['source' => 'name',],
        ];
    }

    /**
     * Scope a query to only include active vessels.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('in_service', 1);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeToday($query)
    {
        return $query->where('active', 1);
    }

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

    /**
     * a vessel has many departures
     *
     * @return HasMany Departure
     */
    public function departures()
    {
        return $this->hasMany(Departure::class);
    }

    /**
     * a vessel belongsTo an operator
     *
     * @return BelongsTo Operator
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * a vessel hasOne captain
     *
     * @return BelongsTo Captain
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }

    /**
     * a vessel has one type
     *
     * @return BelongsTo VesselType
     */
    public function type()
    {
        return $this->belongsTo(VesselType::class, 'vessel_type_id', 'id');
    }
}
