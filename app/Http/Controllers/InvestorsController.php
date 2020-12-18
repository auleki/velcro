<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Investor;

class InvestorsController extends Controller
{
    public function index()
    {
        $investors = investor::latest()->paginate(5);
        // dd($investors);
        return view('investor_relations.investor',compact('investors'))
            ->with('i', (request()->input('page', 1) - 1) * 9);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investors=investor::all();
        return view('/investor.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'investor' => 'required',
            'company_invested'=> 'required',
            'market_focus'=> 'required',
            'fund' =>'required',
            'stage'=> 'required',
            'ticket_size'=> 'required',
            'recently_active'=> 'required',
            'company_discussed'=> 'required',
            'declined_company'=> 'required',
            'location'=> 'required',
        ]);

        if ($validator->fails()) {
          $errors = $validator->errors()->getMessages();
          foreach($errors as $err) {
            notify()->error($err[0],"","topRight");
            return back();
          }
        }
  
       $investor = new Investor;
       $investor->investor = $request->investor;
       $investor->company_invested = $request->company_invested;
       $investor->market_focus = $request->market_focus;
       $investor->fund = $request->fund;
       $investor->stage = $request->stage;
       $investor->ticket_size = $request->ticket_size;
       $investor->recently_active = $request->recently_active;
       $investor->company_discussed = $request->company_discussed;
       $investor->declined_company = $request->declined_company;
       $investor->location = $request->location;

       $investor->save();

   
        return back()->with('success','Investment created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(investor $investors)
    {
        //dd($investors);
        return view('investors.show',compact('investors'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request, investor $investors,$id)
    {
        $investors = investor::find($id);

        return view('investor_relations.investor',compact('investors'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Investor  $investors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $investor = Investor::find($id);
        $investor->investor = $request->investor;
        $investor->company_invested = $request->company_invested;
        $investor->market_focus = $request->market_focus;
        $investor->fund = $request->fund;
        $investor->stage = $request->stage;
        $investor->ticket_size = $request->ticket_size;
        $investor->recently_active = $request->recently_active;
        $investor->location = $request->location;
        $investor->company_discussed = $request->company_discussed;
        $investor->declined_company = $request->declined_company;
        $investor->save();
  
        return back()->with('success','Investors updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(investor $investor, $id)
    {
        $investor = Investor::find($id);
        $investor->investor = $request->investor;
        $investor->company_invested = $request->company_invested;
        $investor->market_focus = $request->market_focus;
        $investor->fund = $request->fund;
        $investor->stage = $request->stage;
        $investor->ticket_size = $request->ticket_size;
        $investor->recently_active = $request->recently_active;
        $investor->location = $request->location;
        $investor->company_discussed = $request->company_discussed;
        $investor->declined_company = $request->declined_company;

        $investors->delete();
  
        return redirect()->route('investors.index')
                        ->with('success','Investor deleted successfully');
    }

}
