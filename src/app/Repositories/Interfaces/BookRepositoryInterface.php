<?php


namespace App\Repositories\Interfaces;


interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function list(int $record, string $sortKey);
    public function addToList(array $data);
    public function searchByTitleOrAuthor(array $data, int $record, string $sortKey);
    public function exportData(array $fields);
}

