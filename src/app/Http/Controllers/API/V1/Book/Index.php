<?php

namespace App\Http\Controllers\Api\V1\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Index extends BaseActions
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listBook(Request $request)
    {
        try {
            $order = 'desc';
            $sortKey = $request->query('sort');

            empty($request->query('record')) ? $record = 0 : $record = $request->query('record');
            if (!empty($request->query('order'))) {
                $order = $request->query('order');
            }

            $response['books'] = $this->repository->list(null, $record, $sortKey, $order);
            return responseSuccess($response);
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage() . '. Location : ' . $throwable->getFile() . ' at line : '
                . $throwable->getLine());
            return responseInternalServerError();
        }
    }
}
