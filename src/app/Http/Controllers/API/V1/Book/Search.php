<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
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

            $sortKey = $request->query('sort');
            empty($request->query('record')) ? $record = 0 : $record = $request->query('record');

            if (isset($request->title)) {
                $title = $request->title;
            }
            if (isset($request->author)) {
                $author = $request->author;
            }

            $data['title'] = $title;
            $data['author'] = $author;

            $response['books'] = $this->repository->searchByTitleOrAuthor($data, $record, $sortKey);

            return responseOk($response);
        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseCantProcess();
        }
    }
}

