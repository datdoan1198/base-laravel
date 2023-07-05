<?php

namespace App\Repositories\BaseEloquentRepository;

interface BaseEloquentRepositoryInterface
{
    /*
     * Get all
     * @return collection
     */
    public function getAll ();

    /*
     * Get one
     * @param $id
     * @return mixed
     */
    public function find ($id);

    /*
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create (array $attributes);

    /*
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update ($id, array $attributes);

    /*
     * Delete
     * @param $id
     * $return bool
     */
    public function delete ($id);
}
