<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\User
 *
 * @property int                                                        $id
 * @property string                                                     $name
 * @property string                                                     $slug
 * @property string                                                     $email
 * @property int|null                                                   $city_id
 * @property string|null                                                $contact_nr
 * @property string|null                                                $contact_name
 * @property bool                                                       $is_super_admin
 * @property bool                                                       $is_admin
 * @property bool                                                       $is_statistical
 * @property bool                                                       $is_editor
 * @property bool                                                       $is_port_authority
 * @property bool                                                       $is_operator
 * @property bool                                                       $is_operator_employee
 * @property bool                                                       $is_agent
 * @property bool                                                       $is_captain
 * @property Carbon|null                                                $email_verified_at
 * @property string                                                     $password
 * @property string|null                                                $title
 * @property string|null                                                $description
 * @property string|null                                                $remember_token
 * @property Carbon|null                                                $created_at
 * @property Carbon|null                                                $updated_at
 * @property Carbon|null                                                $deleted_at
 * @property-read Captain                                               $captain
 * @property-read City|null                                             $city
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Collection|Operator[]                                 $operators
 * @property-read Collection|Permission[]                               $permissions
 * @property-read Collection|Port[]                                     $ports
 * @property-read Collection|Role[]                                     $roles
 * @method static \Illuminate\Database\Eloquent\Builder|User findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsCaptain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsOperatorEmployee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsPortAuthority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsStatistical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsSuperAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static Builder|User withTrashed()
 * @method static Builder|User withoutTrashed()
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes, Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'city_id',
        'contact_nr',
        'contact_name',
        'is_super_admin',
        'is_admin',
        'is_statistical',
        'is_editor',
        'is_port_authority',
        'is_operator',
        'is_operator_employee',
        'is_agent',
        'is_captain',
        'title',
        'description',
        'email_verified_at',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'    => 'datetime',
        'is_super_admin'       => 'boolean',
        'is_admin'             => 'boolean',
        'is_statistical'       => 'boolean',
        'is_editor'            => 'boolean',
        'is_port_authority'    => 'boolean',
        'is_operator'          => 'boolean',
        'is_operator_employee' => 'boolean',
        'is_agent'             => 'boolean',
        'is_captain'           => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' =>
                    ['source' => 'name', 'on_update' => false],
        ];
    }

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/
    /**
     * a user belongs to many ports (admin functions)
     *
     * @return BelongsToMany Port
     */
    public function ports()
    {
        return $this->belongsToMany(Port::class, 'port_user', 'user_id', 'port_id');
    }

    /**
     * a user belongs to many operators (admin functions)
     *
     * @return BelongsToMany Port
     */
    public function operators()
    {
        return $this->belongsToMany(Operator::class, 'operator_user', 'user_id', 'operator_id');
    }

    /**
     * a user hasOne captain
     *
     * @return hasOne Captain
     */
    public function captain()
    {
        return $this->hasOne(Captain::class, 'user_id');
    }

    /**
     * a user belongs to a city
     *
     * @return BelongsTo City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
