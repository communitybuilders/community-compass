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

    /**
     * Each image belongs to an organisation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'entity_id');
    }
}
