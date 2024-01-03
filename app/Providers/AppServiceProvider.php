<?php

namespace App\Providers;

use App\Http\Controllers\Function\FunctionController;
use App\Models\Branch;
use App\Models\FunctionAvailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
               
                $function_available =  FunctionAvailable::select('function_availables.*')
                    ->join('function_models as f', 'f.id', '=', 'function_availables.function_id')->where('function_availables.role_id', auth()->user()->role_id)->orderBy('f.id', 'ASC')->get();
                $function_controller =  new FunctionController();
                View::share(([
                    'function_available' => $function_available,
                    'function_controller' => $function_controller
                ]));
            }
        });
    }
}
