<?php

namespace Tests\Unit\Books;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ListTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $expectedCode = 200;

    public function test_books_list_sort_asc_by_title()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=title&order=asc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals($book['title'], $response['data']['books'][0]['title']);
        $this->assertDatabaseHas('books', [
            'title' => $book['title'],
        ]);
    }

    public function test_books_list_sort_desc_by_title()
    {
        $book['title'] = 'Zza Little Girl';
        $book['author'] = 'David Jonson';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=title&order=desc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals($book['title'], $response['data']['books'][0]['title']);
        $this->assertDatabaseHas('books', [
            'title' => $book['title'],
        ]);
    }

    public function test_books_list_not_sort_asc_by_title()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=title&order=desc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);

        $this->assertDatabaseHas('books', [
            'title' => $book['title'],
        ]);
        $this->assertNotEquals($book['title'], $response['data']['books'][0]['title']);
    }

    public function test_books_list_not_sort_desc_by_title()
    {
        $book['title'] = 'Zz Little Girl';
        $book['author'] = 'David Jonson';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=title&order=asc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertNotEquals($book['title'], $response['data']['books'][0]['title']);
        $this->assertDatabaseHas('books', [
            'title' => $book['title'],
        ]);
    }

    public function test_books_list_sort_asc_by_author()
    {
        $book['title'] = 'Red rose';
        $book['author'] = 'Aabanol Lie';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=author&order=asc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
        ]);
        $this->assertEquals($book['author'], $response['data']['books'][0]['author']);
    }

    public function test_books_list_not_sort_asc_by_author()
    {
        $book['title'] = 'Red rose';
        $book['author'] = 'Aabanol Lie';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=author&order=desc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
        ]);
        $this->assertNotEquals($book['author'], $response['data']['books'][0]['author']);
    }

    public function test_books_list_not_sort_by_author()
    {
        $book['title'] = 'Red rose';
        $book['author'] = 'Aabanol Lie';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=title&order=asc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
        ]);
        $this->assertNotEquals($book['author'], $response['data']['books'][0]['author']);
    }

    public function test_books_list_not_sort_by_title()
    {
        $book['title'] = 'A Red rose';
        $book['author'] = 'Zabanol Lie';
        $this->createBook($book);

        $this->createTestData();

        $response = $this->get($this->baseUrl.'?sort=author&order=asc');

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertDatabaseHas('books', [
            'author' => $book['author'],
        ]);
        $this->assertNotEquals($book['title'], $response['data']['books'][0]['title']);
    }

    public function test_check_pagination_records_is_correct()
    {
        $record = 15;
        Book::factory()->count(100)->create();

        $response = $this->get($this->baseUrl.'?record='.$record);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);

        $this->assertEquals($record, count($response['data']['books']['data']));
    }

    public function test_check_pagination_records_is_not_correct()
    {
        $record = 15;
        $wrontRecord = 10;
        Book::factory()->count(100)->create();

        $response = $this->get($this->baseUrl.'?record='.$record);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertNotEquals($wrontRecord, count($response['data']['books']['data']));
    }
}

