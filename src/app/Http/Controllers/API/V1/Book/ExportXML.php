<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExportXML extends BaseActions
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function exportXMLBook(Request $request)
    {
        try {
            $heading = $this->setHeadings($request);

            $books = $this->repository->exportData($heading);

            $xmlData =  response()->xml(['books' => $books->toArray()]);

            return $xmlData;

        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseInternalServerError();
        }
    }
}
