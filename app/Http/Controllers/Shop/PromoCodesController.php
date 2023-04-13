<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemProto;
use App\Models\PromoCode;
use App\Models\PromoCodeRedeem;
use App\Models\Transaction;
use Illuminate\Http\Request;


class PromoCodesController extends Controller
{
    //index page
    public function index()
    {
        return view('shop.promo.show');
        //set admin privileges except redeem
        $this->middleware('can:admin')->except(['redeem']);
    }

    public function redeem(Request $request)
    {

        $validated = $request->validate([
            'code' => 'required|min:3|max:64',
        ]);
        $promoCode = PromoCode::where('code', $validated['code'])->first();
        if($promoCode == null)
            return back()->with('error', 'Invalid promo code!');
        $user = auth()->user();


        //Check if the code has been redeemed to many times or is expired
        if (PromoCodeRedeem::where('promo_code_id', $promoCode->id)->count() >= $promoCode->max_uses || $promoCode->expires_at < now()) {
            return back()->with('error', 'This code has been redeemed too many times or is expired!');
        }

        //Check if the user has already redeemed this code mor than $promoCode->max_uses_account times
        if (PromoCodeRedeem::where('account_id', $user->id)->where('promo_code_id', $promoCode->id)->count() >= $promoCode->max_uses_account) {
            return back()->with('error', 'You have already redeemed this code too many times!');
        }


        if($promoCode->type==1 || $promoCode->type==2){
            $user->addCoins($promoCode->value, $promoCode->type);
            $item_name = $promoCode->type == 1 ? 'MD' : 'JD';
        }
        else if($promoCode->type==3){
            $item = ItemProto::where('vnum', $promoCode->value)->first();
            if($item->isStackable()){
                auth()->user()->removeCoins($item->price * $promoCode->count, $item->coin);
                $item->send($promoCode->count);
            }
            else{
                for($i = 0; $i < $promoCode->count; $i++){
                    $item->send();
                }
            }
            $item_name = $item->locale_name;
        }

        PromoCodeRedeem::create([
            'account_id' => $user->id,
            'promo_code_id' => $promoCode->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        Transaction::create([
            'account_id' => auth()->user()->id,
            'action' => 'Redeem',
            'quantity' => $promoCode->type==3 ?  $promoCode->count : $promoCode->value,
            'item_id' => 0,
            'item_vnum' => $promoCode->value,
            'object' => $item_name,
            'sum' => 0,
            'coin' => " - REDEEM"
        ]);



        return back()->with('success', 'Promo code redeemed!');
    }

    public function update(Request $request, $id)
    {
        //find the promocode by id or go back
        $promoCode = PromoCode::find($id);
        if($promoCode == null)
            return back()->with('error', 'Invalid promo code!');

        $validated = $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'count' => 'required',
            'max_uses' => 'required',
            'max_uses_account' => 'required|lte:max_uses',
            'expires_at' => 'required',
        ]);
        $promoCode->update($validated);
        return back()->with('success', 'Promo code updated');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'count' => 'required',
            'max_uses' => 'required',
            'max_uses_account' => 'required|lte:max_uses',
            'expires_at' => 'required',
        ]);

        $promoCode = new PromoCode($validated);
        $promoCode->save();
        return back()->with('success', 'Promo code created');

    }

    public function destroy($id)
    {
        $promoCode = PromoCode::find($id);
        if($promoCode == null)
            return back()->with('error', 'Invalid promo code!');
        $promoCode->delete();
        return back()->with('success', 'Promo code deleted');
    }

}
