<?php

namespace App\Http\Controllers\Site\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seoTitle       = 'FAQ';
        $seoDescription = 'FAQ this site...';

        return view('site.faq.index', ['seoTitle' => $seoTitle, 'seoDescription' => $seoDescription]);
    }
}
