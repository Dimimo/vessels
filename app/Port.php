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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;


/**
 * Class Port
 *
 * @package App
 * @property int                                                                                  $id
 * @property string                                                                               $name
 * @property string                                                                               $slug
 * @property string|null                                                                          $email
 * @property string                                                                               $city
 * @property string|null                                                                          $address1
 * @property string|null                                                                          $address2
 * @property string|null                                                                          $contact_nr
 * @property string|null                                                                          $contact_name
 * @property string|null                                                                          $emergency_nr
 * @property string|null                                                                          $emergency_name
 * @property string|null                                                                          $url
 * @property string|null                                                                          $facebook
 * @property string|null                                                                          $twitter
 * @property string|null                                                                          $instagram
 * @property string|null                                                                          $body
 * @property float|null                                                                           $lat
 * @property float|null                                                                           $lng
 * @property \Illuminate\Support\Carbon|null                                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                                      $updated_at
 * @property \Illuminate\Support\Carbon|null                                                      $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[]                            $admins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Departure[]                       $arrivals
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Departure[]                       $departures
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Operator[]                        $operators
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]       $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Port onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereContactNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereEmergencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereEmergencyNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Port whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Port withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Port withoutTrashed()
 * @mixin \Eloquent
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
        'city',
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

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

    /**
     * a port belongsTo many users (many to many), these are essentially super-admins
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany User
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'port_user', 'port_id', 'user_id');
    }

    /**
     * a port belongsTo many operators (many to many)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Operator
     */
    public function operators()
    {
        return $this->belongsToMany(Operator::class, 'operator_port', 'port_id', 'operator_id');
    }

    /**
     * a port has many departures
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Departure
     */
    public function departures()
    {
        return $this->hasMany(Departure::class, 'from_port_id');
    }

    /**
     * a port has many arrivals
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Departure
     */
    public function arrivals()
    {
        return $this->hasMany(Departure::class, 'to_port_id');
    }
}
