<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Multiple categories can belong to each organisation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organisations()
    {
        return $this->belongsToMany('Organisation');
    }
}
