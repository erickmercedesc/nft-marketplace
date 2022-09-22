<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Setting/Index', [
            'news' => [
                'news_title'  => config('system.news_title', ''),
                'news_body'   => config('system.news_body', ''),
            ],

            'withdraw_status' => config('system.withdraw_status', '1'),
            'mining_status' => config('system.mining_status', '1'),

            'settings' => [
                'upgrade_lifetime'  => config('system.upgrade_lifetime', 60),
                'referers_profit'   => config('system.referers_profit', 10),
                'minimun_withdraw'  => config('system.minimun_withdraw', 20),
                'maximun_withdraw'  => config('system.maximun_withdraw', 2000),
            ],

            'addresses' => [
                'btc'           => config('system.btc'),
                'eth'           => config('system.eth'),
                'trc20_usdt'    => config('system.trc20_usdt'),
                'ltc'           => config('system.ltc'),
                'bep20_doge'    => config('system.bep20_doge'),
            ],
        ]);
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
            'news_title' => 'nullable|string',
            'news_body'  => 'nullable|string',
            
            'referers_profit'   => 'nullable|numeric',
            'upgrade_lifetime'  => 'nullable|numeric',
            'minimun_withdraw'  => 'nullable|numeric',
            'maximun_withdraw'  => 'nullable|numeric',

            'btc'           =>  'nullable|string',
            'eth'           =>  'nullable|string',
            'trc20_usdt'    =>  'nullable|string',
            'ltc'           =>  'nullable|string',
            'bep20_doge'    =>  'nullable|string',          
        ]);

        $settings = [];
        foreach ($validated as $key => $value) {
            $settings[] = [
                'key' => $key,
                'value' => $value
            ];
        }

        Setting::upsert($settings, ['key'], ['value']);
        return back()->banner('Settings Update!');
    }
  
}
