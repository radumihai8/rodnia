<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\False_;

class Referral extends Model
{
    use HasFactory;

    public $timestamps = False;
    public $guarded = [];

    public function players(){
        return $this->hasMany(Player::class, 'account_id', 'account_id');
    }

    public function player(){
        return $this->hasMany(Player::class, 'account_id', 'account_id')->orderBy('level', 'desc')->first();
    }

    public function eligible()
    {
        $player = $this->player();

        if(!isset($player))
            return False;
        if ($player->level >= setting('referral_level') && $player->playtime >= setting('referral_playtime')) {
            return True;
        }
        return False;
    }
}
