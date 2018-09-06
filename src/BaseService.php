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
     * @var BaseRepository
     */
    protected $repo = null;

    protected abstract function getRepository();

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->repo = $this->getRepository();
    }

    /**
     * @param array $relations
     * @param array $columns
     * @return Collection
     */
    public function all(array $relations = [], array $columns = ['*']): Collection
    {
        return $this->repo->all($relations, $columns);
    }

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->repo->find($id, $columns);
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function first(array $columns = ['*'], array $relations = [])
    {
        return $this->repo->first($columns);
    }

    /**
     * @param null $limit
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function paginate($limit = null, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->repo->paginate($limit, $columns);
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
        return $this->repo->findBy($field, $value, $columns);
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getBy(array $where, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->repo->getBy($where, $columns, $relations);
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
        return $this->repo->getWhereIn($field, $values, $columns);
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getMultiWhere(array $where, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->repo->getMultiWhere($where, $columns, $relations);
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
        return $this->repo->getWhereNotIn($field, $values, $columns);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->repo->create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->repo->update($attributes, $id);
    }

    /**
     * @param array $where
     * @param array $inputs
     * @return bool
     */
    public function updateBy(array $where, array $inputs): bool
    {
        return $this->repo->updateBy($where, $inputs);
    }

    /**
     * @param string $field
     * @param array $values
     * @param array $inputs
     * @return bool
     */
    public function updateWhereIn(string $field, array $values, array $inputs): bool
    {
        return $this->repo->updateWhereIn($field, $values, $inputs);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repo->delete($id);
    }

}
