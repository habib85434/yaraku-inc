<?php

namespace App\Http\Controllers\Api\V1\Book;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Search extends BaseActions
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchBook(Request $request)
    {
        try {
            $data=[];
            $title = null;
            $author = null;
            $order = 'desc';

            $sortKey = $request->query('sort');
            empty($request->query('record')) ? $record = 0 : $record = $request->query('record');

            if (! empty($request->query('order'))) {
                $order = $request->query('order');
            }

            if (isset($request->title)) {
                $title = $request->title;
            }
            if (isset($request->author)) {
                $author = $request->author;
            }

            $data['title'] = $title;
            $data['author'] = $author;

            $response['books'] = $this->repository->list($data, $record, $sortKey, $order);

            return responseSuccess($response);
        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseInternalServerError();
        }
    }
}

