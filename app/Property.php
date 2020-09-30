<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Property extends Model
{
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
        if($delete && $this->file) {
            unlink(public_path('investment/property/' . $this->file));
            unlink(public_path('investment/property/thumbs/' . $this->file));
            unlink(public_path('investment/property/list/' . $this->file));
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

    public static function boot() {
        parent::boot();
        self::deleting(function($property) {
            unlink(public_path('investment/property/' . $property->file));
            unlink(public_path('investment/property/thumbs/' . $property->file));
            unlink(public_path('investment/property/list/' . $property->file));
        });
    }
}
