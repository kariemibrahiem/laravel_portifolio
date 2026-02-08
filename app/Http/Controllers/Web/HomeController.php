<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Skill;
use App\Models\Tech;

class HomeController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        $portfolios = Portfolio::orderBy('sort_order')->get();
        $skills = Skill::orderBy('sort_order')->get();
        $techs = Tech::orderBy('sort_order')->get();

        return view('web.pages.home', [
            'experiences' => $experiences,
            'portfolios' => $portfolios,
            'skills' => $skills,
            'techs' => $techs,
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

