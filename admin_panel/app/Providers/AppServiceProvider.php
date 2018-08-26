<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     *Register any route in modules.
     * @return void
     */
    public function boot()
    {
        // For each of the registered modules, include their routes and Views
        $modules = config("module.modules");


        if (count($modules)) {

            foreach ($modules as $key => $module) {
                //Load the routes
                if (file_exists(__DIR__ . '/../../modules/' . $module . '/routes.php')) {
                    include __DIR__ . '/../../modules/' . $module . '/routes.php';
                }
                // Load the views
                if (is_dir(__DIR__ . '/../../modules/' . $module . '/Views')) {
                    $this->loadViewsFrom(__DIR__ . '/../../modules/' . $module . '/Views', $module);
                }
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Domain\Repo\PostRepo',
            'App\Domain\RepoImpl\PostRepoImpl');
        $this->app->bind('App\Domain\Repo\UserRepo',
            'App\Domain\RepoImpl\UserRepoImpl');
        $this->app->bind('App\Domain\Repo\IndustryRepo',
            'App\Domain\RepoImpl\IndustryRepoImpl');
        $this->app->bind('App\Domain\Repo\EducationRepo',
            'App\Domain\RepoImpl\EducationRepoImpl');
        $this->app->bind('App\Domain\Repo\ProfessionRepo',
            'App\Domain\RepoImpl\ProfessionRepoImpl');
        $this->app->bind('App\Domain\Repo\CompanyRepo',
            'App\Domain\RepoImpl\CompanyRepoImpl');
        $this->app->bind('App\Domain\Repo\InterestRepo',
            'App\Domain\RepoImpl\InterestRepoImpl');
        $this->app->bind('App\Domain\Repo\ExpenseRepo',
            'App\Domain\RepoImpl\ExpenseRepoImpl');

    }
}
