<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\Settings;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (setting('referral_active')!=1) {
            abort(403, __("Referrals are currently not enabled!"));
        }

        $user = auth()->user();
        $referrals = Referral::where('referral_id',$user->id)->get();
        return view('pages.user.referral', ['referrals' => $referrals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function claim(Request $request){

        if(setting('referral_active')!= 1){
            return back()->with('Referrals not active!');
        }
        $validated = $request->validate([
            'referral_id' => 'required|integer|exists:App\Models\Referral,id'
        ]);

        $referral = Referral::find($validated['referral_id']);

        if($referral->claimed == 0) {
            if ($referral->eligible()) {
                $referral->claimed = 1;
                $referral->save();
                auth()->user()->increment('coins', setting('referral_reward'));
                return back()->with('success', 'Reward claimed!');
            }
            else
            {
                return back()->with('error', 'The conditions are not met!');
            }
        }
        else{
            return back()->with('error', 'Reward already claimed!');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
