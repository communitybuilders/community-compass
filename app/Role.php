<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 */
class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    public function client()
    {
        Role::where('title', 'Client')
    }

    /**
     * A role can have many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
