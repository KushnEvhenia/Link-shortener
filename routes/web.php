<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\EditUserController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('main');

Route::post('/', [MainController::class, 'process_form']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/info', [NewsController::class, 'show_info'])->name('news');

Route::get('/info/{id}', [NewsController::class, 'release'])->name('info');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::get('/users/list/{id}', [UserController::class, 'list_links']);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('links', LinkController::class);

        Route::get('/news', [NewsController::class, 'index'])->name('news.index');

        Route::get('/news/create', [NewsController::class, 'show_creation_form'])->name('news.create');
        Route::post('/news/create', [NewsController::class, 'create']);

        Route::get('/news/{id}/delete', [NewsController::class, 'destroy']);

        Route::get('/news/{id}', [newsController::class, 'show'])->name('news.show');

        Route::get('/news/{id}/edit', [NewsController::class, 'show_edition_form'])->name('news.edit');
        Route::post('/news/{id}/edit', [NewsController::class, 'edit']);

        Route::get('/delete/{id}/{user_id}', [ActionsController::class, 'destroy']);

        Route::get('/edit/{link_id}/{user_id}', [ActionsController::class, 'index']);
        Route::post('/edit/{link_id}/{user_id}', [ActionsController::class, 'edit']);

        Route::get('/profile/{user_id}', [UserController::class, 'edit_profile'])->name('edit.profile');
        Route::post('/profile/{user_id}', [UserController::class, 'save_changes']);

        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () { '\vendor\UniSharp\LaravelFilemanager\Lfm::routes()'; });
    });

Route::get('/{id}', function($id){})->middleware('redirect');

