<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'name',
        'address',
        'city',
        'lat',
        'lng',
        'zoom',
        'entry_content',
        'url',
        'file_thumb'
    ];
}
