<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Commessa;
use App\Models\Pagamento;
use App\Observers\CommessaObserver;
use App\Observers\PagamentoObserver;

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
        // Register observers
        Commessa::observe(CommessaObserver::class);
        Pagamento::observe(PagamentoObserver::class);

        // Share filtered menu with views based on permissions
        View::composer('*', function ($view) {
            $menu = config('menu');
            $user = auth()->user();

            $filter = function ($entries) use ($user) {
                return collect($entries)->filter(function ($entry) use ($user) {
                    if (isset($entry['can'])) {
                        if (!$user) return false;
                        if (!\Illuminate\Support\Facades\Gate::allows($entry['can'], $user)) return false;
                    }
                    if (($entry['type'] ?? 'link') === 'group') {
                        $children = collect($entry['children'] ?? [])->filter(function ($child) use ($user) {
                            if (isset($child['can'])) {
                                if (!$user) return false;
                                if (!\Illuminate\Support\Facades\Gate::allows($child['can'], $user)) return false;
                            }
                            return true;
                        })->values()->all();
                        $entry['children'] = $children;
                        // Hide empty groups
                        return count($children) > 0;
                    }
                    return true;
                })->values()->all();
            };

            $menu['main'] = $filter($menu['main'] ?? []);
            $menu['other'] = $filter($menu['other'] ?? []);

            $view->with('menu', $menu);
        });
    }
}
