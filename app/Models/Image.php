<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageManager;

class Image extends Model
{
    const IMG_WIDTH = 1920;
    const IMG_HEIGHT = 1920;
    const THUMB_WIDTH = 400;
    const THUMB_HEIGHT = 400;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'gallery_id',
        'name',
        'file',
        'file_alt'
    ];
}
