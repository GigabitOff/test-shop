<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\Page;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::where('slug','jobs')->where('status',1)->first();
        $vacancy = Vacancy::where('status',1)->get();
        if (!isset($page))
            return redirect('/'.app()->currentLocale());

        return view('jobs.index', compact('page','vacancy'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::where('slug', 'jobs')->where('status', 1)->first();
        $vacancy = Vacancy::where('status',1)->where('slug',$id)->first();
        if (!isset($vacancy))
            return redirect('/'. app()->currentLocale().'/jobs/');

        return view('jobs.show', compact('vacancy', 'page'));

    }
}
