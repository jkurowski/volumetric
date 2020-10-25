<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
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
            $article_img = public_path('uploads/articles/' . $this->file);
            $article_thumb_img = public_path('uploads/articles/thumbs/' . $this->file);

            if (file_exists($article_img)) {
                unlink($article_img);
            }
            if (file_exists($article_thumb_img)) {
                unlink($article_thumb_img);
            }
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
