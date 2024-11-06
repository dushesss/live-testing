<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function test()
    {
        $test = 'test';
        return view('main_page', compact('test'));

    }
}
