<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "player.item";

    //cast available_start and available_end to datetime
    protected $casts = [
        'available_start' => 'datetime',
        'available_end' => 'datetime',
    ];



    public function owner()
    {
        return $this->hasOne(Player::class, 'id', 'owner_id')
            ->withDefault();
    }


    public function getOwnerAttribute(){
        $owner = Cache::remember('item_owner'.$this->id, 3600, function(){
            return $this->getRelationValue('owner');
        });

        return $owner;
    }


}
