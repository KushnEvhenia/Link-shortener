<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Link;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(Request $request){

        $link = $request->input('link');

        $uri = null;

        return view('welcome', ['link'=>$link, 'uri'=>$uri]);

    }

    public function process_form(Request $request){

        function get_id(){

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
            $randomString = '';
    
            get_id:
    
            for ($i = 0; $i < 10; $i++) {
    
                $index = rand(0, strlen($characters) - 1);
    
                $randomString .= $characters[$index];
    
            }
    
            if(Link::where('link_id', $randomString)->exists()){
    
                goto get_id;
    
            }
    
            else{
    
                return $randomString;
    
            }

        }

        $request->validate([
            'link'=>'required|url',
        ]);

        if(Auth::user() == null){

            $user_id = User::where('name', 'nobody')->value('id');

        }
        else{

            $user_id = Auth::user()->id;
            
        }

        if(Link::where('link', $request->input('link'))->where('user_id', $user_id)->exists()){

            $link_id = Link::where('link', $request->input('link'))->where('user_id', $user_id)->value('link_id');
            
            return view('welcome', ["link"=>$request->input('link'), "uri" => "/$link_id"]);

        }
        else{

            $id = get_id();

            $Link = new Link;

            $Link->link = $request->input('link');

            $Link->link_id = $id;

            $Link->user_id = $user_id;

            $Link->save();  

            return view('welcome', ["link"=>$request->input('link'), "uri" => "/$id"]);

        }

    }

}
