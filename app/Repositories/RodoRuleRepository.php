<?php namespace App\Repositories;

use App\Models\RodoRules;

class RodoRuleRepository extends BaseRepository
{
    protected $model;

    public function __construct(RodoRules $model)
    {
        parent::__construct($model);
    }
}
