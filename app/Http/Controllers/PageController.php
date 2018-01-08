<?php



namespace App\Http\Controllers;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;

use \App\User;

use DB;

use View;

use Auth;



class PageController extends Controller

{





    public function showContent($title)

    {

		if (Auth::check()) {

            if(Auth::user()->verified == 0){

                // return redirect('/verifyPlease');

                return \Redirect::to('/verifyPlease');

            }

        }

      $pageContent = DB::table('admin_cms_tbl')->where("pagename","=",$title)->first();

     // dd($pageContent);

      return View::make('pageTemplate')->with("content",$pageContent);

        

        



    }





}

