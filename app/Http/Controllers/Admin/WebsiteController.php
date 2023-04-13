<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Download;
use App\Models\Event;
use App\Models\Item;
use App\Models\News;
use App\Models\Player;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Shop\Slide;
use App\Models\ShopItem;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        return view('pages.admin.home');
    }

    public function indexSettings(){
        return view('pages.admin.settings', ['settings' => Setting::all()]);
    }

    public function indexItems(){
        //return items ordered by id desc paginated
        $items = ShopItem::orderBy('id', 'desc')->paginate(10);
        //get bonuses from storage/bonuses.json
        $bonuses = json_decode(file_get_contents(storage_path('bonuses.json')), true);
        return view('pages.admin.shop.items', ['items' => $items, 'bonuses' => $bonuses, 'subcategories' => Subcategory::all()]);
    }

    public function indexNews(){
        return view('pages.admin.news', ['articles' => News::orderBy('created_at', 'desc')->paginate(10)]);
    }

    public function indexEvents(){
        return view('pages.admin.events', ['events' => Event::orderBy('date', 'desc')->paginate(20)]);
    }

    public function indexDownloads(){
        return view('pages.admin.downloads', ['downloads' => Download::all()]);
    }

    public function indexSlides(){
        return view('pages.admin.slides', ['slides' => Slide::all(), 'subcategories' => Subcategory::all()]);
    }

    public function indexCategories(){
        return view('pages.admin.shop.categories', ['categories' => Category::all(), 'subcategories' => Subcategory::all()]);
    }

    public function indexPromocodes(){
        //paginate promocodes
        $promocodes = PromoCode::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.shop.promocodes', ['codes' => $promocodes]);
    }

    public function indexSubcategories(){
        return view('pages.admin.shop.subcategories', ['categories' => Category::all(), 'subcategories' => Subcategory::all()]);
    }

    public function indexPlayers(){
        return view('pages.admin.players', ['players' => Player::paginate(10)]);
    }

    public function searchPlayers(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);


        return view('pages.admin.players', ['players' => Player::where('name', 'LIKE', '%'.$validated['name'].'%')->paginate(10)]);
    }


}
