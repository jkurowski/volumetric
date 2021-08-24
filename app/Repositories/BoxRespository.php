<?php namespace App\Repositories;

use App\Models\Boxes;

class BoxRespository extends BaseRepository
{
    protected $model;

    public function __construct(Boxes $model)
    {
        parent::__construct($model);
    }
}
