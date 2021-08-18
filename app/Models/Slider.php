<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    const IMG_WIDTH = 1920;
    const IMG_HEIGHT = 700;
    const THUMB_WIDTH = 200;
    const THUMB_HEIGHT = 73;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'file',
        'file_alt',
        'link',
        'link_button',
        'link_target',
        'opacity',
        'active',
        'sort'
    ];
}
