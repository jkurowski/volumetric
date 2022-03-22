<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Investment extends Model
{

    use HasTranslations;
    public $translatable = ['name', 'city', 'entry_content'];

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
