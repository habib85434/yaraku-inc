<?php


namespace App\Services\FileProcess;


use App\Imports\Medias\MediaExcelImport;
use App\Libs\StringOperations\MediaStringDataProcess;
use App\Models\MediaRecord;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class InputedFileProcess
{
    private $path;
    private $fileName;

    public function __construct($path, $fileName)
    {
        $this->path = $path;
        $this->fileName = $fileName;
    }

    public function sheetProcess()
    {
        $import = new MediaExcelImport();
//        Log::info('Processing file : '.$this->fileName);
        Excel::import($import , $this->path.'/'.$this->fileName, null);

        foreach ($import->getSheetData() as $key => $inventoryData){
            if ($key != 0) {
                if (! empty($inventoryData)) {
                    foreach ($inventoryData as $data) {
                        if (! empty($data)) {
                            $str = '';
                            foreach ($data as $row) {
                                if (! empty($row)) {
                                    $str .= $row;
                                }
                            }
                            $sOperation = new MediaStringDataProcess($str);
                            $iData = $sOperation->stringToArray();
                            $this->store($iData);
                        }
                    }
                }
            }
        }
    }

    private function store($data)
    {
//        Log::info('REPORTING MONTH: '. $data[1]);
//        CREATE DATABASE ix_st_hr_api WITH OWNER ix_hr_2021 ENCODING='UTF8' LC_COLLATE='en_US.utf8' LC_CTYPE='en_utf8';

        if (! empty($data)) {
            $iData = [];

            $iData['reporting_month'] = date('Y-m-d', strtotime($data[0]));
            $iData['sales_month'] = date('Y-m-d', strtotime($data[1]));
            $iData['platform'] = $data[2];
            $iData['country'] = $data[3];
            $iData['label_name'] = $data[4];
            $iData['artiest_names'] = $data[5];
            $iData['release_title'] = $data[6];
            $iData['track_title'] = $data[7];
            $iData['upc'] = $data[8];
            $iData['isrc'] = $data[9];
            $iData['release_catalog'] = $data[10];
            $iData['streaming_subscription_type'] = $data[11];
            $iData['release_type'] = $data[12];
            $iData['sales_type'] = $data[13];
            $iData['quantity'] = $data[14];
            $iData['client_payment_currency'] = $data[15];
            $iData['unit_price'] = number_format((float)$data[16],10);
            $iData['mechanical_fee'] = (int)$data[17];
            $iData['gross_revenue'] = number_format((float)$data[18],10);
            $iData['client_share_rate'] = number_format((float)$data[19],10);
            $iData['net_revenue'] = number_format((float)$data[20],10);

            MediaRecord::create($iData);
        }

    }
}

