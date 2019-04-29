<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Captain
 *
 * @property int                                                                                  $id
 * @property int                                                                                  $user_id
 * @property int                                                                                  $operator_id
 * @property \Illuminate\Support\Carbon|null                                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                                      $updated_at
 * @property \Illuminate\Support\Carbon|null                                                      $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Departure[]                       $departures
 * @property-read \App\Operator                                                                   $operator
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[]       $roles
 * @property-read \App\User                                                                       $user
 * @property-read \App\Vessel                                                                     $vessel
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Captain onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain whereOperatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Captain whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Captain withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Captain withoutTrashed()
 * @mixin \Eloquent
 */
class Captain extends Model
{
    use SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'operator_id',
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
    protected $casts = [];

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
     * a captain belongsTo a user account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * a captain belongsTo an operator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Operator
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * a captain has many departures
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Departure
     */
    public function departures()
    {
        return $this->hasMany(Departure::class);
    }

    /**
     * a captain belongs to a vessel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Vessel
     */
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
}
