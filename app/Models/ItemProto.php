<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemProto extends Model
{
    use HasFactory;
    protected $table = 'player.item_proto';
    protected $primaryKey = 'vnum';

    protected array $antiflags = array(
        "ITEM_ANTIFLAG_FEMALE"  => 0,
        "ITEM_ANTIFLAG_MALE" => 1,
        "ITEM_ANTIFLAG_WARRIOR" => 2,
        "ITEM_ANTIFLAG_ASSASSIN" => 3,
        "ITEM_ANTIFLAG_SURA" => 4,
        "ITEM_ANTIFLAG_SHAMAN" => 5,
        "ITEM_ANTIFLAG_GET" => 6,
        "ITEM_ANTIFLAG_DROP" => 7,
        "ITEM_ANTIFLAG_SELL" => 9,
        "ITEM_ANTIFLAG_EMPIRE_A" => 9,
        "ITEM_ANTIFLAG_EMPIRE_B" => 10,
        "ITEM_ANTIFLAG_EMPIRE_C" => 11,
        "ITEM_ANTIFLAG_SAVE" => 12,
        "ITEM_ANTIFLAG_GIVE" => 13,
        "ITEM_ANTIFLAG_PKDROP" => 14,
        "ITEM_ANTIFLAG_STACK" => 15,
        "ITEM_ANTIFLAG_MYSHOP" => 16,
        "ITEM_ANTIFLAG_SAFEBOX" => 17,
        "ITEM_ANTIFLAG_WOLFMAN" => 18,
        "ITEM_ANTIFLAG_UNK19" => 19,
        "ITEM_ANTIFLAG_UNK20" => 20,
        "ITEM_ANTIFLAG_UNK21" => 21,
        "ITEM_ANTIFLAG_UNK22" => 22,
        "ITEM_ANTIFLAG_CHANGELOOK" => 23,
        "ITEM_ANTIFLAG_ENERGY" => 24,
        "ITEM_ANTIFLAG_PETFEED" => 25,
        "ITEM_ANTIFLAG_APPLY" => 26,
        "ITEM_ANTIFLAG_ACCE" => 27,
        "ITEM_ANTIFLAG_MAIL" => 28
    );

    public function isStackable(){


        $flag = $this->antiflag;
        $antiflag_list  = [];


        foreach($this->antiflags as $name => $value){
            $curflag = (1 << $value);
            $hasflag = ($flag & $curflag);
            if($hasflag){
                $flag -= $curflag;
                $antiflag_list[] = $name;
            }
        }
        #print("Antiflags for vnum ".$row['vnum'].": ".implode(", ", $antiflag_list)."<br>");

        //check if antiflag is not in antiflag_list
        if(!in_array("ITEM_ANTIFLAG_STACK", $antiflag_list) && ($this->flag & (1 << 2))){
            return true;
        }

        return false;
    }

    public function isTradeable(){


        $flag = $this->antiflag;
        $antiflag_list  = [];


        foreach($this->antiflags as $name => $value){
            $curflag = (1 << $value);
            $hasflag = ($flag & $curflag);
            if($hasflag){
                $flag -= $curflag;
                $antiflag_list[] = $name;
            }
        }
        #print("Antiflags for vnum ".$row['vnum'].": ".implode(", ", $antiflag_list)."<br>");

        //check if antiflag is not in antiflag_list
        if(!in_array("ITEM_ANTIFLAG_GIVE", $antiflag_list)){
            return true;
        }

        return false;
    }

    public function send($quantity = 1)
    {
        $itemAward = new ItemAward();
        $itemAward->login = auth()->user()->login;
        $itemAward->count = $quantity;
        $itemAward->vnum = $this->vnum;
        $itemAward->given_time = now();
//        //set item award attrtype and attrvalue from 0 to 6
//        for($i = 0; $i < 7; $i++){
//            $itemAward->{"attrtype$i"} = $this->{"attrtype$i"};
//            $itemAward->{"attrvalue$i"} = $this->{"attrvalue$i"};
//        }

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

        if($itemAward->save()){
            return true;
        }
        else{
            return false;
        }
    }
}
