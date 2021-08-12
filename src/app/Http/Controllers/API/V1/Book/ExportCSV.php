<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Libs\Export\ExcelExport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExportCSV extends BaseActions
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function exportCSVBook(Request $request)
    {
        try {
            $rootUrl = 'http://' . $request->getHost() . ':' . $request->getPort();
            $heading = $this->setHeadings($request);

            $books = $this->repository->exportData($heading);

            $fileName = '_books.csv';
            $export = new ExcelExport($books, $fileName, $heading);
            $response['link'] = $rootUrl . $export->exicute();

            return responseSuccess($response);
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage() . '. Location : ' . $throwable->getFile() . ' at line : '
                . $throwable->getLine());
            return responseInternalServerError();
        }
    }
}
