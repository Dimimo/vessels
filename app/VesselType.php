<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\VesselType
 *
 * @property int                      $id
 * @property string                   $name
 * @property string                   $slug
 * @property string|null              $description
 * @property string|null              $picture
 * @property Carbon|null              $created_at
 * @property Carbon|null              $updated_at
 * @property Carbon|null              $deleted_at
 * @property-read Collection|Vessel[] $vessels
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType newQuery()
 * @method static Builder|VesselType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VesselType whereUpdatedAt($value)
 * @method static Builder|VesselType withTrashed()
 * @method static Builder|VesselType withoutTrashed()
 * @mixin Eloquent
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

    /**************************************
     *
     * The eloquent relationships
     *
     **************************************/

    /**
     * a vessel type has many vessels
     *
     * @return HasMany Vessel
     */
    public function vessels()
    {
        return $this->hasMany(Vessel::class);
    }
}
