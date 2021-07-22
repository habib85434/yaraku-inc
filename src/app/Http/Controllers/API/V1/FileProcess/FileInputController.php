<?php

namespace App\Http\Controllers\API\V1\FileProcess;

use App\Http\Controllers\Controller;
use App\Services\FileProcess\InputedFileProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FileInputController extends Controller
{
    private $pathEndPoient = '\upload\files';
    private $publicPath ;

    public function __construct()
    {
        $this->publicPath = public_path();
    }

    public function fileReceive(Request $request)
    {
        try {

            $validation = $this->fileValidation($request);
            if ( $validation->fails() ) {
                return validationWithDetailsError($validation->errors());
            }
            $documents = [];
            $documents = $request->files;

            if (isset($documents)) {
                $i = 0;
                foreach ($documents as $document) {
                    if ($document[$i]->isValid()) {
                        $file_name = preg_replace('/\s+/', '',
                            time(). '_'.$document[$i]->getClientOriginalName()) ;

                        $path = $document[$i]->move($this->publicPath.$this->pathEndPoient, $file_name);
                    }

                    $fProcess = new InputedFileProcess($this->publicPath.$this->pathEndPoient, $file_name);
                    $fProcess->sheetProcess();

                    $i++;
                }
            }

            return responseOk();
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage().'. Location : '.$throwable->getFile() .' at line : '.$throwable->getLine());
            return responseCantProcess();
        }
    }

    /**
     * For validation
     *
     * @return Response
     */
    public function fileValidation(Request $request)
    {
        //Validate input fields
        $validator = Validator::make($request->all(), [
//            'file'             => 'required|mimes:csv',
            'files'             => 'required',
        ]);

        return $validator;
    }

    public function unlink($trainingList)
    {
        $file_path = $trainingList->documents;

        if ($file_path)
        {
            $file_path = public_path('uploads/training_documents/' . $file_path);
            if (file_exists($file_path))
            {
                unlink($file_path);
            }
        }
    }
}
