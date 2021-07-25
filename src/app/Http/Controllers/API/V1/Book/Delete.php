<?php

namespace App\Http\Controllers\Api\V1\Book;

use Illuminate\Support\Facades\Log;

class Delete extends BaseActions
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyBook($id)
    {
        try {
            $book = $this->repository->find($id);
            if (empty($id)) {
                return responseValidationError(null,'The book ID should not be null');
            }
            if (empty($book)) {
                return responseNoContent('The given book could not found !');
            }

            $this->repository->delete($id);
            return responseDeleted();
        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseInternalServerError();
        }
    }
}

