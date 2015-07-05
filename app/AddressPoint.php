<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressPoint
 *
 * @package App
 */
class AddressPoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_id',
        'geopoint'
    ];

    /**
     * Each point belongs to one address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    /**
     * Return a query AddressPoint query builder, sorted by distance from
     * given geocoordinates.
     *
     * @param Builder $query
     * @param float $lat
     * @param float $lng
     * @param int $limit
     *
     * @return Builder
     */
    public function scopeNearby($query, $lat, $lng, $limit = 30)
    {
        return $query->whereNotNull('geopoint')
            ->orderByRaw('ST_DISTANCE(geopoint, POINT(' . $lat . ',' . $lng . '))')
            ->limit($limit);
    }

}
