<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Building extends Model
{
    const PLAN_WIDTH = 1280;
    const PLAN_HEIGHT = 560;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'name',
        'number',
        'file',
        'html',
        'cords'
    ];

    /**
     * Get your building floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floors()
    {
        return $this->hasMany('App\Floor');
    }

    /**
     * Get your building rooms
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany('App\Property');
    }

    public function planUpload($title, $file, $delete = null)
    {
        if ($delete && $this->file) {
            $image_path = public_path('investment/building/' . $this->file);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $name = Str::slug($title, '-') . '_' . Str::random(12) . '.' .$file->getClientOriginalExtension();
        $file->storeAs('building', $name, 'investment_uploads');

        $filepath = public_path('investment/building/' . $name);
        Image::make($filepath)->resize(self::PLAN_WIDTH, self::PLAN_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filepath);

        $this->update(['file' => $name ]);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($building) {
            if ($building->file) {
                $image_path = public_path('investment/building/' . $building->file);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        });
    }
}
