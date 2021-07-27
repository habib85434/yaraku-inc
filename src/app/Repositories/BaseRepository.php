<?php


namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var int
     */
    public $record = 15;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Carbon
     */
    function serverTime ()
    {
        return now();
    }

    /**
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    function all($orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->get();
    }

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->paginate($perPage);
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    function storeAll(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    function update($id, array $data)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        $result->update($data);
        return $this->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result->delete();
    }
}

