<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Account extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public const STATUS_CONFIRM = 'CONFIRM';
    public const STATUS_OK = 'OK';
    public const STATUS_BANNED = 'BLOCK';
    public $timestamps = false;
    protected $table = 'account.account';
    protected $rememberTokenName = false;
    protected $fillable = [
        'login',
        'password',
        'password_decriptata',
        'email',
        'social_id',
        'status',
        'referrer',
        'gold_expire',
        'silver_expire',
        'safebox_expire',
        'autoloot_expire',
        'fish_mind_expire',
        'marriage_fast_expire',
        'money_drop_rate_expire',
        'session_key'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $dates = [
        'availDt'
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = (env('DB_ACCOUNT', 'account') . '.account');
        parent::__construct($attributes);
    }

    public function checkSessionKeyAttribute()
    {
        $actual_key = DB::table('account.account')->where('login', $this->login)->first()->session_key;
        $current_key = session('session_key', null);

        if($current_key != $actual_key) {
            Auth::logout();

            session()->invalidate();

            session()->regenerateToken();

            abort(403,"You can only have one session active");

        }

    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function removeCoins($amount, $type = 'MD')
    {
        if ($type == 'MD') {
            $this->decrement('coins', $amount);
        } else {
            $this->decrement('jcoins', $amount);
        }
    }

    public function addCoins($amount, $type = 'MD')
    {
        if ($type == 'MD') {
            $this->increment('coins', $amount);
        } else {
            $this->increment('jcoins', $amount);
        }
    }

}
