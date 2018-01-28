<?php namespace Emm\Precoz;

/**
 * Created by emmanuel <emmanuelbarturen@gmail.com>.
 * Date: 13/05/17
 */

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Base
 */
abstract class BaseService implements ICommonFunctions
{
    /**
     * @var null
     */
    protected $mainRepo = null;

    /**
     * BaseService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if ($this->mainRepo == null) {
            throw new Exception('mainRepository not found!');
        }
    }

    /**
     * @param array $relations
     * @param array $columns
     * @return Collection
     */
    public function all(array $relations = [], array $columns = ['*']): Collection
    {
        return $this->mainRepo->all($relations, $columns);
    }

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->mainRepo->find($id, $columns);
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function first(array $columns = ['*'], array $relations = [])
    {
        return $this->mainRepo->first($columns);
    }

    /**
     * @param null $limit
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function paginate($limit = null, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->mainRepo->paginate($limit, $columns);
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
        return $this->mainRepo->findBy($field, $value, $columns);
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getBy(array $where, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->mainRepo->getBy($where, $columns, $relations);
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
        return $this->mainRepo->getWhereIn($field, $values, $columns);
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getMultiWhere(array $where, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->mainRepo->getMultiWhere($where, $columns, $relations);
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
        return $this->mainRepo->getWhereNotIn($field, $values, $columns);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->mainRepo->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->mainRepo->update($attributes, $id);
    }

    /**
     * @param array $where
     * @param array $inputs
     * @return bool
     */
    public function updateBy(array $where, array $inputs): bool
    {
        return $this->mainRepo->updateBy($where, $inputs);
    }

    /**
     * @param string $field
     * @param array $values
     * @param array $inputs
     * @return bool
     */
    public function updateWhereIn(string $field, array $values, array $inputs): bool
    {
        return $this->mainRepo->updateWhereIn($field, $values, $inputs);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->mainRepo->delete($id);
    }

}
