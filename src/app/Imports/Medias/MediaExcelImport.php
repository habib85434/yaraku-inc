<?php


namespace App\Imports\Medias;


use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;

class MediaExcelImport implements ToArray, WithChunkReading
{
    public $sheetNames;
    public $sheetData;

    public function __construct(){
        $this->sheetNames = [];
        $this->sheetData = [];
    }

    public function array(array $array)
    {
        $this->sheetData[] = $array;

    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getSheetData(): array
    {
        return $this->sheetData;
    }
}

