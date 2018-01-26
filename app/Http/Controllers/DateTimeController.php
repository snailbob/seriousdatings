<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DateTimeFormat;
use Carbon\Carbon;

class DateTimeController extends Controller
{
    public function showFormatting()
    {

        $default = DateTimeFormat::all();
        $now = Carbon::now();
        $dates['str-MM-DD-YYYY'] = date_format($now, 'F j, Y');
        $dates['YYYY-MM-DD'] = date_format($now, 'Y-m-d');;
        $dates['MM-DD-YYYY'] = date_format($now, 'm-d-Y');
        $dates['DD-MM-YYYY'] = date_format($now, 'd-m-Y');
        $times['12F'] = date_format($now, 'g:i A') . "  <small>(12-hour format)</small>";
        $times['24F'] = date_format($now, 'G:i A') . "  <small>(24-hour format)</small>";

        return \View::make('admin.date_time_format.date_time_formatting')->with([ 'dates' => $dates, 'times' => $times, 'default' => $default]);
    }

    public function updateDateFormat(Request $request)
    {
        $errors = $this->validate($request, [
            'date' => 'required',
            'time' => 'required'
        ]);

        DateTimeFormat::where('id', 1)
            ->update(['date' => $request->date, 'time' => $request->time]);
        $default = DateTimeFormat::all();
        return response()->json($default);
    }
}
