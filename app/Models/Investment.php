<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Investment extends Model
{

    use HasTranslations;
    public $translatable = ['name', 'deadline', 'start_date', 'city', 'entry_content'];

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
        'deadline',
        'start_date',
        'lat',
        'lng',
        'zoom',
        'entry_content',
        'url',
        'file_thumb',
        'file_carousel',
        'sort'
    ];
}
