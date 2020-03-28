<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user/masterlayout/header',function($view){
            $settings= Settings::all()->toArray();
            $data = [];
            foreach ($settings as  $value) {
                $data[] = $value['value'];
              
            }

            $view->with('settings',$data);
        });

        view()->composer('user/masterlayout/master',function($view){
            $settings= Settings::all()->toArray();
            $data = [];
            foreach ($settings as  $value) {
                $data[] = $value['value'];
              
            }

            $view->with('settings',$data);
        });

        view()->composer('user/masterlayout/footer',function($view){
            $settings= Settings::all()->toArray();
            $data = [];
            foreach ($settings as  $value) {
                $data[] = $value['value'];
              
            }

            $view->with('settings',$data);
        });
    }

    /**
     * Register any application services.
     * 
     * @return void
     */
    public function register()
    {
        //
    }
}
