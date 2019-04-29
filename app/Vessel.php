<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;


/**
 * App\Vessel
 *
 * @property int                                                                                  $id
 * @property string                                                                               $name
 * @property string                                                                               $slug
 * @property string|null                                                                          $nickname
 * @property int                                                                                  $vessel_type_id
 * @property int                                                                                  $operator_id
 * @property int|null                                                                             $captain_id
 * @property int|null                                                                             $capacity
 * @property string|null                                                                          $description
 * @property string|null                                                                          $body
 * @property bool                                                                                 $in_service
 * @property string|null                                                                          $operational_since
 * @property string|null                                                                          $picture
 * @property \Illuminate\Support\Carbon|null                                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                                      $updated_at
 * @property \Illuminate\Support\Carbon|null                                                      $deleted_at
 * @property-read \App\Captain|null                                                               $captain
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Departure[]                       $departures
 * @property-read \App\Operator                                                                   $operator
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]       $roles
 * @property-read \App\VesselType                                                                 $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Vessel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereInService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereOperationalSince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vessel whereVesselTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vessel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vessel withoutTrashed()
 * @mixin \Eloquent
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
        'description',
        'body',
        'in_service',
        'picture',
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
        'capacity'   => 'integer',
        'in_service' => 'boolean',
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

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

    /**
     * a vessel has many departures
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Departure
     */
    public function departures()
    {
        return $this->hasMany(Departure::class);
    }

    /**
     * a vessel belongsTo an operator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Operator
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * a vessel hasOne captain
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Captain
     */
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }

    /**
     * a vessel has one type
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne VesselType
     */
    public function type()
    {
        return $this->hasOne(VesselType::class);
    }
}
