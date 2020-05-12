<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Frankyso\Tokopedia\Selenium\TokopediaUploadProduct;
use Illuminate\Http\Request;

class UploadProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tokopedia = new TokopediaUploadProduct($request->all(), $request->get('browserId'));
        $tokopedia->execute();
    }
}
