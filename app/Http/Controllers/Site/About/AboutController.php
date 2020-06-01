<?php

namespace App\Http\Controllers\Site\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seoTitle       = 'About';
        $seoDescription = 'About this site...';

        return view('site.about.index', ['seoTitle' => $seoTitle, 'seoDescription' => $seoDescription]);
    }
}
