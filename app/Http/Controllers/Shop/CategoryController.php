<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Shop\Slide;
use App\Models\ShopItem;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $items = ShopItem::orderBy('id', 'desc')->limit(18)->get();
        $slides = Slide::all();
        return view('shop.category.index', ['categories' => Category::All(), 'items' => $items, 'slides' => $slides]);
    }

    public function show(Category $category){
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        //get items with subcategory_id in $subcategories
        $items = ShopItem::whereIn('subcategory_id', $subcategories->pluck('id'))->get();

        return view('shop.category.show', ['categories' => Category::All(), 'items' =>  $items, 'category' => $category, 'subcategories' => $subcategories]);
    }

    public function showAll(){
        #$items = ShopItem::where('category_id', $category->id)->get();
        return view('shop.category.all', ['categories' => Category::All(), 'subcategories' => Subcategory::All()]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $category->name = $validated['name'];
        $category->save();
        return back()->with('success', 'Category updated');
    }

    public function store(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $validated['name'];
        $category->save();
        return back()->with('success', 'Category created');
    }
}
