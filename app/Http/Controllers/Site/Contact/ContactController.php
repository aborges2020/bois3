<?php

namespace App\Http\Controllers\Site\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $seoTitle       = 'Contact';
        $seoDescription = 'Contact this site...';

        return view('site.contact.index', ['seoTitle' => $seoTitle, 'seoDescription' => $seoDescription]);
    }
}
