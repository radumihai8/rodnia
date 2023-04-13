<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Pet extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "player.pet";

    public function getOwnerAttribute(){
        $owner = Cache::remember('pet_owner'.$this->id, 3600, function(){
            $item = Item::where(['vnum' => $this->vnum, 'socket2'=>$this->id])->first();
            return $item->getOwnerAttribute();
        });

        return $owner;
    }
}
