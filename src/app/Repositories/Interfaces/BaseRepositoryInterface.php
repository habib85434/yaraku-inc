<?php


namespace App\Repositories\Interfaces;

/**
 *
 * Interface BaseRepositoryInterface
 * @package App\Repositories\RepositoryInterfaces
 */
interface BaseRepositoryInterface
{
    function all($orderBy = 'created_at', $order = 'desc');
    function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc');
    function find($id);
    function store(array $data);
    function storeAll(array $data);
    function update($id, array $data);
    function delete($id);
}

