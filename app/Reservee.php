<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
 * App\Reservee
 *
 * @property int                                                        $id
 * @property string                                                     $name
 * @property string                                                     $slug
 * @property string                                                     $email
 * @property string                                                     $password
 * @property int|null                                                   $city_id
 * @property string                                                     $title
 * @property string|null                                                $contact_nr
 * @property string|null                                                $contact_name
 * @property string|null                                                $address1
 * @property string|null                                                $address2
 * @property string|null                                                $remember_token
 * @property string|null                                                $description
 * @property array|null                                                 $settings
 * @property string|null                                                $picture
 * @property bool                                                       $status
 * @property string|null                                                $stripe_id
 * @property string|null                                                $card_brand
 * @property string|null                                                $card_last_four
 * @property Carbon|null                                                $trial_ends_at
 * @property Carbon|null                                                $email_verified_at
 * @property Carbon|null                                                $created_at
 * @property Carbon|null                                                $updated_at
 * @property Carbon|null                                                $deleted_at
 * @property-read City|null                                             $city
 * @property-read string                                                $city_name
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read Collection|Passenger[]                                $passengers
 * @property-read Collection|Permission[]                               $permissions
 * @property-read Collection|Reservation[]                              $reservations
 * @property-read Collection|Role[]                                     $roles
 * @property-read Collection|Subscription[]                             $subscriptions
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee newQuery()
 * @method static Builder|Reservee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereContactNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservee whereUpdatedAt($value)
 * @method static Builder|Reservee withTrashed()
 * @method static Builder|Reservee withoutTrashed()
 * @mixin Eloquent
 */
class Reservee extends Authenticatable
{
    use Notifiable, SoftDeletes, Sluggable, HasRoles;

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
        'title',
        'address1',
        'address2',
        'settings',
        'description',
        'picture',
        'status',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
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
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings'          => 'array',
        'status'            => 'boolean',
        'trial_ends_at'     => 'datetime',
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
                    ['source' => 'name', 'on_update' => false],
        ];
    }

    /**
     * Get the city name as $reservee->city_name
     *
     * @return string
     */
    public function getCityNameAttribute()
    {
        return $this->city->getCityName();
    }

    /**
     * set the city name from a posted autocomplete, sets the correct value in $reservee->city_id
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
     * a reservee belongs to a city
     *
     * @return BelongsTo City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * a reservee has many reservations
     *
     * @return HasMany Reservation
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * a reservee has many subscriptions
     *
     * @return HasMany Subscription
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * a reservee has many passengers through reservations
     *
     * @return HasManyThrough Passenger
     */
    public function passengers()
    {
        return $this->hasManyThrough(Passenger::class, Reservation::class);
    }
}
