<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class Slider extends Model
{
    const IMG_WIDTH = 1920;
    const IMG_HEIGHT = 700;
    const THUMB_WIDTH = 200;
    const THUMB_HEIGHT = 73;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'file',
        'link',
        'link_button',
        'sort'
    ];

    public static function boot ()
    {
        parent::boot();

        self::deleting(function ($slider) {
            $file = public_path('uploads/slider/' . $slider->file);
            if(File::isFile($file)){
                File::delete($file);
            }
            $file_thumb = public_path('uploads/slider/thumbs/' . $slider->file);
            if(File::isFile($file_thumb)){
                File::delete($file_thumb);
            }
        });
    }

    public function upload($title, $file, $delete = null)
    {
        if($delete && $this->file) {
            unlink(public_path('uploads/slider/' . $this->file));
            unlink(public_path('uploads/slider/thumbs/' . $this->file));
        }

        $name = Str::slug($title, '-').'_'.date('His').'.' . $file->getClientOriginalExtension();
        $file->storeAs('slider', $name, 'public_uploads');

        $filepath = public_path('uploads/slider/' . $name);
        $thumb_filepath = public_path('uploads/slider/thumbs/' . $name);
        Image::make($filepath)->fit(self::IMG_WIDTH, self::IMG_HEIGHT)->save($filepath);
        Image::make($filepath)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT)->save($thumb_filepath);

        $this->update(['file' => $name ]);
    }

    public function sort($array)
    {
        $updateRecordsArray = $array->get('recordsArray');
        $listingCounter = 1;
        foreach ($updateRecordsArray as $recordIDValue) {
            $entry = self::find($recordIDValue);
            $entry->sort = $listingCounter;
            $entry->save();
            $listingCounter = $listingCounter + 1;
        }
    }
}
