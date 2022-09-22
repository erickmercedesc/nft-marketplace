<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use CryptAPI\CryptAPI;

class WebhookController extends Controller
{
    public function cryptapi(Request $request, User $user)
    {
        $validated = $request->validate([
            'txid_in'       => 'required|string',
            'value_coin'    => 'required|numeric',
            'coin'          => 'required|string'
        ]);

        $conversion = CryptAPI::get_convert('usd', $validated['value_coin'], $validated['coin']);
        $user->MakeDeposit([
            'amount' => $conversion->value_coin,
            'txId' => $validated['txid_in'],
            'data' => json_encode($request->input())
        ]);

        return response("*ok*", 200)->header('Content-Type', 'text/plain');
    }  
}
