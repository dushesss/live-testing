<?php

namespace App\Http\Controllers;

use Faker\Provider\ru_RU\Company;
use Faker\Provider\ru_RU\Address;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function test()
    {
        for ($i = 0; $i < 10 ; $i++){
            $test[] = Address::street();
        }

        return view('main_page', compact('test'));

    }
}
