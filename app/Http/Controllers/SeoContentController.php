<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Session;
use Auth;

use App\SeoContent;

class SeoContentController extends Controller
{
    public function edit($type)
    {

        $seo_content = SeoContent::where('type', $type)->first();
        $arr = array(
            'seo_content' => $seo_content
        );

        return \View::make('admin.seo.edit_seo_content')->with($arr);
    }

    public function update(Request $request)
    {
        $data = $request->input();

        unset($data['_token']);

        SeoContent::where('id', $data['id'])->update($data);
        \Session::flash('success', 'Successfully updated SEO meta content.');

        return \Redirect::to('admin/seo/edit/' . $data['type']);
    }

    public function seoPage()
    {
        if (Auth::check()) {
            if (!Auth::user()->hasRole('SEO')) {
                return redirect(url());
            } else {
                return \View::make('admin.seo.landing_page');
            }
        }
    }

}
