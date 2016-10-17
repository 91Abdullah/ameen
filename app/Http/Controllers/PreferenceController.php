<?php

namespace App\Http\Controllers;

use App\Preference;
use Illuminate\Http\Request;

use App\Http\Requests;

class PreferenceController extends Controller
{
    //
    public function index()
    {
        $preferences = Preference::first() ? Preference::first() : new Preference();
        return view('admin.preferences.index', compact('preferences'));
    }

    public function save(Request $request)
    {
        if (Preference::first())
        {
            $preferences = Preference::first()->update($request->all());
        }
        else
            $preferences = Preference::create($request->all());
        return redirect()->route('admin.preferences');
    }
}
