<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;


/**
 * App\Operator
 *
 * @property int                                                                                  $id
 * @property string                                                                               $name
 * @property string                                                                               $slug
 * @property string|null                                                                          $company_name
 * @property string|null                                                                          $email
 * @property string|null                                                                          $logo
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Captain[]                         $captains
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Port[]                            $ports
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]       $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vessel[]                          $vessels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Operator onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereContactNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereEmergencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereEmergencyNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operator whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Operator withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Operator withoutTrashed()
 * @mixin \Eloquent
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

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

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
     * an operator belongs to many users (admin functions)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Port
     */
    public function admins()
    {
        return $this->belongsToMany(User::class, 'port_user', 'user_id', 'port_id');
    }

    /**
     * an operator belongsTo many ports (many to many)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Port
     */
    public function ports()
    {
        return $this->belongsToMany(Port::class, 'operator_port', 'operator_id', 'port_id');
    }

    /**
     * an operator has many vessels
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany Vessel
     */
    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }

    /**
     * an operator has many captains
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany Captain
     */
    public function captains()
    {
        return $this->hasMany(Captain::class);
    }
}
