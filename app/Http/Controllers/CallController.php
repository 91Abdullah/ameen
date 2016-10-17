<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CallController extends Controller
{
    public function index()
    {
        return view('admin.calls.index');
    }
}
