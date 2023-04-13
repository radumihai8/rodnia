<?php

namespace App\Http\Controllers;

use App\Models\Guild;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GuildController extends Controller
{
    public function ranking(Request $request){
        $currentPage = request()->get('page');


        $guilds = Cache::remember('guilds-'.$currentPage, 60, function () {
            return Guild::orderBy('ladder_point','DESC')->paginate(10);
        });


        return view('pages.ranking.guilds', ['guilds' => $guilds, 'firstPosition' => $currentPage*10+1]);
    }

    public function search(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:64',
        ]);

        $name = $request->input('name');
        $guilds = Cache::remember('search_guilds-'.$name, 60, function () use ($name) {
            return Guild::where('name', 'like', '%'.$name.'%')->orderBy('ladder_point','DESC')->paginate(10);
        });

        return view('pages.ranking.guilds', ['guilds' => $guilds, 'firstPosition' => 1]);
    }
}
