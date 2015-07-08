<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Query\Builder;

/**
 * Class Organisation
 *
 * @package App
 */
class Organisation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'legal_name',
        'other_name',
        'abn',
        'registration_date',
        'established_date',
        'size',
        'num_responsible_persons',
        'financial_year_end'
    ];

    /**
     * Each organisation can have an address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Address', 'entity_id')
            ->where('entity_type', 'Organisation');
    }

    /**
     * An organisation can have many categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Each organisation can have an image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\Image', 'entity_id')
            ->where('entity_type', 'Organisation');
    }

    /**
     * An organisation can operate in many states.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function states()
    {
        return $this->belongsToMany('App\State');
    }

    /**
     * Each organisation can have a website.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function website()
    {
        return $this->hasOne('App\Website', 'entity_id')
            ->where('entity_type', 'Organisation');
    }

    /**
     * Return a query builder, sorted by address distance from coordinates.
     *
     * @param Builder $query
     * @param float $lat
     * @param float $lng
     * @param int $skip
     * @param int $take
     *
     * @return Builder
     */
    public function scopeClosest($query, $lat, $lng, $skip = 0, $take = 24)
    {
        return $query->join('addresses', 'organisations.id', '=', 'addresses.entity_id')
            ->select()
            ->selectRaw('ST_ASTEXT(addresses.geopoint) AS geopoint')
//            ->selectRaw('ST_DISTANCE(addresses.geopoint, POINT(?, ?)) as distance', [$lat, $lng])
            ->where('addresses.entity_type', 'Organisation')
            ->whereNotNull('addresses.geopoint')
//            ->orderByRaw('distance')
            ->orderByRaw('ST_DISTANCE(addresses.geopoint, POINT(?, ?))', [$lat, $lng])
            ->skip($skip)
            ->take($take);
    }

    /**
     * Return a query scope, eager loaded with address relations.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeWithAddress($query)
    {
        return $query->with('address');
    }
    /**
     * Return a query scope, eager loaded with categories relations.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeWithCategories($query)
    {
        return $query->with('categories');
    }

    /**
     * Return a query scope, eager loaded with image relations.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeWithImage($query)
    {
        return $query->with('image');
    }

    /**
     * Return a query scope, eager loaded with website relations.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeWithWebsite($query)
    {
        return $query->with('website');
    }

}
