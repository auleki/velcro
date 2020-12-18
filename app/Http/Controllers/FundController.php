<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fund;
use App\FundActivity;
use App\FundChart;
use App\Tag;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fund = new Fund;

        $fund->user_id = auth()->user()->id;
        $fund->name = $request->name;

        $fund->save();

        $tag = new Tag;
        $tag->name = 'IRR';
        $tag->fund_id = $fund->id;
        $tag->user_id = auth()->user()->id;

        $tag->save();

        return back();
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
        $fund = Fund::find($id);

        $fund->user_id = auth()->user()->id;
        $fund->name = $request->name ? $request->name : $fund->name;
        $fund->irr = $request->irr ? $request->irr : $fund->irr;

        $fund->save();

        // $activity = new FundActivity;
        // $activity->user_id = auth()->user()->id;
        // $activity->fund_id = $fund->id;

        // $fund_activity->company_id = $id;
        // $fund_activity->action = $new_fund->round;
        // $fund_activity->amount = $new_fund->committed_currency . $new_fund->committed;

        // if($request->irr) {
        //     $activity->action = 'Changed IRR value to “' . $request->irr . '”';
        // } else {
        //     $activity->action = 'Changed fund name to “' . $request->name . '”';
        // }
        // $activity->save();
        

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fund = Fund::find($id);

        $fund->delete();

        return redirect('/home');
    }

    public function removeChart($id){
        $chart = FundChart::find($id);

        $chart->delete();

        return redirect('/home');

    }
}
