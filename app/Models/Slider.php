<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{

    use HasTranslations;
    public $translatable = ['title', 'subtitle', 'file_alt', 'link'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'subtitle',
        'file',
        'file_alt',
        'link',
        'opacity',
        'active',
        'sort'
    ];
}
