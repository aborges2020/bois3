<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seoTitle       = 'Home';
        $seoDescription = 'Home this site...';

        return view('site.home.index', ['seoTitle' => $seoTitle, 'seoDescription' => $seoDescription]);
    }
}
