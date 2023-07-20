<?php

use App\Models\News;

//main
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('main'));
});

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('home'));
});

//auth
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('register', function ($trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

Breadcrumbs::for('password.request', function ($trail) {
    $trail->parent('login');
    $trail->push('Reset', route('password.request'));
});

//user
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.index'));
});

Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Create user', route('users.index'));
});

//links
Breadcrumbs::for('links.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Links', route('links.index'));
});

Breadcrumbs::for('links.create', function ($trail) {
    $trail->parent('links.index');
    $trail->push('Create link', route('links.index'));
});

Breadcrumbs::for('links.edit', function ($trail, $link) {
    $trail->parent('links.index');
    $trail->push($link->link_id, route('links.index'));
});

Breadcrumbs::for('links.show', function ($trail, $link) {
    $trail->parent('links.index');
    $trail->push($link->link_id, route('links.index'));
});

//news
Breadcrumbs::for('news.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('News', route('news.index'));
});

Breadcrumbs::for('news.edit', function ($trail, $id) {
    $trail->parent('news.index');
    $topic = News::where('id', $id)->value('title');
    $trail->push($topic, route('news.index'));
});

Breadcrumbs::for('news.create', function ($trail) {
    $trail->parent('news.index');
    $trail->push('Create', route('news.index'));
});

Breadcrumbs::for('news.show', function ($trail, $id) {
    $trail->parent('news.index');
    $topic = News::where('id', $id)->value('title');
    $trail->push($topic, route('news.index'));
});

Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');
    $trail->push('Info', route('news'));
});

Breadcrumbs::for('info', function ($trail, $id) {
    $trail->parent('news');
    $topic = News::where('id', $id)->value('title');
    $trail->push($topic, route('news'));
});

//roles
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push('Create a role', route('roles.create'));
});

Breadcrumbs::for('roles.show', function ($trail, $role) {
    $trail->parent('roles.index');
    $trail->push($role->name, route('roles.index'));
});

Breadcrumbs::for('roles.edit', function ($trail, $role) {
    $trail->parent('roles.index');
    $trail->push($role->name, route('roles.index'));
});

//permissions
Breadcrumbs::for('permissions.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Permissions', route('permissions.index'));
});

Breadcrumbs::for('permissions.edit', function ($trail, $permission) {
    $trail->parent('permissions.index');
    $trail->push($permission->name, route('permissions.index'));
});

Breadcrumbs::for('permissions.show', function ($trail, $permission) {
    $trail->parent('permissions.index');
    $trail->push($permission->name, route('permissions.index'));
});

//edit profile
Breadcrumbs::for('edit.profile', function ($trail, $user_id) {
    $trail->parent('dashboard');
    $trail->push('Edit profile', route('permissions.index'));
});