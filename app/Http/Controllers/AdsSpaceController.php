<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdsPricing;
use App\AdsSpace;
use Auth;

class AdsSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    public function active_ads(){
        $ads = AdsSpace::where('paid', 1)->get();

        $arr = array();

        if(!empty($ads)){
            foreach($ads as $r=>$value){
                $price = AdsPricing::find($value->days);
                //calculate remaining days
                $now = time(); // or your date as well
                $start_date = strtotime($value->created_at);
                $datediff = $now - $start_date;

                $passed_days = floor($datediff / (60 * 60 * 24));
                $value->passed_days = $passed_days;
                $value->ad_details = $price;
                $value->remaining = $price->days;

                //filter expired ads
                if($price->days >= $passed_days){
                    $arr[] = $value;
                }

            }
        }
        
        return $arr;

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pricing = AdsPricing::all();
        $arr = array(
            'pricing'=>$pricing
        );
        return \View::make('user.ad_page')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = $request->input();
        $data['user_id'] = $user_id;

        $data['paid'] = 1;
        if($user->hasRole('User') || $user->hasRole('Verified')){
            $data['paid'] = 0;
        }
        
        $ads = AdsSpace::create($data);
        return response()->json($ads);
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
