<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Update extends BaseActions
{
    public function changeAuthor(Request $request, $id)
    {
        try {
            $validation = $this->updateValidation($request);
            if ( $validation->fails() ) {
                return validationWithDetailsError($validation->errors());
            }

            $data['author']     = $request->author;
            $response['book'] = $this->repository->update($id, $data);

            return responseCreated($response);

        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseCantProcess();
        }
    }
}

