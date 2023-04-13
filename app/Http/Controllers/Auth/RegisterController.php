<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Referral;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm($referrer_id = NULL)
    {
        if (setting('enable_registration')!=1) {
            abort(403, __("Registrations are temporary closed."));
        }

        if($referrer_id){
            if(!Account::where('id', '=', $referrer_id)->exists()){
                return redirect('/register')->with('error', 'The refferer doesn`t exist!');
            }
        }
        return view('auth.register')->with('referral_id', $referrer_id);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => ['required', 'string', 'max:16', 'min:3', Rule::unique('account.account')],
            'email' => ['required', 'string', 'email', 'max:100'],
            'social_id' => ['required', 'digits:7'],
            'tos' => ['accepted'],
            'email_check' => ['accepted'],
            'referrer_id' => ['integer'],
            'password' => [
                'required',
                'string',
                'min:7',
                'max:16',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed'
            ],
        ]);
    }

    protected function create(array $data)
    {

        $account = Account::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'social_id' => $data['social_id'],
            'status' => env('CONFIRM_ACCOUNT', false) ? Account::STATUS_CONFIRM : Account::STATUS_OK,
            'password' => mysql_password($data['password']),

            'create_time' => now(),

            // start bonus
            'gold_expire' => now()->addDays(config('site.registration_bonus_gold', 0)),
            'silver_expire' => now()->addDays(config('site.registration_bonus_silver', 0)),
            'safebox_expire' => now()->addDays(config('site.registration_bonus_safebox', 0)),
            'autoloot_expire' => now()->addDays(config('site.registration_bonus_autoloot', 0)),
            'fish_mind_expire' => now()->addDays(config('site.registration_bonus_fish', 0)),
            'marriage_fast_expire' => now()->addDays(config('site.registration_bonus_marriage', 0)),
            'money_drop_rate_expire' => now()->addDays(config('site.registration_bonus_money', 0)),
        ]);

        if($data['referrer_id']!=0)
            Referral::create([
                'account_id' => $account->id,
                'referral_id' => $data['referrer_id'],
                'claimed' => 0
            ]);

        return $account;
    }

    protected function registered(Request $request, $user)
    {
        if (env('CONFIRM_ACCOUNT', false)) {
            session()->flash("success", __("Account created! You have received an email to activate your account."));
        } else {
            session()->flash("success", __("Account activated!"));
        }

    }

}
