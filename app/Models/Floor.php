<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Floor extends Model
{
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
        'area_range',
        'html',
        'cords',
        'file',
        'meta_title',
        'meta_description'
    ];

    public function properties()
    {
        return $this->hasMany('App\Models\Property');
    }

    public function findNext(int $investment, int $building = null, int $id)
    {
        $next = $this->where('investment_id', $investment)->where('id', '>', $id)->first();
        if ($building && $next) {
            $next->where('building_id', $building);
        }
        return $next;
    }

    public function findPrev(int $investment, int $building = null, int $id)
    {
        $prev = $this->where('investment_id', $investment)->where('id', '<', $id)->first();
        if ($building && $prev) {
            $prev->where('building_id', $building);
        }
        return $prev;
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($floor) {
            if ($floor->file) {
                $image_path = public_path('investment/floor/' . $floor->file);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        });
    }
}
