<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PetController extends Controller
{
    public function ranking(Request $request){
        $currentPage = request()->get('page');

        $pets = Cache::remember('pets-'.$currentPage, 60, function () {
            return Pet::orderBy('level','DESC')->paginate(10);
        });


        return view('pages.ranking.pets', ['pets' => $pets, 'firstPosition' => $currentPage*10+1]);
    }

    public function search(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:64',
        ]);

        $name = $request->input('name');
        $pets = Cache::remember('search_pets-'.$name, 60, function () use ($name) {
            return Pet::where('name', 'like', '%'.$name.'%')->orderBy('level','DESC')->paginate(10);
        });

        return view('pages.ranking.pets', ['pets' => $pets, 'firstPosition' => 1]);
    }
}
