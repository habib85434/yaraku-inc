<?php


namespace App\Libs\Export;


use App\Exports\ExportBook;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExport
{
    /**
     * @var
     */
    private $data;

    /**
     * @var
     */
    private $fileName;

    /**
     * @var
     */
    private $heading;

    /**
     * ExcelExport constructor.
     * @param $data
     * @param $fileName
     * @param $heading
     */
    public function __construct($data, $fileName, $heading)
    {
        $this->data = $data;
        $this->fileName = $fileName;
        $this->heading = $heading;
    }

    /**
     * @return string
     */
    public function exicute()
    {
        delete_directory(storage_path().'\framework\laravel-excel');
        $file =  Excel::download(new ExportBook($this->data, $this->heading), $this->fileName);
        return '/storage/framework/laravel-excel/'.$file->getFile()->getFilename();
    }
}

