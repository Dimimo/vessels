<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Barangay
 *
 * @property int       $id
 * @property string    $name
 * @property string    $slug
 * @property int       $city_id
 * @property-read City $city
 * @method static Builder|Barangay findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Barangay newModelQuery()
 * @method static Builder|Barangay newQuery()
 * @method static Builder|Barangay query()
 * @method static Builder|Barangay whereCityId($value)
 * @method static Builder|Barangay whereId($value)
 * @method static Builder|Barangay whereName($value)
 * @method static Builder|Barangay whereSlug($value)
 * @mixin Eloquent
 */
class Barangay extends Model
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
    protected $table = 'barangays';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'city_id'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

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
     * a barangay belongs to a city
     *
     * @return BelongsTo City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
