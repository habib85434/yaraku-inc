<?php


namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
     * @param array|null $data
     * @param int $record
     * @param string|null $sortKey
     * @return Builder[]|Collection|LengthAwarePaginator
     */
    public function list(array $data = null, int $record, string $sortKey = null, string $order)
    {
        $this->record = $record;
        $books = $this->model->query();

        if (!empty($data)) {
            if (!empty($data['title'])) {
                $val = $data['title'];
                $books->where('title', 'like', "%{$val}%");
            }
            if (!empty($data['author'])) {
                $val = $data['author'];
                $books->where('author', 'like', "%{$val}%");
            }
        }

        empty(!$sortKey)
            ? $books = $this->bookSorting($books, $sortKey, $order)
            : $books->orderBy('created_at', $order);

        $record != 0
            ? $books = $books->paginate($this->record)
            : $books = $books->get();

        return $books;
    }

    /**
     * @param object $books
     * @param string $sortKey
     * @return mixed
     */
    private function bookSorting(object $books, string $sortKey, $order)
    {
        return $sortKey == 'author' ? $this->sortByAuthor($books, $order) : $this->sortByTitle($books, $order);
    }

    /**
     * @param object $books
     * @param string $order
     * @return mixed
     */
    private function sortByAuthor(object $books, string $order)
    {
        return $books->orderBy('author', $order);
    }

    /**
     * @param object $books
     * @param string $order
     * @return mixed
     */
    private function sortByTitle(object $books, string $order)
    {
        return $books->orderBy('title', $order);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function addToList(array $data)
    {
        $book = $this->model->create($data);
        return $book;
    }

    /**
     * @param array $fields
     * @return Builder[]|Collection|null
     */
    public function exportData(array $fields)
    {
        $select = [];
        $books = $this->model->query();

        if (empty($fields)) {
            return null;
        }
        for ($i = 0; $i < count($fields); $i++) {
            array_push($select, strtolower($fields[$i]));
        }

        $books = $books->select($select)->get();
        return $books;
    }
}
