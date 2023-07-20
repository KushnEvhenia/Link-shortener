<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

use Illuminate\Support\Facades\Auth;

use File;

use \Debugbar;

class NewsController extends Controller
{
    public function index(Request $request){

        if(Auth::user()->email == 'admin@admin.com'){
            $search = $request->get('search', '');
            $news = News::search($search)
                ->latest()
                ->paginate(5)
                ->withQueryString();
            //Debugbar::info('Returning view news...');
            return view('news', ['news'=>$news]);
        }
        else{
            return redirect('/');
        }
            
    }

    public function show_creation_form(Request $request){

        if(Auth::user()->email == 'admin@admin.com'){
            return view('news_create', ['input'=>$request->input('description')]);
        }
        else{
            return redirect('/');
        }

    }  

    public function create(Request $request){
        $request->validate([
            'topic' => ['required'],
            'content' => ['required'],
        ]);
        $news = new News;
        $news->title = $request->input('topic');
        $news->text = $request->input('content');
        if(is_null($request->input('image'))){
            $news->path_to_image = $request->input('image');
        }
        else{
            $news->path_to_image = 'http://127.0.0.1:8000' . $request->input('image');
        }
        $news->save();
        return view('news_create');
    
    }

    public function show_info(Request $request){

        $search = $request->get('search', '');
            $news = News::search($search)
                ->latest()
                ->paginate(5)
                ->withQueryString();
        $desc = 'Read more...';
        return view('info', ['news'=>$news, 'desc'=>$desc]);

    }

    public function destroy($id){

        if(Auth::user()->email == 'admin@admin.com'){
            News::destroy($id);
            return redirect('/news');
        }
        else{
            return redirect('/');
        }

    }

    public function show_edition_form(Request $request, $id){

        if(Auth::user()->email == 'admin@admin.com'){
            $title = News::where('id', $id)->value('title');
            $text = News::where('id', $id)->value('text');
            return view('edit_news', ['title'=>$title, 'text'=>$text, 'id'=>$id]);
        }
        else{
            return redirect('/');
        }

    }
    
    public function edit(Request $request, $id){

        if(Auth::user()->email == 'admin@admin.com'){

        News::where('id', $id)->update(['title'=>$request->input('title'), 'text'=>$request->input('text')]);

        $title = News::where('id', $id)->value('title');
        $text = News::where('id', $id)->value('text');
        return view('edit_news', ['title'=>$title, 'text'=>$text, 'id'=>$id]);
        }
        else{
            return redirect('/');
        }

    }

    public function show($id){

        if(Auth::user()->email == 'admin@admin.com'){
            $title = News::where('id', $id)->value('title');
            $text = News::where('id', $id)->value('text');
            return view('show_news', ['title'=>$title, 'text'=>$text, 'id'=>$id]);
        }
        else{
            return redirect('/');
        }
        
    }

    public function release($id){

       $title =  News::where('id', $id)->value('title');
       $text =  News::where('id', $id)->value('text');
       $path = News::where('id', $id)->value('path_to_image');
       return view('release', ['path'=>$path, 'title'=>$title, 'text'=>$text, 'id'=>$id]);

    }
}
