<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function stock(Request $request)
    {
        $data = ['function' => 'TIME_SERIES_DAILY', 'apikey' => 'demo'];
        $params = array_merge($request->all(), $data);

        $res = Http::get('https://www.alphavantage.co/query', ['function' => $params['function'], 'symbol' => $params['symbol'], 'apikey' => $params['apikey']]);
        if ($res->successful()) {
            $id = Auth::user()->id;
            $history = History::create(['user_id' => $id, 'json' => json_encode($res->json())]);
            return response()->json($res->json());
        } else {
            return response()->json(['message' => "The data couldn't be fetched at this moment"]);
        }
    }

    public function history(Request $request)
    {
        $histories = User::findOrFail(Auth::user()->id)->histories;
        foreach($histories as $history){
            $history->json = json_decode($history->json);
        }
        return response()->json($histories);
    }
}
