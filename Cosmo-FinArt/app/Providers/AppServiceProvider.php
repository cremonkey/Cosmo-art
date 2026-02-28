<?php

namespace App\Providers;

use Filament\PanelRegistry;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\Mechanisms\ComponentRegistry;

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
        // Ensure Filament panels are registered on every request, including
        // Livewire update requests where component resolution happens early.
        if (class_exists(PanelRegistry::class)) {
            app(PanelRegistry::class);
        }

        $this->registerAppFilamentLivewireComponents();

        // Safety fallback to keep Filament login component resolvable
        // across stale snapshots / cache boundaries.
        if (class_exists(\Filament\Auth\Pages\Login::class)) {
            Livewire::component('filament.auth.pages.login', \Filament\Auth\Pages\Login::class);
        }

        // Resolve stale/unregistered Filament snapshot component names.
        Livewire::resolveMissingComponent(function (string $name): ?string {
            if (! str_starts_with($name, 'app.filament.')) {
                return null;
            }

            $class = collect(explode('.', $name))
                ->map(fn (string $segment): string => Str::studly($segment))
                ->implode('\\');

            if (! class_exists($class)) {
                return null;
            }

            return is_subclass_of($class, Component::class) ? $class : null;
        });
    }

    private function registerAppFilamentLivewireComponents(): void
    {
        $filesystem = app(Filesystem::class);
        $appPath = app_path();
        $appNamespace = app()->getNamespace();

        foreach ([app_path('Filament/Pages'), app_path('Filament/Resources')] as $directory) {
            if (! $filesystem->exists($directory)) {
                continue;
            }

            foreach ($filesystem->allFiles($directory) as $file) {
                $relativePath = Str::after($file->getRealPath(), $appPath . DIRECTORY_SEPARATOR);
                $class = $appNamespace . str_replace([DIRECTORY_SEPARATOR, '.php'], ['\\', ''], $relativePath);

                if (! class_exists($class) || ! is_subclass_of($class, Component::class)) {
                    continue;
                }

                $name = app(ComponentRegistry::class)->getName($class);
                Livewire::component($name, $class);
            }
        }
    }
}
