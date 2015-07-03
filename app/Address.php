<?php

namespace App;

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
}
