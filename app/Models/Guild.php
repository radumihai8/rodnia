<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Guild extends Model
{
    use HasFactory;

    protected $table = 'player.guild';

    public function owner()
    {
        return $this->hasOne(Player::class, 'id', 'master')
            ->withDefault();
    }

    public function members()
    {
        return $this->hasManyThrough(Player::class, GuildMember::class, 'guild_id', 'id');
    }

    public function getOwnerAttribute(){
        $owner = Cache::remember('guild_owner'.$this->id, 3600, function(){
            return $this->getRelationValue('owner');
        });

        return $owner;
    }

}
