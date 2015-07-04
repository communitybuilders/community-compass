<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * @package App
 */
class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_type',
        'entity_id',
        'address_type',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'suburb',
        'state',
        'postcode',
        'country',
        'lat',
        'lng'
    ];

    /**
     * Each address has one point.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function addressPoint()
    {
        return $this->hasOne('App\AddressPoint');
    }

    public function getOrganisation()
    {
        return Organisation::find($this->entity_id)->first();
    }

    /**
     * Returns a query for addresses of organisations,
     * optionally filtered by organisation ID.
     *
     * @param Builder $query
     * @param int|null $organisation_id
     *
     * @return Builder
     */
    public function scopeOrganisations($query, $organisation_id = null)
    {
        $builder = $query->where('entity_type', 'Organisation');

        if ($organisation_id) {
            return $builder->where('entity_id', $organisation_id);
        }

        return $builder;
    }

    /**
     * Returns a query for addresses between two postcodes.
     *
     * @param Builder $query
     * @param float $latitude
     * @param float $longitude
     * @param float $max_distance
     * @param int $limit
     */
    public function scopeWithinDistance($query, $latitude, $longitude, $max_distance, $limit)
    {
        // TODO: sql function for calc distance between points.

    }
}
