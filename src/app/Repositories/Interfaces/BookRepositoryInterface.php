<?php


namespace App\Repositories\Interfaces;


interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function list(array $data, int $record, string $sortKey);
    public function addToList(array $data);
    public function exportData(array $fields);
}

