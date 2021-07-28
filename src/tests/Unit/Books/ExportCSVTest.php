<?php

namespace Tests\Unit\Books;

use App\Models\Book;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExportCSVTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public $expectedCode = 200;

    public function test_csv_export_with_title_only()
    {
        $this->createBooks(10);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl.'export-csv?title=1')->getContent();

        $response = json_decode($response,true);

        $csvFile = $response['data']['link'];
        $csvData = $this->readCSV($csvFile,array('delimiter' => ','));

        if (! empty($csvData)) {
            foreach ($csvData as  $single_array) {
                if (is_array($single_array) && in_array("Title",$single_array)) {
                    $this->assertTrue(true);
                }
                if (is_array($single_array) && in_array("Author",$single_array)) {
                    $this->assertTrue(false);
                }
            }
        }
    }

    public function test_csv_export_with_author_only()
    {
        $this->createBooks(10);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl.'export-csv?author=1')->getContent();

        $response = json_decode($response,true);

        $csvFile = $response['data']['link'];
        $csvData = $this->readCSV($csvFile,array('delimiter' => ','));

        if (! empty($csvData)) {
            foreach ($csvData as $single_array) {
                if (is_array($single_array) && in_array("Title",$single_array)) {
                    $this->assertTrue(false);
                }
                if (is_array($single_array) && in_array("Author",$single_array)) {
                    $this->assertTrue(true);
                }
            }
        }
    }

    public function test_csv_export_with_both_title_and_author()
    {
        $this->createBooks(10);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl.'export-csv?author=1&title=1')->getContent();

        $response = json_decode($response,true);

        $csvFile = $response['data']['link'];
        $csvData = $this->readCSV($csvFile,array('delimiter' => ','));

        if (! empty($csvData)) {
            foreach ($csvData as $single_array) {
                if (is_array($single_array) && in_array("Title",$single_array)) {
                    $this->assertTrue(true);
                }
                if (is_array($single_array) && in_array("Author",$single_array)) {
                    $this->assertTrue(true);
                }
            }
        }
    }
}

