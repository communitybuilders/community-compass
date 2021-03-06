<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Relationship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "organisation_id",
        "user_id",
        "start_date",
        "relationship_type_id"
    ];
}
