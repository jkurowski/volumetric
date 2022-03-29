<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class RodoRules extends Model
{

    use LogsActivity;
    protected static $logName = 'Regułki RODO';

    use HasTranslations;
    public $translatable = ['text'];

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
