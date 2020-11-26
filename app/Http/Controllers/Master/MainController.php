<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class MainController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('master.index');
    }

    public function m26()
    {
        return view('master.m26');
    }

    public function m27()
    {
        return view('master.m27');
    }

    public function m33()
    {
        return view('master.m33');
    }

    public function m34()
    {
        return view('master.m34');
    }
}
