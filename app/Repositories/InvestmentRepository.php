<?php namespace App\Repositories;

use App\Models\Investment;

class InvestmentRepository extends BaseRepository
{
    protected $model;

    public function __construct(Investment $model)
    {
        parent::__construct($model);
    }
}
