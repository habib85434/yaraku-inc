<?php

namespace Tests\Unit\Books;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $expectedCode = 201;

    public function test_create_a_book_without_any_error()
    {
        $book['title'] = 'A Little Girl';
        $book['author'] = 'David Jonson';

        $response = $this->post($this->baseUrl, $book);

        $response->assertStatus($this->expectedCode);
        $this->assertEquals($this->expectedCode, $response['code']);
        $this->assertEquals(true, $response['success']);
        $this->assertNotEmpty($response['data']);
        $this->assertEquals($book['title'], $response['data']['book']['title']);
        $this->assertEquals($book['author'], $response['data']['book']['author']);
    }

    public function test_book_create_has_title_required()
    {
        $book['author'] = 'David Jonson';

        $response = $this->post($this->baseUrl, $book);

        $this->assertNotEquals($this->expectedCode, $response['code']);
        $this->assertEquals(false, $response['success']);
        $response->assertStatus(400);
        $this->assertEquals('The title field is required.', $response['data']['title'][0]);
    }

    public function test_book_create_title_may_not_be_greater_than_max_value()
    {
        $book['author'] = 'David Jonson';
        //title more than 60 char
        $book['title'] = 'It industry. Lorem Ipsum has been the industrys standard duyd';

        $response = $this->post($this->baseUrl, $book);

        $this->assertNotEquals($this->expectedCode, $response['code']);
        $this->assertEquals(false, $response['success']);
        $response->assertStatus(400);
        $this->assertEquals('The title may not be greater than 60 characters.', $response['data']['title'][0]);
    }


    public function test_book_create_has_author_required()
    {
        $book['title'] = 'How I Met Myself';

        $response = $this->post($this->baseUrl, $book);

        $this->assertNotEquals($this->expectedCode, $response['code']);
        $this->assertEquals(false, $response['success']);
        $response->assertStatus(400);
        $this->assertEquals('The author field is required.', $response['data']['author'][0]);
    }

    public function test_book_create_author_may_not_be_greater_than_max_value()
    {
        //author more than 50 char
        $book['author'] = 'Lorem Ipsum is simply dummy text of the printing an';

        $book['title'] = 'It industry. Lorem Ipsum has been the industrys';

        $response = $this->post($this->baseUrl, $book);

        $this->assertNotEquals($this->expectedCode, $response['code']);
        $this->assertEquals(false, $response['success']);
        $response->assertStatus(400);
        $this->assertEquals('The author may not be greater than 50 characters.', $response['data']['author'][0]);
    }
}
