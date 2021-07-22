<?php

namespace App\Http\Controllers\API\V1\DataOperations\Search\Artiest;

use App\Http\Controllers\Controller;
use App\Models\MediaRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LabelWiseCommission extends Controller
{
    protected $pagination = 15;

    public function LabelWise(Request $request)
    {
        try {
            $startDate = isset($request->start_date) ? date('Y-m-d', strtotime($request->start_date))
                : date('Y-m-d');
            $endDate = isset($request->end_date) ? date('Y-m-d', strtotime($request->end_date))
                : date('Y-m-d');
            $label = isset($request->label_name) ? $request->label_name : null;
            $artist = isset($request->artiest_name) ? $request->artiest_name : null;

            $data = MediaRecord::query();

            if (! empty($label)) {
                $data->where(['label_name'=>$label]);
            }
            if (! empty($artist)) {
                $data->where(['artiest_names'=>$artist]);
            }

            $data->whereDate('sales_month', '>=', date('Y-m-d', strtotime($startDate)));
            $data->whereDate('sales_month', '<=', date('Y-m-d', strtotime($endDate)));

            $response['data'] = $data->paginate($this->pagination);

            return responseOk($response);

        }  catch (\Throwable $throwable) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseCantProcess();
        }
    }
}

