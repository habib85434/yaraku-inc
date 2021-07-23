<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Index extends BaseActions
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookList (Request $request)
    {
        try {
            $sortKey = $request->query('sort');
            empty($request->query('record')) ? $record = 0 : $record = $request->query('record');
            $response['book_lists'] = $this->repository->list($record, $sortKey);

            return responseOk($response);
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseCantProcess();
        }
    }
}
