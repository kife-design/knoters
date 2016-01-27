<?php namespace Knoters\Repositories;


/**
 * Class AbstractEloquentRepository
 * @package Knoters\Eloquent\Repositories
 */
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface AbstractRepository
 * @package Knoters\Repositories
 */
interface AbstractRepository
{

    /**
     * Returns all instances
     *
     * @return Collection
     */
    public function all();


    /**
     * Returns all instances with pagination
     *
     * @param  $count
     * @return mixed
     */
    public function allByPagination($count);

    /**
     * Returns a DB instance with the given id
     *
     * @param  $id
     * @param  array $with
     * @param  null $columns
     * @return mixed
     */
    public function find($id, $with = [], $columns = null);

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param  $attributes
     * @return mixed
     */
    public function firstOrCreate($attributes);

    /**
     * gets a collection item by a given key
     *
     * @param  $search
     * @param  array $with
     * @param  array $columns
     * @return mixed
     */
    public function findBy($search = [], array $with = [], array $columns = null);

    /**
     * gets a collection by a given key
     *
     * @param  $key
     * @param  $value
     * @param  array $with
     * @param  array $columns
     * @return mixed
     */
    public function getManyBy($key, $value, array $with = [], array $columns = null);

    /**
     * lists items by a given key
     *
     * @param  $value
     * @param  null $key
     * @return mixed
     */
    public function lists($value, $key = null);

    /**
     * returns a field from the model by a given id and value
     *
     * @param  $id
     * @param  $pluck
     * @return mixed
     */
    public function pluckById($id, $pluck);


    /**
     * returns a field from the model by a given key and value
     *
     * @param  $key
     * @param  $value
     * @param  $pluck
     * @return mixed
     */
    public function pluckBy($key, $value, $pluck);

    /**
     * returns an array with a set of values by a given key
     *
     * @param  $key
     * @param  $value
     * @param  $list
     * @return mixed
     */
    public function listBy($key, $value, $list);

    /**
     * Returns an DB instance with the given id and the passed relations
     * @param $id
     * @param $relations
     */
    public function findWithRelations($id, $relations);

    /**
     * Updates an DB record with the given instance
     *
     * @param $id
     * @param $data
     */
    public function update($id, $data);

    /**
     * Creates a new DB record with the given data
     *
     * @param  $data
     * @return static
     */
    public function store($data);

    /**
     * Creates a new DB record with the given data
     *
     * @param  $data
     * @return static
     */
    public function fill($data);

    /**
     * Deletes a DB Record with the given id
     *
     * @param $id
     */
    public function delete($id);

    /**
     * gets the column names of a DB table
     *
     * @param  array $excludes
     * @return mixed
     */
    public function getColumnNames($excludes = []);
}