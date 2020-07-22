<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $pathViewController = 'admin.pages.dashboard.';

    public function index(){
        return view( $this->pathViewController . 'index');
    }
}