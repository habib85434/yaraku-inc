<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
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
    public function __construct( BookRepository $repository )
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
            'title'         => 'required|present|max:60',
            'author'        => 'required|max:50'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function updateValidation ( Request $request )
    {
        return Validator::make($request->all(), [
            'author'        => 'required|max:50'
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function setHeadings(Request $request)
    {
        $heading = [];
        if (! empty( $request->query('title')) && $request->query('title') == 1) {
            array_push($heading, 'Title');
        }
        if (! empty( $request->query('author')) && $request->query('author') == 1) {
            array_push($heading, 'Author');
        }

        return $heading;
    }
}

