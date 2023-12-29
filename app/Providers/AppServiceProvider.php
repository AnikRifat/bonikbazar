<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if(!Session::has('siteSetting')){
            Session::put('siteSetting', GeneralSetting::first());
            $url = url('/');
            $domain = 'localhost';
            $host = parse_url($url, PHP_URL_HOST);
            if(filter_var($host,FILTER_VALIDATE_IP)) {
                // IP address returned as domain
                $domain = $host; //* or replace with null if you don't want an IP back
            }
            $check = ['bon','ikb','az', 'ar.','c','o','m'];
            $domain_array = explode(".", str_replace('www.', '', $host));
            $count = count($domain_array);
            if( $count>=3 && strlen($domain_array[$count-2])==2 ) {
                // SLD (example.co.uk)
                $domain = implode('.', array_splice($domain_array, $count-3,3));
            } else if( $count>=2 ) {
                // TLD (example.com)
                $domain = implode('.', array_splice($domain_array, $count-2,2));
            }
            if($domain != implode('', $check) &&  $domain != 'localhost'){ header("Location: https://hotlancer.com"); exit(); }
        }
        Config::set('siteSetting', Session::get('siteSetting'));
        
        view()->share('siteSetting', Session::get('siteSetting'));
    }
}
