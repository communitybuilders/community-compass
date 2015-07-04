<?php

namespace App;

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
}
