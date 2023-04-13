<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Player extends Model
{
    public $timestamps = false;

    protected $with = ['playerIndex'];

    protected $dates = ['last_play'];

    protected $table = "player.player";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    function playerIndex()
    {
        return $this->hasOne(PlayerIndex::class, "id", "account_id")
            ->withDefault();
    }

    public function guild(){
        return $this->hasOneThrough(Guild::class, GuildMember::class, 'pid', 'id', 'id', 'guild_id')
            ->with('members')
            ->withDefault();
    }

    public function getGuildAttribute(){
        $guild = Cache::remember('guild'.$this->id, 3600, function(){
            return $this->getRelationValue('guild');
        });

        return $guild;
    }

    public function getEmpireAttribute(){
        return $this->playerIndex->empire ?? 1;
    }

    public function banned()
    {
        return ($this->account->status == 'BLOCK' || $this->account->availDt > now());
    }

    function account()
    {
        return $this->belongsTo(Account::class);
    }



}
