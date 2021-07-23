<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseActions extends Controller
{
    /**
     * @var BookRepositoryInterface
     **/
    protected $repository;

    /**
     * @param BookRepositoryInterface $repository
     */
    public function __construct( BookRepositoryInterface $repository )
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function storeValidation ( Request $request )
    {
        return Validator::make($request->all(), [
            'title'         => 'required|max:150',
            'author'        => 'required|max:100'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function updateValidation ( Request $request )
    {
        return Validator::make($request->all(), [
            'author'        => 'required|max:100'
        ]);
    }
}

