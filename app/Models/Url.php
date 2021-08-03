<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Url extends Model
{
    use NodeTrait;

    protected $table = 'pages';

    protected $fillable = [
        'parent_id',
        'title',
        'uri',
        'url',
        'url_target',
        'meta_title',
        'meta_description',
        'meta_robots',
        'type',
        'menu',
        'sort'
    ];
}
