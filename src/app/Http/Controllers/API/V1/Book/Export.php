<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Libs\Export\ExcelExport;
use App\Libs\Export\XMLExport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class Export extends BaseActions
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function exportBook(Request $request)
    {
        try {
            $rootUrl = 'http://'.$request->getHost().Config::get('app.server_root');
            $heading = [];
            $type = $request->query('type') ?? 'csv';

            if (! empty( $request->query('title')) && $request->query('title') == 1) {
                array_push($heading, 'Title');
            }
            if (! empty( $request->query('author')) && $request->query('author') == 1) {
                array_push($heading, 'Author');
            }

            $books = $this->repository->exportData($heading);

            if ($type == 'csv') {
                $fileName = '_books.csv';
                $export = new ExcelExport($books, $fileName, $heading);

            } else if ($type == 'xml') {
                $fileName = 'xml/_books.xml';

                $export = new XMLExport($books, $fileName);
            }
            $response['link'] = $rootUrl.$export->exicute();

            return responseSuccess($response);
        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseInternalServerError();
        }
    }
}
