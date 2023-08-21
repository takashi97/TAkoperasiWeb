<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
        View::composer('*', function ($view) {
            $user = Auth::user();
            $saldo = 0;
            if ($user) {
                $saldoRecord = Saldo::where('user_id', $user->id)->first();
                if ($saldoRecord) {
                    $saldo = $saldoRecord->saldo;
                } 
            }
            $view->with('saldo', $saldo);
        });
        Schema::defaultStringLength(119);
    }
}
