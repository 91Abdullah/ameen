<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Ixudra\Curl\Facades\Curl;

class TestController extends Controller
{
    public function apiTest()
    {

    }

    public function dbtest()
    {
        $cdrs = DB::connection('asterisk')->select('select * from cdr where 1');
        return dd($cdrs);
    }
}
