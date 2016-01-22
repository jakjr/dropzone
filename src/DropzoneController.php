<?php

namespace Jakjr\Dropzone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropzoneController extends Controller {

    public function uploadAttach(Request $request)
    {
        \Dropzone::upload($request);
    }

    public function deleteAttach(Request $request)
    {
        return \Dropzone::delete($request);
    }

}