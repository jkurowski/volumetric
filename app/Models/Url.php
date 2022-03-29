<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;

class Url extends Model
{
    use NodeTrait;

    use HasTranslations;
    public $translatable = ['title', 'content', 'content_header', 'meta_title', 'meta_description'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'type',
        'parent_id',
        'title',
        'uri',
        'url',
        'url_target',
        'file',
        'content_header',
        'meta_title',
        'meta_description',
        'meta_robots'
    ];
}
