<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'status',
        'name',
        'address',
        'city',
        'date_start',
        'date_end',
        'areas_amount',
        'office_address',
        'meta_title',
        'meta_description',
        'meta_robots',
        'entry_content',
        'content',
        'end_content',
    ];

    /**
     * Get the investment plan
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plan()
    {
        return $this->hasOne('App\Models\Plan');
    }

    /**
     * Get your investment floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floors()
    {
        return $this->hasMany('App\Models\Floor');
    }

    /**
     * Get the investment floor
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function floor()
    {
        return $this->hasOne('App\Models\Floor');
    }

    /**
     * Get flats belonging to the floors of the investment
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function floorRooms()
    {
        return $this->hasManyThrough(
            'App\Models\Property',
            'App\Models\Floor',
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
    public function buildings()
    {
        return $this->hasMany('App\Models\Building');
    }

    /**
     * Get the investment building
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function building()
    {
        return $this->hasOne('App\Models\Building');
    }

    /**
     * Get your investment floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildingFloors()
    {
        return $this->hasMany('App\Models\Floor');
    }

    /**
     * Get flats belonging to the floors of the investment
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function buildingRooms()
    {
        return $this->hasManyThrough(
            'App\Models\Property',
            'App\Models\Building',
            'investment_id',
            'building_id',
            'id',
            'id'
        );
    }

    public function houses()
    {
        return $this->hasMany('App\Models\Property');
    }
}
