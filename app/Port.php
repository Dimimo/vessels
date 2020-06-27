<?php

/********************************************************************************************\
 * | To to all vessels in a port, or all departures in this port, this solution is a good one:  |
 * |                                                                                            |
 * | https://stackoverflow.com/questions/37430217/has-many-through-many-to-many                 |
 * | or                                                                                         |
 * | https://github.com/staudenmeir/eloquent-has-many-deep                                      |
 * |                                                                                            |
 * \********************************************************************************************/

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


/**
 * App\Port
 *
 * @property int                           $id
 * @property string                        $name
 * @property string                        $slug
 * @property string|null                   $email
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
 * @property-read Collection|Departure[]   $arrivals
 * @property-read City                     $city
 * @property-read Collection|Departure[]   $departures
 * @property-read string                   $city_name
 * @property-read Collection|Operator[]    $operators
 * @property-read Collection|Permission[]  $permissions
 * @property-read Collection|Reservation[] $reservations
 * @property-read Collection|Role[]        $roles
 * @property-read Collection|Tax[]         $taxes
 * @method static \Illuminate\Database\Eloquent\Builder|Port findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Port newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Port newQuery()
 * @method static Builder|Port onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Port permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Port query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Port role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereContactNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereEmergencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereEmergencyNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereOfficialInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Port whereUrl($value)
 * @method static Builder|Port withTrashed()
 * @method static Builder|Port withoutTrashed()
 * @mixin Eloquent
 */
class Port extends Model
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
     * Get the city name as $port->city_name
     *
     * @return string
     */
    public function getCityNameAttribute()
    {
        return $this->city->getCityName();
    }

    /**
     * set the city name from a posted autocomplete, sets the correct value in $port->city_id
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
     * a port belongsTo many users (many to many), these are essentially super-admins
     *
     * @return BelongsToMany User
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'port_user', 'port_id', 'user_id');
    }

    /**
     * a port belongsTo many operators (many to many)
     *
     * @return BelongsToMany Operator
     */
    public function operators()
    {
        return $this->belongsToMany(Operator::class, 'operator_port', 'port_id', 'operator_id');
    }

    /**
     * a port has many departures
     *
     * @return HasMany Departure
     */
    public function departures()
    {
        return $this->hasMany(Departure::class, 'from_port_id');
    }

    /**
     * a port has many arrivals
     *
     * @return HasMany Departure
     */
    public function arrivals()
    {
        return $this->hasMany(Departure::class, 'to_port_id');
    }

    /**
     * a port has many possible taxes
     *
     * @return HasMany Departure
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * a Port belongs to a city
     *
     * @return BelongsTo City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * a port has many reservations through Operators
     *
     * @return HasManyThrough Departure
     */
    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, Operator::class);
    }
}
