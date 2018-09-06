<?php namespace Emm\Precoz;

/**
 * Created by emmanuel <emmanuelbarturen@gmail.com>.
 * Date: 13/05/17
 */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package Emm\Precoz
 */
abstract class BaseRepository implements ICommonFunctions
{

    /**
     * @var null
     */
    var $model = null;

    /**
     * @return mixed
     */
    protected abstract function getMainModel();

    /**
     * BaseRepository constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->model = $this->getMainModel();
    }

    /**
     * @param array $relations
     * @param array $columns
     * @return Collection
     */
    public function all(array $relations = [], array $columns = ['*']): Collection
    {
        return $this->model->with($relations)->get();
    }

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->model->select($columns)->with($relations)->find($id);
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function first(array $columns = ['*'], array $relations = [])
    {
        return $this->model->select($columns)->with($relations)->first();
    }

    /**
     * @param null $limit
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function paginate($limit = null, array $columns = ['*'], array $relations = []): Collection
    {
        // TODO: Implement paginate() method.
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param array $columns
     * @param array $relations
     * @return mixed
     */
    public function findBy(string $field, $value, $columns = ['*'], array $relations = [])
    {
        return $this->model->select($columns)->with($relations)->where($field, $value)->first();
    }


    /**
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Collection
     * @throws \Exception
     */
    public function getBy(array $where, array $columns = ['*'], array $relations = []): Collection
    {
        $params = $this->parseWhereParams($where);
        return $this->model->select($columns)->with($relations)->where($params['field'], $params['comparator'],
            $params['value'])->get();
    }

    /**
     * @param string $field
     * @param array $values
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getWhereIn(string $field, array $values, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->select($columns)->with($relations)->whereIn($field, $values)->get();
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Collection
     * @throws \Exception
     */
    public function getMultiWhere(array $where, array $columns = ['*'], array $relations = []): Collection
    {
        $query = $this->model->query();

        foreach ($where as $item) {
            $params = $this->parseWhereParams($item);
            $query->where($params['field'], $params['comparator'], $params['value']);
        }

        return $query->select($columns)->with($relations)->get();
    }

    /**
     * @param array $where
     * @return array
     * @throws \Exception
     */
    private function parseWhereParams(array $where)
    {
        $params = [];
        if (count($where) == 2) {
            $params['field'] = $where[0];
            $params['comparator'] = '=';
            $params['value'] = $where[1];
        } elseif (count($where) == 3) {
            $params['field'] = $where[0];
            $params['comparator'] = $where[1];
            $params['value'] = $where[2];
        } else {
            throw new \Exception('Wrong Parameters, check [column,value] or [column,comparator,value] in query');
        }

        return $params;
    }

    /**
     * @param string $field
     * @param array $values
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getWhereNotIn(
        string $field,
        array $values,
        array $columns = ['*'],
        array $relations = []
    ): Collection {
        return $this->model->select($columns)->with($relations)->whereNotIn($field, $values)->get();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param array $where
     * @param array $inputs
     * @return bool
     */
    public function updateBy(array $where, array $inputs): bool
    {
        if (count($where) == 2) {
            $field = $where[0];
            $comparator = '=';
            $value = $where[1];
        } else {
            $field = $where[0];
            $comparator = $where[1];
            $value = $where[2];
        }

        return $this->model->where($field, $comparator, $value)->update($inputs);
    }

    /**
     * @param string $field
     * @param array $values
     * @param array $inputs
     * @return bool
     */
    public function updateWhereIn(string $field, array $values, array $inputs): bool
    {
        return $this->model->whereIn($field, $values)->update($inputs);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

}
