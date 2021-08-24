<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    const IMG_WIDTH = 120;
    const IMG_HEIGHT = 120;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
        'file',
        'file_alt',
        'link',
        'link_button',
        'link_target',
        'aos_animation',
        'aos_duration',
        'aos_delay',
        'aos_offset',
        'sort'
    ];
}
