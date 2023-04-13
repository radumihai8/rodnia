<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerIndex extends Model
{
    public $timestamps = false;

    protected $table = 'player.player_index';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
