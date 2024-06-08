<?php

namespace App\Providers;
use App\Models\sub_main_category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\addCategories;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

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
        Schema::defaultStringLength(191);
        $this->composeViewData();
    }
    private function composeViewData()
    {
        $user_id = Session::get('user_id');
        $main_categories = addCategories::where('status', 1)
            ->orderBy('category_order')
            ->get();
        $subCategories = sub_main_category::all();

        View::share('main_categories', $main_categories);
        View::share('sub_categories', $subCategories);
        View::share('user_id', $user_id);
    }   
}
