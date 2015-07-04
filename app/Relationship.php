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
}
