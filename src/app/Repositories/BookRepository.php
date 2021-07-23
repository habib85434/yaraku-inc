<?php


namespace App\Repositories;


use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Sort\BookSorting;
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
     * @param string|null $sortKey
     * @return mixed
     */
    public function list(int $record, string $sortKey = null)
    {
        try {
            $this->record = $record;
            $books = $this->model->query();

            empty(!$sortKey)
                ? $books = $this->bookSorting($books, $sortKey)
                : $books->orderBy('created_at', 'desc');

            $record != 0
                ? $books = $books->paginate($this->record)
                : $books = $books->get();

            return $books;
        } catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
        }
    }

    /**
     * @param object $books
     * @param string $sortKey
     * @return mixed
     */
    private function bookSorting(object $books, string $sortKey)
    {
        return $sortKey == 'author' ? $this->sortByAuthor($books) : $this->sortByTitle($books);
    }

    /**
     * @param object $books
     * @return mixed
     */
    private function sortByAuthor(object $books)
    {
        return $books->orderBy('author', 'asc');
    }

    /**
     * @param object $books
     * @return mixed
     */
    private function sortByTitle(object $books)
    {
        return $books->orderBy('title', 'asc');
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

    public function searchByTitleOrAuthor(array $data, int $record, string $sortKey)
    {
        try {
            $this->record = $record;
            $books = $this->model->query();

            if (!empty($data['title'])) {
                $books->where('title', '=', $data['title']);
            }
            if (!empty($data['author'])) {
                $books->where('author', '=', $data['author']);
            }

            empty(!$sortKey)
                ? $books = $this->bookSorting($books, $sortKey)
                : $books->orderBy('created_at', 'desc');

            $record != 0
                ? $books = $books->paginate($this->record)
                : $books = $books->get();

            return $books;
        } catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
        }
    }

    public function exportCSVorXML(string $exportType, string $exportKey)
    {
        // TODO: Implement exportCSVorXML() method.
    }
}

