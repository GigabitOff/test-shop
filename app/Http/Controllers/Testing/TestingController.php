<?php

namespace App\Http\Controllers\Testing;

use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    public function index()
    {
        return view('testing.index');
    }

}
