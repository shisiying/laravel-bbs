<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function purchase(Request $request)
    {
        dd($request->note_id);
    }
}
