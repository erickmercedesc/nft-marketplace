<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Inertia\Inertia;
use CryptAPI\CryptAPI;
use Illuminate\Support\Facades\Log;

class TokenController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show', 'purchase']);
        $this->middleware('can:tokens')->except(['index', 'show', 'purchase']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('type') == 'mine') {
            $token = $request->user()->tokens();
        }else{
            $token = Token::latest();
        }

        return Inertia::render('Token/Index', [
            'tokens' => $token->doesntHave('users')->paginate(),
            'deposit_wallet' => $request->session()->get('wallet'),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Token/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'     =>  ['required', 'file'],
            'name'      =>  ['required', 'string', 'unique:tokens,name'],
            'creator'   =>  ['required', 'string'],
            'price'     =>  ['required', 'numeric']
        ]);

        $validated['image'] = $request->file('image')->storePublicly('token-images', ['disk' => 'public']);

        Token::create($validated);
        return redirect()->route('tokens.index')->banner('Token Created Succesfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Token $token)
    {
        if($request->user()->is_admin) {
            return redirect()->route('tokens.edit', $token);
        }

        return Inertia::render('Token/Show', [
            'token' => $token
        ]);
    }

    public function purchase(Request $request, Token $token)
    {
        $user = $request->user();
        if($token->Users()->exists()) {
            abort(404);
        }

        if($user->balance < $token->price) {
            return back()->dangerBanner("You don't have sufficient balance for this operation");
        }        

        $user->Tokens()->attach($token->id, [
            'price' => $token->price
        ]);
        
        $user->fixBalance();
        return redirect()->route('dashboard')->banner('Token Successfully Purchased');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function edit(Token $token)
    {
        return Inertia::render('Token/Edit', [
            'token' => $token
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Token $token)
    {
        $validated = $request->validate([
            'creator'   =>  ['required', 'string'],
            'price'     =>  ['required', 'numeric']
        ]);

        $token->update($validated);
        return redirect()->route('tokens.index')->banner('Token Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Token  $token
     * @return \Illuminate\Http\Response
     */
    public function destroy(Token $token)
    {
        $token->delete();
        return redirect()->route('tokens.index')->banner('Token Deleted Succesfully');        
    }
}
