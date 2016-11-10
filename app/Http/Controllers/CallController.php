<?php

namespace App\Http\Controllers;

use App\Cdr;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PhanAn\Remote\Remote;
use Exception;

class CallController extends Controller
{
    public function index()
    {
        $cdrs = Cdr::where('lastapp', '=', 'VoiceMail')->orderBy('calldate', 'desc')->paginate(10);
        return view('admin.calls.index', compact('cdrs'));
        //return dd($cdrs);
    }

    public function getFile(Request $request)
    {
        $connection = new Remote('staging');
        $day = strlen(Carbon::parse($request->date)->day) == 1 ? "0" . Carbon::parse($request->date)->day : Carbon::parse($request->date)->day;
        $month = Carbon::parse($request->date)->month;
        $year = Carbon::parse($request->date)->year;
        $file = $connection->get("/var/spool/asterisk/monitor/" . $year . "/" . $month . "/" . $day . "/" . $request->filename);
        $filename = basename($request->filename);
        if ($error = $connection->getStdError()) {
            //throw new Exception("Houston, we have a problem: $error");
            return response()->json($error, 404);
        }
        else
        {
            $response = Storage::disk('local')->put('public/' . $filename, $file);
            return response()->json(asset('storage/' . $filename), 200);
        }
        //return response()->json("/var/spool/asterisk/monitor/" . $year . "/" . $month . "/" . $day . "/" . $request->filename, 200);
    }

    public function getAudio($filename)
    {
        //$filename = storage_path($filename . '.wav');
        $filesize = (int) Storage::size($filename . '.wav');

        $file = Storage::get($filename. '.wav');

        $response = Response::make($file, 200);
        $response->header('Content-Type', 'audio/wav');
        $response->header('Content-Length', $filesize);
        $response->header('Accept-Ranges', 'bytes');
        $response->header('Content-Range', 'bytes 0-'.$filesize.'/'.$filesize);

        return $response;
    }
}
