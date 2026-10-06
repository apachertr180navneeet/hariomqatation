<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        // Share dynamic categories and brands with all shop storefront views
        \Illuminate\Support\Facades\View::composer('shop.*', function ($view) {
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('categories')) {
                    $globalCategories = \App\Models\Category::active()
                        ->with(['subcategories' => function ($q) {
                            $q->active()->withCount('products');
                        }])
                        ->withCount('products')
                        ->orderBy('name')
                        ->get();

                    $globalBrands = \App\Models\Brand::where('status', 'active')
                        ->withCount('products')
                        ->orderBy('name')
                        ->get();

                    $view->with('globalCategories', $globalCategories);
                    $view->with('globalBrands', $globalBrands);
                }
            } catch (\Throwable $e) {
                $view->with('globalCategories', collect());
                $view->with('globalBrands', collect());
            }
        });
    }
}
