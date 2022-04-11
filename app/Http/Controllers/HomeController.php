<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'url' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => 422], 422);
            }
            $request->url = Str::lower($request->url);
            $url_hash = hash('joaat', $request->url);
            $url =  Url::find($url_hash);
            if (!empty($url)) {
                if ($url->url != $request->url) {
                    $url_hash = hash('joaat', $request->url . time());
                } else {
                    return response()->json(['short_url' => env('APP_URL') . '/' . $url->hash, 'status' => 200], 200);
                }
            } else {
                $url =  Url::create([
                    'url' => $request->url,
                    'hash' => $url_hash
                ]);
            }
            return response()->json(['short_url' => env('APP_URL') . '/' . $url->hash, 'status' => 200], 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 'status' => 500], 500);
        }
    }
    public function redirect(Url $hash)
    {
        if (!mb_stristr($hash->url, 'http://') && !mb_stristr($hash->url, 'https://')) {
            $url = "https://" . $hash->url;
            return redirect($url, 301);
        } else {
            return redirect($hash->url, 301);
        }
    }
}
