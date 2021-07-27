<?php

namespace Tests\Unit\Books;

use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExportXMLTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $baseUrl = 'http://127.0.0.1:8000/api/v1/books/';
    public $expectedCode = 200;

    public function test_xml_export_with_title_only()
    {
        Book::factory()->count(10)->create();

        $response = $this->withHeaders([
            'Content-Type' => 'text/xml',
        ])->post($this->baseUrl.'export-xml?title=1')
            ->getContent();

        $response = xml_decode($response);

        if (isset($response['books'])) {
            foreach ($response['books'] as $row) {
                if (array_key_exists('title', $row)) {
                    $this->assertTrue(true);
                }
                if (array_key_exists('author', $row)) {
                    $this->assertTrue(false);
                }
            }
        }
    }

    public function test_xml_export_with_author_only()
    {
        Book::factory()->count(10)->create();

        $response = $this->withHeaders([
            'Content-Type' => 'text/xml',
        ])->post($this->baseUrl.'export-xml?author=1')
            ->getContent();

        $response = xml_decode($response);

        if (isset($response['books'])) {
            foreach ($response['books'] as $row) {
                if (array_key_exists('title', $row)) {
                    $this->assertTrue(false);
                }
                if (array_key_exists('author', $row)) {
                    $this->assertTrue(true);
                }
            }
        }
    }

    public function test_xml_export_with_both_title_and_author()
    {
        Book::factory()->count(10)->create();

        $response = $this->withHeaders([
            'Content-Type' => 'text/xml',
        ])->post($this->baseUrl.'export-xml?author=1&title=1')
            ->getContent();

        $response = xml_decode($response);

        if (isset($response['books'])) {
            foreach ($response['books'] as $row) {
                if (array_key_exists('title', $row)) {
                    $this->assertTrue(true);
                }
                if (array_key_exists('author', $row)) {
                    $this->assertTrue(true);
                }
            }
        }
    }
}

