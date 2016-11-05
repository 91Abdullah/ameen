<?php

namespace App\Http\Controllers;

use App\Preference;
use App\User;
use Illuminate\Http\Request;

use anlutro\LaravelSettings\Facade as Setting;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

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
        return redirect()->route('admin.preferences.mail');
    }

    public function messageIndex()
    {
        $settings = Setting::all();
        return view('admin.preferences.messageIndex', compact('settings'));
    }

    public function messageSave(Request $request)
    {
        Setting::set('server_ip', $request->server_ip);
        Setting::set('server_port', $request->server_port);
        Setting::set('user_id', $request->user_id);
        Setting::set('password', $request->password);
        Setting::save();
        return redirect()->route('admin.preferences.messageIndex')->with('status', 'Settings updated.');
    }

    public function statusSave(Request $request)
    {
        Setting::set('status_server_ip', $request->status_server_ip);
        Setting::set('status_server_port', $request->status_server_port);
        Setting::set('status_user_id', $request->status_user_id);
        Setting::set('status_password', $request->status_password);
        Setting::save();
        return redirect()->route('admin.preferences.messageIndex')->with('status', 'Settings updated.');
    }

    public function createUser()
    {
        $users = User::all();
        return view('admin.preferences.createUser', compact('users'));
    }

    public function editUser(Request $request)
    {
        $user = User::findorFail($request->id);
        if ($request->has('password'))
            $request->password = $user->password;
        $user->update($request->all());
        if($user)
            return response()->json(['user' => $user, 'status' => 'success'], 200);
        else
            return response()->json(['status' => 'failed', 401]);
    }

    public function updateUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user ? $response = response()->json($user, 200) : $response =  response()->json('error', 401);
        return $response;
    }

    public function deleteUser(Request $request)
    {
        User::destroy($request->id);
        return response()->json('success', 200);
    }

    public function addUser(Request $request)
    {
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);
        if ($user)
            return response()->json(['user' => $user, 'status' => 'success']);
        else
            return response()->json(['status' => 'failed', 401]);
    }
}
