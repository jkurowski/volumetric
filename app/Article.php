<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Article extends Model
{
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
        'category_id',
        'title',
        'slug',
        'content_entry',
        'content',
        'file',
        'file_header',
        'meta_title',
        'meta_description',
        'status',
        'sort'
    ];

    public function upload($slug, $file, $delete = null)
    {
        if($delete && $this->file) {
            unlink(public_path('uploads/articles/' . $this->file));
            unlink(public_path('uploads/articles/thumbs/' . $this->file));
        }

        $name = $slug.'.' . $file->getClientOriginalExtension();
        $file->storeAs('articles', $name, 'public_uploads');

        $filepath = public_path('uploads/articles/' . $name);
        $thumb_filepath = public_path('uploads/articles/thumbs/' . $name);
        Image::make($filepath)->fit(self::IMG_WIDTH, self::IMG_HEIGHT)->save($filepath);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($thumb_filepath);

        $this->update(['file' => $name ]);
    }
}
