<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Building extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'name',
        'number',
        'html',
        'cords',
        'meta_title',
        'meta_description',
        'meta_robots',
        'active',
        'content',
    ];

    /**
     * Get your building floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }

    /**
     * Get your building rooms
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany('App\Models\Property');
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
