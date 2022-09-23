<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        return response()->json([
            'result' => 1,
            'message' => 'success',
            'data' => $request->lang
        ]);
    }
}