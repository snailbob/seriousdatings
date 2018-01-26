<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdsSpace;
use App\AdsPricing;

class AdsPricingController extends Controller
{
    public function getPricelist()
    {
        $prices = AdsPricing::all();

        return \View::make('admin.ads_management.ads_management_list')->with('prices', $prices);
    }

    public function addAdsPricing(Request $request)
    {
        $errors = $this->validate($request, [
            'days' => 'required|max:10|unique:ads_pricings,days',
            'price' => 'required|max:10'
        ]);

        $ads = AdsPricing::create([
            'days' => $request->days,
            'price' => $request->price
        ]);

        return response()->json($ads);
    }

    public function editAdsPricing(Request $request)
    {
        $ads = AdsPricing::find($request->id);

        if ($ads->days == $request->days) {
            $errors = $this->validate($request, [
                'days' => 'required|max:10',
                'price' => 'required|max:10'
            ]);
        } else {
            $errors = $this->validate($request, [
                'days' => 'required|max:10|unique:ads_pricings,days',
                'price' => 'required|max:10'
            ]);
        }

        AdsPricing::where('id', $request->id)
            ->update([
                'days' => $request->days,
                'price' => $request->price
            ]);

        $ads = AdsPricing::find($request->id);
        return response()->json($ads);
    }

    public function deleteAdsPricing(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:ads_pricings,id',
            'days' => 'required|exists:ads_pricings,days'
        ]);

        $ads = AdsPricing::find($request->id);
        $ads->delete();

        return response()->json($ads);
    }

    public function getPriceSpace()
    {
        $spaces = AdsSpace::all();
        $spaces->load('user');
        return \View::make('admin.ads_management.ads_spacing_management')->with('spaces', $spaces);
    }

    public function deleteAdsSpace(Request $request)
    {
        $errors = $this->validate($request, [
            'id' => 'required|exists:ads_spaces,id'
        ]);

        $space = AdsSpace::find($request->id);
        $space->delete();
        return response()->json($space);
    }
}
