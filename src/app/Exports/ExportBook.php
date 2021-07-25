<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBook implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
     * @var
     */
    private $data;

    /**
     * @var
     */
    private $headings;

    /**
     * ExportBook constructor.
     * @param $data
     * @param $headings
     */
    public function __construct($data, $headings)
    {
        $this->data = $data;
        $this->headings = $headings;
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return $this->headings;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return json_decode(json_encode($this->data), True);
    }
}

