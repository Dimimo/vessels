<?php

namespace App;

use Auth;
use Config;
use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * App\City
 *
 * @property int                        $id
 * @property string                     $name
 * @property string                     $slug
 * @property int|null                   $postcode
 * @property int                        $province_id
 * @property float                      $lng
 * @property float                      $lat
 * @property-read Collection|Barangay[] $barangays
 * @property-read Collection|Operator[] $operators
 * @property-read Collection|Port[]     $ports
 * @property-read Province              $province
 * @property-read Collection|User[]     $reservees
 * @property-read Collection|User[]     $users
 * @method static Builder|City findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|City newModelQuery()
 * @method static Builder|City newQuery()
 * @method static Builder|City order()
 * @method static Builder|City query()
 * @method static Builder|City whereId($value)
 * @method static Builder|City whereLat($value)
 * @method static Builder|City whereLng($value)
 * @method static Builder|City whereName($value)
 * @method static Builder|City wherePostcode($value)
 * @method static Builder|City whereProvinceId($value)
 * @method static Builder|City whereSlug($value)
 * @mixin Eloquent
 */
class City extends Model
{
    use Sluggable;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug',];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * @var array casts
     */
    protected $casts = ['postcode'    => 'integer',
                        'province_id' => 'integer',
                        'lat'         => 'float',
                        'lng'         => 'float',
    ];

    /**
     * Make the list for json autocomplete search
     *
     * @return string
     */
    public static function cityListForAutoComplete()
    {
        $cities = City::select(['id', 'name'])->with('province')->orderBy('name')->get()->transform(function ($city) {
            return $city['name'] = $city['name'] . ' (' . City::where('id', $city['id'])->first()->province->name . ')';
        });

        return "const cities = " . $cities->toJson() . ";";
    }

    /**
     * Get the city name, if no $city is given, the cookie is looked up
     *
     * @param null $city
     *
     * @return null|string
     */
    public static function getCity($city = null)
    {
        if (empty($city)) {
            $city = City::getCookie();
        }
        if (empty($city) && Auth::check() && isset(Auth::user()->userDetail->city_id)) {
            $city = Auth::user()->userDetail->city->id;
        }
        if (empty($city)) {
            $city = config('app.default_city');
        }
        if ($city) {
            return City::getCityName($city);
        }

        return null;
    }

    /**
     * get the city_id cookie
     *
     * @param bool $name
     *
     * @return bool|string
     */
    public static function getCookie($name = false)
    {
        if ($city_id = request()->cookie('city_id')) {
            if ($name) {
                return City::getCityName($city_id);
            }

            return $city_id;
        } else if (Auth::check()) {
            if ($city_id = Auth::user()->userDetail->city_id) {
                return $city_id;
            }
        }

        //if all fails, return the default city
        return Config::get('app.default_city');
    }

    /**
     * get the city name and province from a city_id
     *
     * @param int  $city_id
     * @param bool $province
     *
     * @return string
     */
    public function getCityName($city_id = null, $province = true)
    {
        if (!$city_id) {
            $city_id = $this->id;
        }
        if (!$city = City::find($city_id)) {
            return '';
        }
        if ($province) {
            return $city->name . ' (' . $city->province->name . ')';
        }

        return $city->name;
    }

    /**
     * handle a new city request from a city choice jquery request
     *
     * @return array
     */
    public function cityPost()
    {
        $request = request()->all();
        if (empty($request['city'])) {
            return ['type' => 'error', 'error' => '<strong>There is no city value</strong>. Please try again.'];
        }
        if ($city_id = City::getCityFromAutoComplete($request['city'])) {
            $city = $this->getCityName($city_id);
            setcookie('city_id', encrypt($city_id), time() + 60 * 60 * 24 * 30, '/', env('APP_DOMAIN'), true);

            return ['type' => 'success', 'city' => $city];
        } else {
            return ['type' => 'error', 'error' => '<strong>This city does not exist</strong>. Please try again.'];
        }
    }

    /**
     * return the city->id of an autocomplete search
     *
     * @param $city
     *
     * @return string
     */
    public static function getCityFromAutoComplete($city)
    {
        if (!$city) {
            return '';
        }
        preg_match('/\((.*?)\)/', $city, $province);
        if (!isset($province[1])) {
            return '';
        }
        if (!$province = Province::where('slug', Str::slug($province[1]))->first()) {
            return '';
        }
        $city = preg_split('/\(([\s]*)/', $city);
        if (!isset($city[0])) {
            return '';
        }
        $city = City::where('slug', Str::slug($city[0]))->where('province_id', $province->id)->first();
        if ($city) {
            return $city->id;
        }

        return '';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' => ['source' => 'name']];
    }

    /**
     * @param $query City
     *
     * @return mixed
     */
    public function scopeOrder($query)
    {
        return $query->orderBy('name')->get();
    }



    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/
    /**
     * a city belongs to a province
     *
     * @return BelongsTo Province
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * a city has many barangays
     *
     * @return HasMany Barangay
     */
    public function barangays()
    {
        return $this->hasMany(Barangay::class);
    }

    /**
     * a city has many users
     *
     * @return HasMany Barangay
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }


    /**
     * a city has many reservees
     *
     * @return HasMany Barangay
     */
    public function reservees()
    {
        return $this->hasMany(User::class);
    }

    /**
     * a city has many Ports
     *
     * @return HasMany Barangay
     */
    public function ports()
    {
        return $this->hasMany(Port::class);
    }

    /**
     * a city has many Operators
     *
     * @return HasMany Barangay
     */
    public function operators()
    {
        return $this->hasMany(Operator::class);
    }
}
