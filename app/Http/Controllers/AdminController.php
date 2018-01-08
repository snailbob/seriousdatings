<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
class AdminController extends Controller {

    public function __construct()
    {
		$this->filter('before', 'auth');
    }

}