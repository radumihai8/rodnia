<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanRequest;
use App\Models\Account;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller
{
    public function ranking(Request $request){
        $currentPage = request()->get('page');

        $players = Cache::remember('users-'.$currentPage, 60, function () {
            return Player::orderBy('level','DESC')->paginate(10);
        });


        return view('pages.ranking.players', ['players' => $players, 'firstPosition' => $currentPage*10+1]);
    }

    public function search(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:64',
        ]);

        $name = $request->input('name');
        $players = Cache::remember('search_players-'.$name, 60, function () use ($name) {
            return Player::where('name', 'like', '%'.$name.'%')->orderBy('level','DESC')->paginate(10);
        });

        return view('pages.ranking.players', ['players' => $players, 'firstPosition' => 1]);
    }

    public function debug(Request $request, Player $player){
        $empire = $player->playerIndex->empire;

        if($player->account_id != auth()->user()->id)
            return back()->with('error', 'This characted does not belong to you!');

        if ($empire == 1) {
            $player->map_index = "0";
            $player->x = "459770";
            $player->y = "953980";
        } elseif ($empire == 2) {
            $player->map_index = "21";
            $player->x = "52043";
            $player->y = "166304";
        } elseif ($empire == 3) {
            $player->map_index = "41";
            $player->x = "957291";
            $player->y = "255221";
        }

        $player->save();

        return back()->with('success', 'Character debugged!');

    }

    public function ban(BanRequest $request){
        Account::where('id', '=', $request->account)->update([
            'status' => Account::STATUS_BANNED,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Account banned!');
    }

    public function unban(Account $account){
        $account->update([
            'status' => Account::STATUS_OK,
            'reason' => '',
        ]);

        return back()->with('success', 'Account unbanned!');
    }
}
