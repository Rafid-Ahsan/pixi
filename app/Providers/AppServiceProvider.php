<?php

namespace App\Providers;

use App\Http\View\Composers\UserComposer;
use App\Models\Contest;
use App\Models\Cover;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::share('not_approved_contest_value', count(Contest::where('status', 'Not Approved')->get()));

    }
}
