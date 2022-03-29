<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use NodeTrait;

    use HasTranslations;
    public $translatable = ['title', 'content', 'content_header', 'meta_title', 'meta_description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'parent_id',
        'title',
        'content',
        'content_header',
        'file',
        'meta_title',
        'meta_description',
        'meta_robots'
    ];

    public static function mainmenu()
    {
        return view('layouts.partials.menu', [
            'pages' => self::withDepth()->defaultOrder()->get()->toTree()
        ]);
    }

    public static function sidemenu(int $id)
    {
        return view('layouts.partials.sidemenu', [
            'pages' => self::descendantsOf($id)->toTree()
        ]);
    }
}
