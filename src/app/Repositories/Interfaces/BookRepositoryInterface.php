<?php


namespace App\Repositories\Interfaces;


interface BookRepositoryInterface extends BaseRepositoryInterface
{
    public function list(int $record, string $sortKey);
    public function addToList(array $data);
    public function deleteFromList(int $id);
    public function sortByAuthorsOrNames(string $sortKey);
    public function searchByTitleOrAuthor(string $searchType, string $searchKey);
    public function exportCSVorXML(string $exportType, string $exportKey);
}

