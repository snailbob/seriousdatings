<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PremiumFeature;

class PremiumFeaturesController extends Controller
{
    public function getPremiumFeatures()
    {
        $features = PremiumFeature::all();

        return \View::make('admin.premium.premium_list')->with('features', $features);
    }

    public function editPremiumFeature(Request $request)
    {
        $error = $this->validate($request, [
           'name' => 'required|max:200|unique:premium_features,feature',
            'id' => 'required|exists:premium_features,id'
        ]);

        PremiumFeature::where('id', $request->id)
            ->update(['feature' => $request->name]);
        $feature = PremiumFeature::find($request->id);

        return response()->json($feature);
    }

    public function deletePremiumFeature(Request $request)
    {
        $feature = PremiumFeature::find($request->id);

        $feature->delete();

        return response()->json($feature);
    }
}
