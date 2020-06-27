<?php
/**
 * Copyright (c) 2017. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 * Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 */

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Province
 *
 * @property int                    $id
 * @property string                 $name
 * @property string                 $slug
 * @property-read Collection|City[] $cities
 * @method static Builder|Province findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Province newModelQuery()
 * @method static Builder|Province newQuery()
 * @method static Builder|Province query()
 * @method static Builder|Province whereId($value)
 * @method static Builder|Province whereName($value)
 * @method static Builder|Province whereSlug($value)
 * @mixin Eloquent
 */
class Province extends Model
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
    protected $table = 'provinces';
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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' =>
                    ['source' => 'title',],
        ];
    }
    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/
    /**
     * a province has many cities
     *
     * @return HasMany City
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
