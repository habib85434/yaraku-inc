<?php

namespace App\Http\Controllers\Api\V1\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Update extends BaseActions
{
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeAuthor(Request $request, $id)
    {
        try {
            $validation = $this->updateValidation($request);
            if ($validation->fails()) {
                return responseValidationError($validation->errors());
            }

            $book = $this->repository->find($id);
            if (empty($book)) {
                return responseNoContent();
            }

            $data['author'] = $request->author;
            $response['book'] = $this->repository->update($id, $data);

            return responseSuccess($response);

        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage() . '. Location : ' . $throwable->getFile() . ' at line : '
                . $throwable->getLine());
            return responseInternalServerError();
        }
    }
}
