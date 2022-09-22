<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class SettingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            if(Schema::hasTable('settings')){
                $settings = Setting::all();
                foreach($settings as $setting){
                    $key = $setting['key'];
                    $value = $setting['value'];
                    config(["system.$key" => $value]);
                }
            }
        }catch(\PDOException $e){

        }
    }
}
