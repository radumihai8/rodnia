<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ShopItem;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index(){
        $items = ShopItem::orderBy('id', 'desc')->limit(18)->get();
        return view('shop.category.index', ['categories' => Category::All(), 'subcategories' => Subcategory::All(), 'items' => $items]);
    }

    public function show(Subcategory $subcategory){
        $items = ShopItem::where('subcategory_id', $subcategory->id)->get();
        return view('shop.subcategory.show', ['categories' => Category::All(), 'subcategories' => Subcategory::All(), 'items' =>  $items, 'category'=> Subcategory::find($subcategory->category_id),'subcategory' => $subcategory]);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required',
            //category id is required and exists in categories table
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->name = $validated['name'];
        $subcategory->category_id = $validated['category_id'];
        $subcategory->save();
        return back()->with('success', 'Subcategory updated');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $subcategory = new Subcategory();
        $subcategory->name = $validated['name'];
        $subcategory->category_id = $validated['category_id'];

        $subcategory->save();

        return back()->with('success', 'Subcategory created');
    }

    public function mostBought(){
        //select top transactions by item_id join items on items.id = transactions.item_id group by item_id order by count(*) desc limit 10
        $transactions = DB::table('transactions')
            ->select('item_id', DB::raw('count(*) as count'))
            ->groupBy('item_id')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $items = ShopItem::whereIn('id', $transactions->pluck('item_id'))->get();

        //create new subcategory with name 'Most bought'
        $subcategory = new Subcategory();
        $subcategory->name = 'Most bought';

        return view('shop.subcategory.show', ['categories' => Category::All(), 'subcategories' => Subcategory::All(), 'items' =>  $items, 'subcategory' => $subcategory]);
    }

    public function promotions(){


        //items where discount is not 0 and current date is between discount_start and discount_end
        $items = ShopItem::where('discount', '>', 0)->where('discount_start', '<=', date('Y-m-d H:i:s'))->where('discount_end', '>=', date('Y-m-d H:i:s'))->get();

        $limited_items = ShopItem::where('available_start', '<=', date('Y-m-d H:i:s'))->where('available_end', '>=', date('Y-m-d H:i:s'))->get();

        $limited_stock = ShopItem::whereNotNull('max_pcs_global')->get();

        //combine items and limited items
        $items = $items->merge($limited_items)->merge($limited_stock);
        $subcategory = new Subcategory();
        $subcategory->name = 'Discount items';

        return view('shop.subcategory.show', ['categories' => Category::All(), 'subcategories' => Subcategory::All(), 'items' =>  $items, 'category'=> Subcategory::find($subcategory->category_id),'subcategory' => $subcategory]);
    }



}
