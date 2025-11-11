<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

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
        TallStackUi::personalize('tab')
            ->block('item.select', 'bg-white text-amber-600 border-b-2 border-amber-500 font-medium');   
        
            TallStackUi::personalize('step')
            ->block('simple.bar.current', 'border-[#FDC029]')
            ->block('simple.text.title.current', 'text-[#FDC029]');
    }
}
