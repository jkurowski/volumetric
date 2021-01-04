<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RodoClientRules extends Model
{
    const UPDATED_AT = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rodo_client_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rodo_rule_id',
        'rodo_client_id',
        'duration',
        'months',
        'ip',
        'url',
        'status'
    ];

    /**
     * Get your building rooms
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rules()
    {
        return $this->hasOne('App\Models\RodoRules', 'id', 'rodo_rule_id');
    }
}
