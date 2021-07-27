<?php

namespace Tests\Unit\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SearchTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $baseUrl = 'http://127.0.0.1:8000/api/v1/books/';
    public $expectedCode = 200;

    public function test_search_by_author()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';

        $book_create_response = $this->post($this->baseUrl, $book);

        $book_search['author'] = $book_create_response['data']['book']['author'];

        $response = $this->post($this->baseUrl.'search', $book_search);

        $this->assertEquals($book['title'], $book_create_response['data']['book']['title']);
        $this->assertEquals($book['author'], $book_create_response['data']['book']['author']);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertNotEmpty($response['data']['books']);
    }

    public function test_search_by_title()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';

        $book_create_response = $this->post($this->baseUrl, $book);

        $book_search['title'] = $book_create_response['data']['book']['title'];

        $response = $this->post($this->baseUrl.'search', $book_search);

        $this->assertEquals($book['title'], $book_create_response['data']['book']['title']);
        $this->assertEquals($book['author'], $book_create_response['data']['book']['author']);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertNotEmpty($response['data']['books']);
    }
}

