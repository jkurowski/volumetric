<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Property extends Model
{

    use Notifiable;

    const PLAN_WIDTH = 1024;
    const PLAN_HEIGHT = 1024;
    const PLAN_THUMB_WIDTH = 570;
    const PLAN_THUMB_HEIGHT = 570;
    const PLAN_LIST_WIDTH = 80;
    const PLAN_LIST_HEIGHT = 80;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'building_id',
        'floor_id',
        'status',
        'name',
        'rooms',
        'area',
        'type',
        'html',
        'cords',
        'file'
    ];

    public function planUpload($title, $file, $delete = null)
    {
        if ($delete && $this->file) {
            $image_path = public_path('investment/property/' . $this->file);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image_thumb_path = public_path('investment/property/thumbs/' . $this->file);
            if (file_exists($image_thumb_path)) {
                unlink($image_thumb_path);
            }
            $image_list_path = public_path('investment/property/list/' . $this->file);
            if (file_exists($image_list_path)) {
                unlink($image_list_path);
            }
        }

        $name = Str::slug($title, '-') . '_' . Str::random(12) . '.' .$file->getClientOriginalExtension();
        $file->storeAs('property', $name, 'investment_uploads');

        $filepath = public_path('investment/property/' . $name);
        Image::make($filepath)->resize(self::PLAN_WIDTH, self::PLAN_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filepath);

        $filethumbpath = public_path('investment/property/thumbs/' . $name);
        Image::make($filepath)->resize(self::PLAN_THUMB_WIDTH, self::PLAN_THUMB_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filethumbpath);

        $filelistpath = public_path('investment/property/list/' . $name);
        Image::make($filepath)->resize(self::PLAN_LIST_WIDTH, self::PLAN_LIST_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filelistpath);

        $this->update(['file' => $name ]);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($property) {
            if ($property->file) {
                $image_path = public_path('investment/property/' . $property->file);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $image_thumb_path = public_path('investment/property/thumbs/' . $property->file);
                if (file_exists($image_thumb_path)) {
                    unlink($image_thumb_path);
                }
                $image_list_path = public_path('investment/property/list/' . $property->file);
                if (file_exists($image_list_path)) {
                    unlink($image_list_path);
                }
            }
        });
    }
}
