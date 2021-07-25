<?php

namespace App\Http\Controllers\Api\V1\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Store extends BaseActions
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBook(Request $request)
    {
        try {
            $validation = $this->storeValidation($request);
            if ( $validation->fails() ) {
                return responseValidationError($validation->errors());
            }

            $data = [];
            $data['title']      = $request->title;
            $data['author']     = $request->author;
            $response['book']   = $this->repository->addToList($data);

            return responseCreated($response);

        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseInternalServerError();
        }
    }
}

