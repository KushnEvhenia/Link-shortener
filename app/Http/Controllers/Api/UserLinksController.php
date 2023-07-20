<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\LinkResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkCollection;

class UserLinksController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $links = $user
            ->links()
            ->search($search)
            ->latest()
            ->paginate();

        return new LinkCollection($links);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Link::class);

        $validated = $request->validate([
            'link' => ['required', 'max:255', 'string'],
            'link_id' => ['required', 'max:255', 'string'],
        ]);

        $link = $user->links()->create($validated);

        return new LinkResource($link);
    }
}
