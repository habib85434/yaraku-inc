<?php

namespace Tests;

use App\Models\Book;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://127.0.0.1:8000/api/v1/books/';

    /**
     * @param array $book
     * @return void
     */
    public function createBook(array $book)
    {
        Book::create($book);
    }

    /**
     *  Create manually test data
     */
    public function createTestData()
    {
        $book1['title'] = 'How I Met Myself';
        $book1['author'] = 'David A Hill';
        $book2['title'] = 'The Tale of Peter Rabbit';
        $book2['author'] = 'Beatrix Potter';

        $this->createBook($book1);
        $this->createBook($book2);
    }

    /**
     * @param $csvFile
     * @param $array
     * @return array
     */
    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }

    /**
     * @param int $count
     */
    public function createBooks(int $count = 10)
    {
        Book::factory()->count($count)->create();
    }
}

