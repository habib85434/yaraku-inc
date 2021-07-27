<?php

namespace Tests\Unit\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $baseUrl = 'http://127.0.0.1:8000/api/v1/books/';
    public $expectedCode = 200;

    public function test_delete_book_without_any_error()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';

        $book_create_response = $this->post($this->baseUrl, $book);

        $response = $this->delete($this->baseUrl.$book_create_response['data']['book']['id']);

        $this->assertEquals($book['title'], $book_create_response['data']['book']['title']);
        $this->assertEquals($book['author'], $book_create_response['data']['book']['author']);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
    }

    public function test_delete_book_id_should_be_exist()
    {
        $response = $this->delete($this->baseUrl.'110');

        $this->assertEquals(404, $response['code']);
        $this->assertNotEquals($this->expectedCode, $response['code']);
        $this->assertEquals(404, 404);
        $this->assertEquals(false, $response['success']);
    }
}

