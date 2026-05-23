<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Support\Web\PortfolioPayloadBuilder;

class HomeController extends Controller
{
    public function __construct(protected PortfolioPayloadBuilder $payloadBuilder)
    {
    }

    public function index()
    {
        return view('web.pages.home-vue', [
            'payload' => $this->payloadBuilder->build(),
        ]);
    }

    public function about()
    {
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

        return redirect()->route('front.home', []);
    }
}

