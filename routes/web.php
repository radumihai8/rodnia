<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\PromoCodesController;
use App\Http\Controllers\Shop\ShopItemController;
use App\Http\Controllers\Shop\SlidesController;
use App\Http\Controllers\Shop\SubcategoryController;
use App\Http\Controllers\Shop\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);
Route::get('register/{refferer_id?}', [RegisterController::class, 'showRegistrationForm'])->name('register');


Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'fr', 'pl', 'ro', 'tr', 'cz', 'it'])) {
        abort(400);
    }

    session()->put('locale', $locale);

    return back();
});

Route::get('/', [NewsController::class, 'index'])->name('index');
Route::get('/home', [NewsController::class, 'index'])->name('home');

Route::get('/user', [UserController::class, 'index'])->name('user');

//get tos page return tos view
Route::get('/tos', function () {return view('pages.tos');})->name('tos');
Route::get('/privacy', function () {return view('pages.privacy');})->name('privacy');


Route::get('/ranking/players', [PlayerController::class, 'ranking'])->name('ranking.players');
Route::post('/ranking/players', [PlayerController::class, 'search']);

Route::get('/ranking/guilds', [GuildController::class, 'ranking'])->name('ranking.guilds');
Route::post('/ranking/guilds', [GuildController::class, 'search']);

Route::get('/ranking/pets', [PetController::class, 'ranking'])->name('ranking.pets');
Route::post('/ranking/pets', [PetController::class, 'search']);

Route::get('/download', [DownloadController::class, 'index'])->name('download');

Route::post('/debug/{player}', [PlayerController::class, 'debug'])->name('debug');



Route::middleware('auth')->group(function () {
    Route::get('referrals',[ReferralController::class, 'index'])->name('referrals');
    Route::post('referrals',[ReferralController::class, 'claim']);

    Route::post('/forgot-password', [UserController::class, 'resetPassword'])->name('password.email');
    Route::post('/forgot-charcode', [UserController::class, 'sendCharcode'])->name('user.charcode');
});

Route::resource('news', NewsController::class);
Route::resource('download', DownloadController::class);

Route::middleware('can:admin')->group(function () {

    Route::resource('events', EventController::class);
    Route::resource('slides', SlidesController::class);

    Route::get('/admin', [WebsiteController::class, 'index'])->name('admin.home');
    Route::get('/admin', [WebsiteController::class, 'index'])->name('admin.home');

    Route::get('/admin/downloads', [WebsiteController::class, 'indexDownloads'])->name('admin.download');
    Route::get('/admin/news', [WebsiteController::class, 'indexNews'])->name('admin.news');
    Route::get('/admin/events', [WebsiteController::class, 'indexEvents'])->name('admin.events');
    Route::get('/admin/slides', [WebsiteController::class, 'indexSlides'])->name('admin.slides');
    Route::get('/admin/settings', [WebsiteController::class, 'indexSettings'])->name('admin.settings');


    Route::get('/admin/players', [WebsiteController::class, 'indexPlayers'])->name('admin.players');
    Route::post('/admin/players', [WebsiteController::class, 'searchPlayers'])->name('admin.players.search');
    Route::post('/player/ban', [PlayerController::class, 'ban'])->name('admin.ban');
    Route::post('/player/unban/{account}', [PlayerController::class, 'unban'])->name('admin.unban');
});


########################################################################################################################
#                                               Itemshop                                                               #
########################################################################################################################

Route::group(['as' => 'shop.', 'prefix' => 'shop', 'middleware' => ['auth']], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('home');
    Route::get('/history', [TransactionController::class, 'index'])->name('history');
    Route::get('/redeem', [PromoCodesController::class, 'index'])->name('redeem.index');
    Route::post('/redeem', [PromoCodesController::class, 'redeem'])->name('redeem.redeem');
    Route::post('/item/{item}', [ShopItemController::class, 'buy']);
    Route::resource('category', CategoryController::class);
    Route::resource('promocode', PromoCodesController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::get('/all', [CategoryController::class, 'showAll'])->name('items.all');

    //Special subcategories
    Route::get('most-bought', [SubcategoryController::class, 'mostBought'])->name('subcategory.mostbought');
    Route::get('promotions', [SubcategoryController::class, 'promotions'])->name('subcategory.promotions');

    //Search route
    Route::post('/search', [ShopItemController::class, 'search'])->name('search');

    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/items', [WebsiteController::class, 'indexItems'])->name('admin.items');
        Route::post('/admin/items', [ShopItemController::class, 'store'])->name('admin.items.store');

        Route::get('/admin/item/{shop_item}', [ShopItemController::class, 'editItem'])->name('admin.item.edit');
        Route::post('/admin/item/{shop_item}', [ShopItemController::class, 'update'])->name('admin.item.edit');

        Route::get('/admin/promocodes', [WebsiteController::class, 'indexPromocodes'])->name('admin.promocodes');
        Route::get('/admin/categories', [WebsiteController::class, 'indexCategories'])->name('admin.categories');
        Route::get('/admin/subcategories', [WebsiteController::class, 'indexSubcategories'])->name('admin.subcategories');
    });
});



