<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Notifications\CharacterCode;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function index(){
        $account = auth()->user();
        return view("pages.user.index", compact('account'));
    }

    public function resetPassword(Request $request){

        $status = Password::sendResetLink(['email'=>auth()->user()->email]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function sendCharcode(){
        $code = auth()->user()->social_id;

        auth()->user()->notify(new CharacterCode($code));

        return back()->with('success', 'Email sent!');

    }

    public function sendStorekeeper(){
        $code = auth()->user()->social_id;

        auth()->user()->notify(new CharacterCode($code));

        return back()->with('success', 'Email sent!');

    }
}
