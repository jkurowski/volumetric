<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RodoRules extends Model
{

    use LogsActivity;

    protected static $logName = 'Regułki RODO';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'text',
        'required',
        'time',
        'status'
    ];
}
