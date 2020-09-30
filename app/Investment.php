<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Investment extends Model
{
    const PLAN_WIDTH = 1280;
    const PLAN_HEIGHT = 560;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'status'
    ];

    /**
     * Get the investment plan
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plan(){
        return $this->hasOne('App\Plan');
    }

    /**
     * Get your investment floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floors(){
        return $this->hasMany('App\Floor');
    }

    /**
     * Get the investment floor
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function floor(){
        return $this->hasOne('App\Floor');
    }

    /**
     * Get flats belonging to the floors of the investment
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function floorRooms()
    {
        return $this->hasManyThrough(
            'App\Property',
            'App\Floor',
            'investment_id',
            'floor_id',
            'id',
            'id'
        );
    }

    /**
     * Get your investment buildings
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings(){
        return $this->hasMany('App\Building');
    }

    /**
     * Get the investment building
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function building(){
        return $this->hasOne('App\Building');
    }

    /**
     * Get your investment floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingFloors(){
        return $this->hasMany('App\Floor');
    }

    /**
     * Get flats belonging to the floors of the investment
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function buildingRooms()
    {
        return $this->hasManyThrough(
            'App\Property',
            'App\Building',
            'investment_id',
            'building_id',
            'id',
            'id'
        );
    }

    public function houses()
    {
        return $this->hasMany('App\Property');
    }

    public function planUpload($file)
    {
        $name = Str::slug($this->name) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('plan', $name, 'investment_uploads');

        $filepath = public_path('investment/plan/' . $name);
        Image::make($filepath)->fit(self::PLAN_WIDTH, self::PLAN_HEIGHT)->save($filepath);

        Plan::updateOrCreate(
            ['investment_id' => $this->id],
            ['file' => $name]
        );
    }
}
