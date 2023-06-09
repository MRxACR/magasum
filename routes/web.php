<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FournisseurController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventaireController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ReformeController;
use App\Http\Controllers\SortieController;

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

Route::get('/', function () {
    return view('magasum');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('about', 'about')->name('about');

    // Route::group(['middleware' => ['permission:voir_articles']], function () {
    //     Route::resource('articles', ArticleController::class);
    // });



    // BASIC
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::delete('users/{id}', [UserController::class, 'softDelete'])->name('users.softDelete');
    Route::get('users_all', [UserController::class, 'users_all'])->name('users_all');
    Route::get('users/restore', [UserController::class, 'restoreAll'])->name('users.restore');



    // RESOURCE
    Route::resource('articles', ArticleController::class);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('sorties', SortieController::class);
    Route::resource('reformes', ReformeController::class);
    Route::resource('inventaires', InventaireController::class);
    Route::resource('commandes', CommandeController::class);
    Route::resource('receptions', ReceptionController::class);



    // API 
    Route::get('api/articles', [ArticleController::class, 'api_get_articles'])->name('api.get.articles');
    Route::post('api/articles/search', [ArticleController::class, 'api_search_articles'])->name('api.search.articles');
    Route::post('api/articles/search/2', [ArticleController::class, 'api_search_articles_2'])->name('api.search.articles.2');
    Route::get('api/home', [HomeController::class, 'api_get_home'])->name('api.get.home');
    Route::post('api/home/search', [HomeController::class, 'api_search_home'])->name('api.search.home');
    Route::post('api/articles/commandes/search', [CommandeController::class, 'api_get_commande'])->name('api.search.commande');



    // CUSTOM 
    Route::get('sorties/bs/{id}', [SortieController::class, 'bonSortie']);
    Route::get('sorties/pc/{id}', [SortieController::class, 'PriseCharge']);
    Route::put('sorties/{id}/signer', [SortieController::class, 'signer'])->name('signer');
    Route::delete('sorties/{id}/signer', [SortieController::class, 'unsigner'])->name('signer');
    Route::post('reformes/articles_expires', [ReformeController::class, 'articlesExpires'])->name('articlesExpires');


    Route::post('theme', [UserController::class, 'toggleTheme'])->name('toggle.theme');



    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('signal', [HomeController::class, 'signal'])->name("signal");
});
