<?php

namespace App\Providers;

use App\Models\Movie;
use App\Policies\MoviePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::policy(Movie::class, MoviePolicy::class);
    }
}
