<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Link;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.users.index', compact('users', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $roles = Role::get();

        return view('app.users.create', compact('roles'));
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::get();

        return view('app.users.edit', compact('user', 'roles'));
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function list_links($id){

        if(Auth::user()->email == 'admin@admin.com'){
            $user = User::where('id', $id)->value('name');
            $links = Link::all()->where('user_id', $id);
            $links = $links->toArray();
            return view('list_links', ['user'=>$user, 'links'=>$links]);

        }
        else{

            redirect('/');

        }

    }
    public function edit_profile($user_id){

        if(Auth::user()->id == $user_id){

            $name = User::where('id', $user_id)->value('name');

            return view('editprofile', ['name'=>$name, 'user_id'=>$user_id, 'msg' =>'']);

        }else{

            return redirect('/');

        }
    }

    public function save_changes(Request $request, $user_id){

        $request->validate([
            'name'=>'required',
            'password'=>'required|min:8',
            'confirmed_password'=>'required|min:8',
        ]);

        if($request->input('password') !== $request->input('confirmed_password')){
            $name = User::where('id', $user_id)->value('name');
            $msg= 'Passwords do not match';
            return view('editprofile', ['name'=>$name, 'user_id'=>$user_id, 'msg'=>$msg]);
        }
        else{
            User::where('id', $user_id)->update(['name'=>$request->input('name'), 'password'=>Hash::make($request->input('password'))]);
            $name = User::where('id', $user_id)->value('name');
            return view('editprofile', ['name'=>$name, 'user_id'=>$user_id, 'msg'=>'']);
        }
        
    }


}
