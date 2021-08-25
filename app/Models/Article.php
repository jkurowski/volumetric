<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Article extends Model
{

    use LogsActivity;

    protected static $logName = 'Aktualności';

    const IMG_WIDTH = 1110;
    const IMG_HEIGHT = 600;
    const THUMB_WIDTH = 350;
    const THUMB_HEIGHT = 189;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'content_entry',
        'content',
        'file',
        'file_facebook',
        'file_alt',
        'meta_title',
        'meta_description',
        'status',
        'sort'
    ];
}
