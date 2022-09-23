<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use CryptAPI\CryptAPI;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Deposit/Index', [
            'deposits' => $request->user()->Deposits()->latest()->paginate()
        ]);
    }

    public function address(Request $request, $currency)
    {
        $currency = str_replace('-', '/', $currency);

        $ca = Http::get("https://api.cryptapi.io/$currency/create/", [
            'apikey' => env('CRYPTAPI_TOKEN'),
            'callback' => route('webhook.cryptapi', $request->user())
        ] )->json(); 

        return response()->json([
            'address' => $ca['address_in']
        ]);
    }
}
