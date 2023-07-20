<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Resources\LinkResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkCollection;
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

        $links = Link::search($search)
            ->latest()
            ->paginate();

        return new LinkCollection($links);
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

        return new LinkResource($link);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Link $link
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Link $link)
    {
        $this->authorize('view', $link);

        return new LinkResource($link);
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

        return new LinkResource($link);
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

        return response()->noContent();
    }
}
