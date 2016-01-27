<?php namespace Knoters\Repositories\Eloquent;

use Knoters\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AbstractEloquentRepository
 * @package Eshots\Eloquent\Repositories
 */
class AbstractEloquentRepository implements AbstractRepository
{

    /**
     * Returns all instances
     *
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }


    /**
     * Returns all instances with pagination
     *
     * @param $itemsPerPage
     *
     * @return mixed
     * @internal param $count
     */
    public function allByPagination($itemsPerPage)
    {
        return $this->model->paginate($itemsPerPage);
    }


    /**
     * Returns a DB instance with the given id
     *
     * @param  $id
     * @param  array $with
     * @param  null $columns
     * @return mixed
     */
    public function find($id, $with = [], $columns = null)
    {
        $query = $this->make($with);

        return $query->find($id, $columns);
    }

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param  $attributes
     * @return mixed
     */
    public function firstOrCreate($attributes)
    {
        return $this->model->firstOrCreate($attributes);
    }


    /**
     * gets a collection item by a given key
     *
     * @param  $search
     * @param  array $with
     * @param  array $columns
     * @return mixed
     */
    public function findBy($search = [], array $with = [], array $columns = null)
    {
        $resources = $this->make($with);

        foreach ($search as $key => $value) {
            $resources->where($key, '=', $value);
        }

        return $resources->first($columns);
    }

    /**
     * gets a collection by a given key
     *
     * @param  $key
     * @param  $value
     * @param  array $with
     * @param  array $columns
     * @return mixed
     */
    public function getManyBy($key, $value, array $with = [], array $columns = null)
    {
        return $this->make($with)->where($key, '=', $value)->get($columns);
    }

    /**
     * lists items by a given key
     *
     * @param  $value
     * @param  null $key
     * @return mixed
     */
    public function lists($value, $key = null)
    {
        if (!is_null($key)) {
            return $this->model->lists($value, $key);
        } else {
            return $this->model->lists($value);
        }
    }

    /**
     * returns a field from the model by a given id and value
     *
     * @param  $id
     * @param  $pluck
     * @return mixed
     */
    public function pluckById($id, $pluck)
    {
        return $this->model->where('id', '=', $id)->pluck($pluck);
    }

    /**
     * returns a field from the model by a given key and value
     *
     * @param  $key
     * @param  $value
     * @param  $pluck
     * @return mixed
     */
    public function pluckBy($key, $value, $pluck)
    {
        return $this->model->where($key, '=', $value)->pluck($pluck);
    }

    /**
     * returns an array with a set of values by a given key
     *
     * @param  $key
     * @param  $value
     * @param  $list
     * @return mixed
     */
    public function listBy($key, $value, $list)
    {
        return $this->model->where($key, '=', $value)->lists($list);
    }

    /**
     * Returns an DB instance with the given id and the passed relations
     * @param $id
     * @param $relations
     */
    public function findWithRelations($id, $relations)
    {
        return $this->model->where('id', '=', $id)
            ->with($relations)
            ->first();
    }

    /**
     * Updates an DB record with the given instance
     *
     * @param $id
     * @param $data
     *
     * @return
     * @throws Exception
     */
    public function update($id, $data)
    {
        $model = $this->model->find($id);

        $updated = $model->update($data);

        if (!$updated) {
            throw new Exception('Failed to update the model');
        }

        return $model;
    }


    /**
     * Creates a new DB record with the given data
     *
     * @param  $data
     * @return static
     */
    public function store($data)
    {
        $model = $this->model->create($data);

        return $model;
    }

    /**
     * Creates a new DB record with the given data
     *
     * @param  $data
     * @return static
     */
    public function fill($data)
    {
        $model = $this->model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Deletes a DB Record with the given id
     *
     * @param $id
     */
    public function delete($id)
    {
        $model = $this->model->find($id);

        $deleted = $model->delete();

        return $deleted;
    }

    /**
     * attaches a relation to a resuest
     *
     * @param  array $with
     * @return mixed
     */
    protected function make(array $with = [])
    {
        return $this->model->with($with);
    }

    /**
     * Get Results by Page
     *
     * @param  int $page
     * @param  int $limit
     * @param  array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, $with = [])
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = [];

        $query = $this->make($with);

        $model = $query->skip($limit * ($page - 1))
            ->take($limit)
            ->get();

        $result->totalItems = $this->model->count();
        $result->items = $model->all();

        return $result;
    }

    /**
     * Return all results that have a required relationship
     *
     * @param string $relation
     */
    public function has($relation, array $with = [])
    {
        $entity = $this->make($with);

        return $entity->has($relation)->get();
    }

    /**
     * gets the column names of a DB table
     *
     * @param  array $excludes
     * @return mixed
     */
    public function getColumnNames($excludes = [])
    {
        return $this->model->getColumnNames($excludes);
    }

}
