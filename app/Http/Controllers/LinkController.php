<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LinkStoreRequest;
use App\Http\Requests\LinkUpdateRequest;

class LinkController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Link::class);

        $search = $request->get('search', '');

        if($request->get('user') !== null){
            $user_id = $request->get('user');
            return redirect("/users/list/$user_id");
        }

        $links = Link::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();
        foreach($links as $link){
            $link->user_name = User::where('id', $link->user_id)->value('name');
        }
        $users = User::all();
        $users = $users->toarray();
        return view('app.links.index', compact('links', 'search'), ['users'=>$users]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Link::class);

        return view('app.links.create');
    }

    /**
     * @param \App\Http\Requests\LinkStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkStoreRequest $request)
    {
        $this->authorize('create', Link::class);

        $validated = $request->validated();

        $link = Link::create($validated);

        return redirect()
            ->route('links.edit', $link)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Link $link)
    {
        $this->authorize('view', $link);

        return view('app.links.show', compact('link'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Link $link)
    {
        $this->authorize('update', $link);

        return view('app.links.edit', compact('link'));
    }

    /**
     * @param \App\Http\Requests\LinkUpdateRequest $request
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function update(LinkUpdateRequest $request, Link $link)
    {
        $this->authorize('update', $link);

        $validated = $request->validated();

        $link->update($validated);

        return redirect()
            ->route('links.edit', $link)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Link $link)
    {
        $this->authorize('delete', $link);

        $link->delete();

        return redirect()
            ->route('links.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
