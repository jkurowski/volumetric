<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use LogsActivity, HasTranslations;

    protected static $logName = 'Aktualności';
    public $translatable = ['title'];

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
