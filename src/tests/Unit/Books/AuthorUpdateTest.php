<?php

namespace Tests\Unit\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthorUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $baseUrl = 'http://127.0.0.1:8000/api/v1/books/';
    public $expectedCode = 200;

    public function test_update_author_name_without_any_error()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';

        $book_create_response = $this->post($this->baseUrl, $book);

        $book_updated['author'] = 'Heidy Chille';

        $response = $this->put($this->baseUrl.$book_create_response['data']['book']['id'],$book_updated);

        $this->assertEquals($book['title'], $book_create_response['data']['book']['title']);
        $this->assertEquals($book['author'], $book_create_response['data']['book']['author']);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertEquals($book_updated['author'], $response['data']['book']['author']);
    }

    public function test_update_author_is_required()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';

        $book_create_response = $this->post($this->baseUrl, $book);

        $response = $this->put($this->baseUrl.$book_create_response['data']['book']['id']);

        $this->assertEquals($book['title'], $book_create_response['data']['book']['title']);
        $this->assertEquals($book['author'], $book_create_response['data']['book']['author']);

        $this->assertEquals(400, $response['code']);
        $this->assertNotEquals($this->expectedCode, $response['code']);
        $this->assertEquals(false, $response['success']);
    }
}

