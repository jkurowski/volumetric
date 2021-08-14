<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function allSort($order): Collection
    {
        return $this->model->orderBy('sort', $order)->get();
    }

    public function find($id): ?Model
    {
        if (null == $entry = $this->model->find($id)) {
            throw new ModelNotFoundException("Image not found");
        }
        return $entry;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, $updatedModel)
    {
        return $updatedModel->update($attributes);
    }

    public function delete($id): int
    {
        Session::flash('success', 'Wpis usunięty');
        return $this->model->destroy($id);
    }

    public function updateOrder(array $recordsArray)
    {
        $listingCounter = 1;
        foreach ($recordsArray as $recordIDValue) {
            $entry = $this->model->find($recordIDValue);
            $entry->sort = $listingCounter;
            $entry->save();
            $listingCounter = $listingCounter + 1;
        }
    }
}
