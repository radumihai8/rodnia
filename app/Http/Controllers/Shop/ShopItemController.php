<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemProto;
use App\Models\ShopItem;
use App\Models\Subcategory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class ShopItemController extends Controller
{
    public function buy(ShopItem $item, Request $request){

        //validate the request
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$item->max_pcs,
        ]);

        $count_history = $item->countHistory();
        $global_count_history = $item->countHistoryGlobal();

        if($item->max_pcs_account && $count_history + $validated['quantity'] > $item->max_pcs_account){
            return redirect()->back()->with('error', 'You cannot buy more than '.$item->max_pcs_account.' items of this type per account. You already have bought '.$count_history.' items of this type.');
        }

        if($item->max_pcs_global && $global_count_history + $validated['quantity'] > $item->max_pcs_global){
            return redirect()->back()->with('error', 'Not enough stock!');
        }

        if($item->discount > 0 && $item->discount_start <= date('Y-m-d H:i:s') && $item->discount_end >= date('Y-m-d H:i:s')){
            $item->price = round($item->price * (1 - $item->discount / 100));
        }

        if($item->coin == "MD")
            $user_coins = auth()->user()->coins;
        else
            $user_coins = auth()->user()->jcoins;

        if($user_coins < $item->price * $validated['quantity']){
            return redirect()->back()->with('error', 'You do not have enough money to buy this item.');
        }

        Transaction::create([
            'account_id' => auth()->user()->id,
            'action' => 'Buy',
            'quantity' => $validated['quantity'],
            'item_id' => $item->id,
            'item_vnum' => $item->vnum,
            'object' => $item->proto->locale_name,
            'sum' => $item->price * $validated['quantity'],
            'coin' => $item->coin
        ]);



        if($item->proto->isStackable()){
            auth()->user()->removeCoins($item->price * $validated['quantity'], $item->coin);
            $item->send($validated['quantity']);
        }
        else{
            for($i = 0; $i < $validated['quantity']; $i++){
                auth()->user()->removeCoins($item->price, $item->coin);
                $item->send();
            }
        }


        return back()->with('success', 'Item bought!');
    }

    public function store(Request $request){
        $validated = $this->validateItem($request);

        //create Shopitem from validated data
        $shopitem = ShopItem::create($validated);

        return back()->with('success', 'Item created');
    }

    public function editItem(ShopItem $shop_item){
        //get bonuses from storage/bonuses.json
        $bonuses = json_decode(file_get_contents(storage_path('bonuses.json')), true);
        return view('pages.admin.shop.item', ['item' => $shop_item, 'subcategories' => Subcategory::all(), 'bonuses' => $bonuses]);
    }

    //function to update an item
    public function update(Request $request, ShopItem $shop_item)
    {
        $validated = $this->validateItem($request);

        //update item from validated data
        if ($shop_item->update($validated))
            return back()->with('success', 'Item updated');
        else
            return back()->with('error', 'Item not updated');
    }

    protected function validateItem(Request $request){
        $validated = $request->validate([
            'vnum' => ['required', 'integer', Rule::exists('player.item_proto', 'vnum')],
            'price' => 'required',
            'description' => 'required',
            'coin' => 'required|in:MD,JD',
            'max_pcs' => 'integer|min:1',
            'max_pcs_account' => 'integer|nullable',
            'max_pcs_global' => 'integer|nullable',
            'discount' => 'integer|min:0|max:100',
            'discount_start' => '',
            'discount_end' => '',
            'available_start' => '',
            'available_end' => '',
            'quantity' => 'required|integer|min:1',
            'subcategory_id' => 'required|exists:subcategories,id',
            'attrtype0' => 'required|integer',
            'attrvalue0' => 'required|integer',
            'attrtype1' => 'required|integer',
            'attrvalue1' => 'required|integer',
            'attrtype2' => 'required|integer',
            'attrvalue2' => 'required|integer',
            'attrtype3' => 'required|integer',
            'attrvalue3' => 'required|integer',
            'attrtype4' => 'required|integer',
            'attrvalue4' => 'required|integer',
            'attrtype5' => 'required|integer',
            'attrvalue5' => 'required|integer',
            'attrtype6' => 'required|integer',
            'attrvalue6' => 'required|integer'
        ]);
        return $validated;
    }

    public function search(Request $request){
        //validate request
        $validated = $this->validate($request, [
            //no special chars allowed
            'search' => 'required|string|max:255|regex:/^[a-zA-Z0-9_]+$/'
        ]);
        $search = strtolower($validated['search']);

        //cache the result for 20 minutes
        $raw_items = Cache::remember('searchProto-'.$search, 0, function () use ($search) {
            return ItemProto::whereRaw('lower(CONVERT(locale_name USING latin1)) like (?)',["%{$search}%"])->get();
        });

        $items = Cache::remember('searchItems-'.$search, 0, function () use ($raw_items) {
            return ShopItem::whereIn('vnum', $raw_items->pluck('vnum'))->get();
        });

        $subcategory = new Subcategory();
        $subcategory->name = 'Search results for "'.$request->search.'"';

        return view('shop.subcategory.show', ['categories' => Category::All(), 'subcategories' => Subcategory::All(), 'items' =>  $items, 'subcategory' => $subcategory]);
    }
}
