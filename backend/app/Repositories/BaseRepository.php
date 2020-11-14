<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * @var Model|null
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model|null $model
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data = [])
    {
        return $this->model->create($data);
    }

    /**
     * @param integer $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data = [])
    {
        $instance = $this->findOrFail($id);
        $instance->update($data);
        return $instance;
    }
}
