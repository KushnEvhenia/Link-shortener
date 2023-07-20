<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Link;


class Redirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route()->parameter('id');

        $link_follows = Link::where('link_id', $id)->value('link_follows');

        Link::where('link_id', $id)->update(['link_follows'=>$link_follows+1]);

        $redirect = DB::table('links')->where('link_id', "$id")->value('link');

        return redirect($redirect); 
    }
}
