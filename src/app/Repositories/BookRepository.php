<?php


namespace App\Repositories;


use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Support\Facades\Log;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    /**
     * BookRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $record
     * @return mixed
     */
    public function list(int $record)
    {
        try {
            $this->record = $record;
            $record != 0
                ? $books = $this->model->orderBy('created_at', 'desc')->paginate($this->record)
                : $books = $this->model->orderBy('created_at', 'desc')->get();
            return $books;
        } catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function addToList(array $data)
    {
        try {
            $book = $this->model->create($data);
            return $book;
        } catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
        }
    }

    public function deleteFromList(int $id)
    {
        // TODO: Implement deleteFromList() method.
    }

    public function sortByAuthorsOrNames(string $sortKey)
    {
        // TODO: Implement sortByAuthorsOrNames() method.
    }

    public function searchByTitleOrAuthor(string $searchType, string $searchKey)
    {
        // TODO: Implement searchByTitleOrAuthor() method.
    }

    public function exportCSVorXML(string $exportType, string $exportKey)
    {
        // TODO: Implement exportCSVorXML() method.
    }
}

