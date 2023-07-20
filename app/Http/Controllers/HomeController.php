<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Link;

use Illuminate\Support\Facades\Auth;

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

        $user_id = Auth::user()->id;
        $links = Link::where('user_id', $user_id)->get();
        $links = $links->toArray();
        $mail = Auth::user()->email;
        $path = "/delete/$user_id";
        return view('home', ['links'=>$links, 'mail'=>$mail, 'user_id'=>$user_id]);

    }
}
