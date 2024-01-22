<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

use App\Models\Office;
use Log;

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
        // if(session("AdminID") == ""){
        //     return redirect("/");
        // }

        //global data shared with all views.. 
        View::composer('*', function ($view) {
            if( session("CompanyLinkID") != null ){
                // Log::debug("company id: ".session("CompanyLinkID"));

                // ... get your data here
                $officeSettings = Office::where("id",session("CompanyLinkID"))->first(); 

                // Bind data to the view
                $view->with('company_logo', $officeSettings->logo);
                $view->with('company_name', $officeSettings->name);
                $view->with('company_addr', $officeSettings->address);
                $view->with('billing_method', $officeSettings->billing_method);
                $view->with('testdata', 1234567);
            }
        });

    }
}
