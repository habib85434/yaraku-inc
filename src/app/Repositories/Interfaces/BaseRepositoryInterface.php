<?php


namespace App\Repositories\Interfaces;

/**
 *
 * Interface BaseRepositoryInterface
 * @package App\Repositories\RepositoryInterfaces
 */
interface BaseRepositoryInterface
{
    /**
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    public function all($orderBy = 'created_at', $order = 'desc');

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    public function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc');

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function storeAll(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
