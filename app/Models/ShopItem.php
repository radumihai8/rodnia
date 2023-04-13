<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    use HasFactory;
    protected $table = 'shop_items';
    public $timestamps = False;

    protected $guarded = [];

    protected $with = ['proto'];

    protected $dates = [
        'discount_start',
        'discount_end',
        'available_start',
        'available_end',
    ];

    public function proto()
    {
        return $this->hasOne(ItemProto::class, 'vnum', 'vnum');
    }

    //relationship with category
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function send($quantity = 1)
    {
        $itemAward = new ItemAward();
        $itemAward->login = auth()->user()->login;
        $itemAward->count = $quantity;
        $itemAward->vnum = $this->vnum;
        $itemAward->given_time = now();
        //set item award attrtype and attrvalue from 0 to 6
        for($i = 0; $i < 7; $i++){
            $itemAward->{"attrtype$i"} = $this->{"attrtype$i"};
            $itemAward->{"attrvalue$i"} = $this->{"attrvalue$i"};
        }

        if($itemAward->count <= 0)
            $itemAward->count = 1;

        // override value0
        //if ($this->value0 != 0) {
        //$itemAward->socket0 = $this->value0;
        //}

        /* socket
        if (($this->type == ShopItem::ITEM_TYPE_WEAPON || ShopItem::ITEM_TYPE_ARMOR) && $this->can_add_stones) {
            // "empty stones" (otherwise player cannot add stones to item)
            for ($i = 0; $i < $this->proto->socket_pct; $i++) {
                $itemAward->{'socket' . $i} = 1;
            }
        }*/

        $itemAward->save();
    }

    public function countHistory(){
        return Transaction::where('item_id', $this->id)->where('account_id', auth()->user()->id)->sum('quantity');
    }

    public function countHistoryGlobal(){
        return Transaction::where('item_id', $this->id)->sum('quantity');
    }

}
