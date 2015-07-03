<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App
 */
class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_type',
        'entity_id',
        'email_address'
    ];
}
