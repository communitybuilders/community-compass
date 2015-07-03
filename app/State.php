<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 *
 * @package App
 */
class State extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Each state can have more multiple organisations operating in it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisations()
    {
        return $this->belongsToMany('Organisation');
    }
}
