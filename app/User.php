<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\User
 *
 * @property int                                                                                                            $id
 * @property string                                                                                                         $name
 * @property string                                                                                                         $slug
 * @property string                                                                                                         $email
 * @property string|null                                                                                                    $phone_nr
 * @property int                                                                                                            $is_super_admin
 * @property int                                                                                                            $is_admin
 * @property int                                                                                                            $is_statistical
 * @property int                                                                                                            $is_editor
 * @property int                                                                                                            $is_port_authority
 * @property int                                                                                                            $is_operator
 * @property int                                                                                                            $is_agent
 * @property int                                                                                                            $is_captain
 * @property \Illuminate\Support\Carbon|null                                                                                $email_verified_at
 * @property string                                                                                                         $password
 * @property string|null                                                                                                    $title
 * @property string|null                                                                                                    $description
 * @property string|null                                                                                                    $remember_token
 * @property \Illuminate\Support\Carbon|null                                                                                $created_at
 * @property \Illuminate\Support\Carbon|null                                                                                $updated_at
 * @property \Illuminate\Support\Carbon|null                                                                                $deleted_at
 * @property-read \App\Captain                                                                                              $captain
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Operator[]                                                  $operators
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[]                           $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Port[]                                                      $ports
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]                                 $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsCaptain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsPortAuthority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsStatistical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsSuperAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 * @mixin \Eloquent
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
        'contact_nr',
        'contact_name',
        'is_super_admin',
        'is_admin',
        'is_statistical',
        'is_editor',
        'is_port_authority',
        'is_operator',
        'is_agent',
        'is_captain',
        'title',
        'description',
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
        'email_verified_at' => 'datetime',
        'is_super_admin'    => 'boolean',
        'is_admin'          => 'boolean',
        'is_statistical'    => 'boolean',
        'is_editor'         => 'boolean',
        'is_port_authority' => 'boolean',
        'is_operator'       => 'boolean',
        'is_agent'          => 'boolean',
        'is_captain'        => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' =>
                    ['source' => 'name', 'onUpdate' => false],
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Port
     */
    public function ports()
    {
        return $this->belongsToMany(Port::class, 'port_user', 'user_id', 'port_id');
    }

    /**
     * a user belongs to many operators (admin functions)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Port
     */
    public function operators()
    {
        return $this->belongsToMany(Operator::class, 'operator_user', 'user_id', 'operator_id');
    }

    /**
     * a user hasOne captain
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne Captain
     */
    public function captain()
    {
        return $this->hasOne(Captain::class, 'user_id');
    }
}
