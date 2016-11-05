<?php

namespace App\Http\Controllers;

use App\Cdr;
use Illuminate\Http\Request;

use App\Http\Requests;

class CallController extends Controller
{
    public function index()
    {
        $cdrs = Cdr::paginate(10);
        return view('admin.calls.index', compact('cdrs'));
        //return dd($cdrs);
    }
}
