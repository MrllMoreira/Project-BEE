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
        TallStackUi::personalize('select.styled')
            ->block('input.wrapper.color', 'focus:ring-amber-500')
            ->block('input.wrapper.base', 'dark:text-dark-300 dark:bg-dark-800 dark:focus:ring-primary-600 dark:disabled:bg-dark-600 dark:ring-dark-600 flex w-full cursor-pointer items-center gap-x-2 rounded-md border-0 bg-white py-1.5 text-sm ring-1 ring-gray-300 disabled:bg-gray-100 disabled:text-gray-500 disabled:ring-gray-300 min-w-[170px]')
            ->block('box.list.item.selected', 'bg-amber-300')
            ->block('box.list.item.wrapper', 'dark:text-dark-300 dark:hover:bg-dark-500 dark:focus:bg-dark-500 relative cursor-pointer select-none px-2 py-2 text-gray-700 hover:bg-amber-100 focus:bg-amber-100 focus:outline-hidden');
    }
}
