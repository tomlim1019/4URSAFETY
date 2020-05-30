<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile.profile')->with('profile', auth()->user());
    }

    public function editprofile()
    {
        return view('profile.editprofile')->with('profile', auth()->user());
    }

    public function test($request)
    {
        dd($request);
    }
}
