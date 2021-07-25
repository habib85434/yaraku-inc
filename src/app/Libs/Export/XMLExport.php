<?php


namespace App\Libs\Export;

use Illuminate\Support\Facades\Storage;
use ZipArchive;


class XMLExport
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
     * XMLExport constructor.
     * @param $data
     * @param $fileName
     */
    public function __construct($data, $fileName)
    {
        $this->data = $data;
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function exicute()
    {
        delete_directory(storage_path().'\app\xml');
        $xmlData =  response()->xml(['users' => $this->data->toArray()]);
        Storage::disk('local')->put($this->fileName, $xmlData);

        $zip = new ZipArchive();
        if ($zip->open(storage_path().'/app/xml/_books.zip', ZipArchive::CREATE) == true) {
            $path = storage_path().'/app/xml/_books.xml';
            $zip->addFile( $path, '_books.xml');
            $zip->close();
        }
        return '/storage/app/xml/_books.zip';
    }
}

