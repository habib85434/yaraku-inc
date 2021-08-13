<?php


namespace App\Repositories\Interfaces;

interface BookRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param array $data
     * @param int $record
     * @param string $sortKey
     * @param string $order
     * @return mixed
     */
    public function list(array $data, int $record, string $sortKey, string $order);

    /**
     * @param array $data
     * @return mixed
     */
    public function addToList(array $data);

    /**
     * @param array $fields
     * @return mixed
     */
    public function exportData(array $fields);
}
