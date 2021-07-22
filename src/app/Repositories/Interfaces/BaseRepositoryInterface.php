<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

/**
 *
 * Interface BaseRepositoryInterface
 * @package App\Repositories\RepositoryInterfaces
 */
interface BaseRepositoryInterface
{
    function all($orderBy = 'created_at', $order = 'desc');

    function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc');
    public function paginateByUser($userId, $perPage = 15, $orderBy = 'created_at', $order = 'desc');

    function find($id);
    function findByUser($id, $userId);

    function store(array $data);
    function storeAll(array $data);

    function update($id, array $data);
    function updateByUser($id, array $data, $userId);


    function delete($id);
    function deleteByUser($id, $userId);

    function userByEmail(string $email);
    function userActive ( int $id );

    function actionLog( array $data );
    function appLog( array $data );
    function accessToken(array $data, int $userId);

    function breederById(int $userId);
    function breeder(int $id);

    function customerById(int $userId);
    function findCustomer(int $id);
}
