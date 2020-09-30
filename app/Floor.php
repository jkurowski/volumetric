<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Floor extends Model
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
        'building_id',
        'name',
        'type',
        'html',
        'cords',
        'file'
    ];

    public function properties(){
        return $this->hasMany('App\Property');
    }

    public function findNext($id)
    {
        return $this->where('id', '>', $id)->first();
    }

    public function findPrev($id)
    {
        return $this->where('id', '<', $id)->first();
    }

    public function planUpload($title, $file, $delete = null)
    {
        if($delete && $this->file) {
            unlink(public_path('investment/floor/' . $this->file));
        }

        $name = Str::slug($title, '-') . '_' . Str::random(12) . '.' .$file->getClientOriginalExtension();
        $file->storeAs('floor', $name, 'investment_uploads');

        $filepath = public_path('investment/floor/' . $name);
        Image::make($filepath)->resize(self::PLAN_WIDTH, self::PLAN_HEIGHT, function ($constraint) {
            $constraint->aspectRatio();
        })->save($filepath);

        $this->update(['file' => $name ]);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($floor) {
            unlink(public_path('investment/floor/' . $floor->file));
        });
    }
}
