<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Serve the converted profile template home page
        return view('web.pages.home');
    }

    public function about()
    {
        // If an about page exists under resources/views/web/pages/about.blade.php
        if (view()->exists('web.pages.about')) {
            return view('web.pages.about');
        }

        abort(404);
    }

    public function projects()
    {
        if (view()->exists('web.pages.projects')) {
            return view('web.pages.projects');
        }

        abort(404);
    }

    public function blog()
    {
        if (view()->exists('web.pages.blog')) {
            return view('web.pages.blog');
        }

        abort(404);
    }

    public function contact()
    {
        if (view()->exists('web.pages.contact')) {
            return view('web.pages.contact');
        }

        // If no dedicated contact page, fallback to home anchor
        return redirect()->route('front.home', []);
    }
}
