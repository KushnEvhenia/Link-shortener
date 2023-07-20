<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Link;

class ActionsController extends Controller
{
    public function destroy($id, $user_id){

        $user_id = (int)$user_id;
        $id = (int) $id;
        $auth_id = Auth::user()->id;
        if($auth_id == $user_id){

            Link::destroy($id);
            return redirect('/home');


        }else{

            return redirect('/');;
            
        }

    }

    public function index($link_id, $user_id){

        $user_id = (int)$user_id;
        $auth_id = Auth::user()->id;
        if($auth_id == $user_id){

            $link = Link::where('link_id', $link_id)->value('link');

            return view('edit', ['link_id'=>$link_id, 'link'=>$link]);

        }
        else{

            return redirect('/');;
            
        }

    }

    public function edit(Request $request, $link_id){

        $request->validate([
            'link'=>'url',
            'link_id'=>'unique:links',
        ]);
        
        Link::where('link_id', $link_id)->update(['link'=>$request->input('link'), 'link_id'=>str_replace(" ", '', $request->input('link_id'))]);

        $link = Link::where('link_id', $link_id)->value('link');

        return view('edit', ['link_id'=>$link_id, 'link'=>$link]);

    }
}
