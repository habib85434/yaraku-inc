<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Delete extends BaseActions
{
    public function destroy($id)
    {
        try {
            $book = $this->repository->find($id);
            if (empty($id)) {
                return validationError('The book ID should not be null');
            }
            if (empty($book)) {
                return validationError('The book could not found !');
            }

            $this->repository->delete($id);
            return responseDeleted();
        }  catch ( \Throwable $throwable ) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '
                .$throwable->getLine());
            return responseCantProcess();
        }
    }
}
