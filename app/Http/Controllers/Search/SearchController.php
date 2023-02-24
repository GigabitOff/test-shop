<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $data = [];
        $page = [];


        return view('search.index', compact('data','page'));

    }

    public function show($search)
    {
        $data = [];
        $page = [];


        return view('search.index', compact('data','page','search'));

    }
}
