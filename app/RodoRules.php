<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RodoRules extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'text',
        'required',
        'time',
        'status'
    ];
}
