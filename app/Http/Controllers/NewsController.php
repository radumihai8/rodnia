<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Event;
use App\Models\Guild;
use App\Models\News;
use App\Models\Pet;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $currentPage = request()->get('page');
        $statistics = [];
        Cache::flush();
        $events = Cache::remember('events', 60, function () {
            return Event::orderBy('date','desc')->take(9)->get();
        });

        $news = Cache::remember('news-'.$currentPage, 60, function () {
            return News::orderBy('created_at', 'desc')->paginate(3);
        });

        $cache_time = 60;

        $statistics['accounts created'] = Cache::remember('stat_accounts', $cache_time, function (){
            return Account::count();
        });
        $statistics['characters created'] = Cache::remember('stat_players', $cache_time, function (){
            return Player::count();
        });
        $statistics['guilds created'] = Cache::remember('stat_guilds', $cache_time, function (){
            return Guild::count();
        });
        $statistics['players online'] = Cache::remember('stat_players_online', $cache_time, function (){
            return Player::whereBetween('last_play', [now()->subMinutes(10), now()])->count();
        });
        $statistics['players online 24h'] = Cache::remember('stat_players_online24h', $cache_time, function (){
            return Player::whereBetween('last_play', [now()->subDay(), now()])->count();
        });

        $top_10_players = Cache::remember('top10_players', $cache_time, function (){
            return Player::orderBy('level','DESC')->take(10)->get();
        });

        $top_10_guilds = Cache::remember('top10_guilds', $cache_time, function (){
            return Guild::orderBy('ladder_point', 'DESC')->take(10)->get();
        });

        $top_10_pets = Cache::remember('top10_pets', $cache_time, function (){
            return Pet::orderBy('level', 'DESC')->take(10)->get();
        });




        return view('pages.news.index', compact(['events','news','top_10_guilds', 'top_10_players', 'top_10_pets', 'statistics']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);


        News::create($validated);

        return back()->with('success', 'Article Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(News $news)
    {
        return view('pages.news.show', [
            'article' => $news
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(News $news)
    {
        return view('pages.news.edit', [
            'article' => $news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(News $news)
    {

        $news->delete();

        return redirect('/')->with('success', 'Article deleted');
    }
}
