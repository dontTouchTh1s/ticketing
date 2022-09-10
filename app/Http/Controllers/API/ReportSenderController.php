<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportSenderController extends Controller
{
    public function getSenderInfo(Request $request)
    {
        $a = $request;

        $info = [
            'content'
        ];
        $a = response()->json($info);
        return $a;
    }
}
