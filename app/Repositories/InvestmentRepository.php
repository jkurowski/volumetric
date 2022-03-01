<?php namespace App\Repositories;

use App\Models\Investment;

class InvestmentRepository extends BaseRepository
{
    protected $model;

    public function __construct(Investment $model)
    {
        parent::__construct($model);
    }

    public function getUniqueRooms(object $query)
    {
        return $query->unique('rooms')->pluck('rooms');
    }
}
