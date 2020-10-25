<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Page extends Model
{
    use NodeTrait;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'uri',
        'url',
        'url_target',
        'content',
        'content_header',
        'meta_title',
        'meta_description',
        'meta_robots',
        'menu',
        'sort'
    ];

    function uriGenerate($page)
    {
        if ($page->parent_id) {

            $array = self::ancestorsOf($page->id)->pluck('slug')->toArray();
            array_push($array, $page->slug);
            $page->uri = implode('/', $array);

        } else {
            $page->uri = $page->slug;
        }

        $page->save();
    }

    public static function mainmenu()
    {
        return view('layouts.menu', [
            'pages' => self::withDepth()->defaultOrder()->get()->toTree()
        ]);
    }

}
