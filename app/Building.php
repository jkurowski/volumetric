<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    /**
     * Get your investment floors
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function floors(){
        return $this->hasMany('App\Floor');
    }
}
