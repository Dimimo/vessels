<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


/**
 * App\Operator
 *
 * @property int                           $id
 * @property string                        $name
 * @property string                        $slug
 * @property string|null                   $company_name
 * @property string|null                   $email
 * @property string|null                   $logo
 * @property int                           $city_id
 * @property string|null                   $address1
 * @property string|null                   $address2
 * @property string|null                   $contact_nr
 * @property string|null                   $contact_name
 * @property string|null                   $emergency_nr
 * @property string|null                   $emergency_name
 * @property string|null                   $official_info
 * @property string|null                   $url
 * @property string|null                   $facebook
 * @property string|null                   $twitter
 * @property string|null                   $instagram
 * @property string|null                   $body
 * @property float|null                    $lat
 * @property float|null                    $lng
 * @property Carbon|null                   $created_at
 * @property Carbon|null                   $updated_at
 * @property Carbon|null                   $deleted_at
 * @property-read Collection|User[]        $admins
 * @property-read Collection|Captain[]     $captains
 * @property-read City                     $city
 * @property-read string                   $city_name
 * @property-read Collection|Permission[]  $permissions
 * @property-read Collection|Port[]        $ports
 * @property-read Collection|Reservation[] $reservations
 * @property-read Collection|Role[]        $roles
 * @property-read Collection|Departure[]   $schedule
 * @property-read Collection|Vessel[]      $vessels
 * @method static \Illuminate\Database\Eloquent\Builder|Operator findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator newQuery()
 * @method static Builder|Operator onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Operator role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereContactNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereEmergencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereEmergencyNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereOfficialInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Operator whereUrl($value)
 * @method static Builder|Operator withTrashed()
 * @method static Builder|Operator withoutTrashed()
 * @mixin Eloquent
 */
class Operator extends Model
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
        'company_name',
        'email',
        'city_id',
        'address1',
        'address2,',
        'contact_nr',
        'contact_name',
        'emergency_nr',
        'emergency_name',
        'url',
        'facebook',
        'twitter',
        'instagram',
        'body',
        'lat',
        'lng',
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
        'lat' => 'float',
        'lng' => 'float',
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
     * Get the city name as $operator->city_name
     *
     * @return string
     */
    public function getCityNameAttribute()
    {
        return $this->city->getCityName();
    }

    /**
     * set the city name from a posted autocomplete, sets the correct value in $operator->city_id
     *
     * @param int|string $value
     */
    public function setCityIdAttribute($value)
    {
        if (is_integer($value)) {
            $this->attributes['city_id'] = $value;
        } else {
            $this->attributes['city_id'] = City::getCityFromAutoComplete($value);
        }
    }

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

    /**
     * an operator belongs to many users (admin functions)
     *
     * @return BelongsToMany Port
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'port_user', 'user_id', 'port_id');
    }

    /**
     * an operator belongsTo many ports (many to many)
     *
     * @return BelongsToMany Port
     */
    public function ports()
    {
        return $this->belongsToMany(Port::class, 'operator_port', 'operator_id', 'port_id');
    }

    /**
     * an operator has many vessels
     *
     * @return hasMany Vessel
     */
    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }

    /**
     * an operator has many captains
     *
     * @return hasMany Captain
     */
    public function captains()
    {
        return $this->hasMany(Captain::class);
    }

    /**
     * an operator belongs to a city
     *
     * @return BelongsTo City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * an Operator has a schedule through vessels
     *
     * @return HasManyThrough Departure
     */
    public function schedule()
    {
        return $this->hasManyThrough(Departure::class, Vessel::class);
    }

    /**
     * an operator has many reservations
     *
     * @return hasMany Reservation
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
