<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\VesselType
 *
 * @property int                                                         $id
 * @property string                                                      $name
 * @property string                                                      $slug
 * @property string|null                                                 $description
 * @property string|null                                                 $picture
 * @property \Illuminate\Support\Carbon|null                             $created_at
 * @property \Illuminate\Support\Carbon|null                             $updated_at
 * @property \Illuminate\Support\Carbon|null                             $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vessel[] $vessels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\VesselType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VesselType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VesselType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\VesselType withoutTrashed()
 * @mixin \Eloquent
 */
class VesselType extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'picture',
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
     * a vessel type has many vessels
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Vessel
     */
    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }
}
