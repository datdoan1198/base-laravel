<?php

namespace App\Repositories\BaseEloquentRepository;

abstract class BaseEloquentRepository implements BaseEloquentRepositoryInterface
{
    protected $model;

    public function __construct ()
    {
        $this->setModel();
    }

    /*
     * Get model
     * @return string
     */
    abstract public function getModel ();

    /*
     * Set model
     */
    public function setModel () :void
    {
        $this->model = app()->make($this->getModel());
    }

    /*
     * Get all
     * @return collection
     */
    public function getAll ()
    {
        $result = $this->model->all();
        return $result;
    }

    /*
     * Get one
     * @param $id
     * @return mixed
     */
    public function find ($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    /*
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create (array $attributes)
    {
        return $this->model->create($attributes);
    }

    /*
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update ($id, array $attributes): bool
    {
        $obj = $this->model->find($id);
        if (!empty($obj)) {
            $obj->update($attributes);
        }
        return false;
    }

    /*
     * Delete
     * @param $id
     * $return bool
     */
    public function delete ($id) : bool
    {
        $obj = $this->model->find($id);
        if (!empty($obj)) {
            $obj->delete();
            return true;
        }
        return false;
    }
}
