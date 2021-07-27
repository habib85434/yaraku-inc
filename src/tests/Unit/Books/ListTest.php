<?php

namespace Tests\Unit\Books;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ListTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $baseUrl = 'http://127.0.0.1:8000/api/v1/books/';
    public $expectedCode = 200;

    public function test_create_sort_data()
    {
        $book1['title'] = 'How I Met Myself';
        $book1['author'] = 'David A Hill';
        $book2['title'] = 'The Tale of Peter Rabbit';
        $book2['author'] = 'Beatrix Potter';

        $this->createBook($book1);
        $this->createBook($book2);

        $this->assertDatabaseHas('books', [
            'title' => $book1['title'],
        ]);
    }

    public function test_books_list_sort_by_title()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';
        $this->createBook($book);

        $this->test_create_sort_data();

        $response = $this->get($this->baseUrl.'?sort=title');

        $this->assertDatabaseHas('books', [
            'title' => $book['title'],
        ]);
        $this->assertEquals($book['title'], $response['data']['books'][0]['title']);
        $this->assertEquals($this->expectedCode, $response['code']);
        $response->assertStatus($this->expectedCode);
    }

    public function test_books_list_not_sort_by_title()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';
        $this->createBook($book);

        $this->test_create_sort_data();

        $response = $this->get($this->baseUrl.'?sort=author');

        $this->assertDatabaseHas('books', [
            'title' => $book['title'],
        ]);
        $this->assertNotEquals($book['title'], $response['data']['books'][0]['title']);
        $this->assertEquals($this->expectedCode, $response['code']);
        $response->assertStatus($this->expectedCode);
    }

    public function test_books_list_sort_by_author()
    {
        $book['title'] = 'Red rose';
        $book['author'] = 'Aabanol Lie';
        $this->createBook($book);

        $this->test_create_sort_data();

        $response = $this->get($this->baseUrl.'?sort=author');

        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
        ]);
        $this->assertEquals($book['title'], $response['data']['books'][0]['title']);
        $this->assertEquals($this->expectedCode, $response['code']);
        $response->assertStatus($this->expectedCode);
    }

    public function test_books_list_not_sort_by_author()
    {
        $book['title'] = 'Red rose';
        $book['author'] = 'Aabanol Lie';
        $this->createBook($book);

        $this->test_create_sort_data();

        $response = $this->get($this->baseUrl.'?sort=title');

        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
        ]);
        $this->assertNotEquals($book['author'], $response['data']['books'][0]['author']);
        $this->assertEquals($this->expectedCode, $response['code']);
        $response->assertStatus($this->expectedCode);
    }

    public function test_check_pagination_records_is_correct()
    {
        $record = 15;
        Book::factory()->count(100)->create();

        $response = $this->get($this->baseUrl.'?record='.$record);

        $this->assertEquals($record, count($response['data']['books']['data']));
        $this->assertEquals($this->expectedCode, $response['code']);
        $response->assertStatus($this->expectedCode);
    }

    public function test_check_pagination_records_is_not_correct()
    {
        $record = 15;
        $wrontRecord = 10;
        Book::factory()->count(100)->create();

        $response = $this->get($this->baseUrl.'?record='.$record);

        $this->assertNotEquals($wrontRecord, count($response['data']['books']['data']));
        $this->assertEquals($this->expectedCode, $response['code']);
    }

    /**
     * @param string $title
     * @param string $author
     * @return void
     */
    public function createBook(array $book)
    {
        Book::create($book);
    }
}

