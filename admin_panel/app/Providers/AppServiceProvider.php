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
        $this->app->bind('App\Domain\Repo\UserRepo',
            'App\Domain\RepoImpl\UserRepoImpl');
        $this->app->bind('App\Domain\Repo\ExpenseRepo',
            'App\Domain\RepoImpl\ExpenseRepoImpl');
        $this->app->bind('App\Domain\Repo\NoticeRepo',
            'App\Domain\RepoImpl\NoticeRepoImpl');
        $this->app->bind('App\Domain\Repo\DepartmentRepo',
            'App\Domain\RepoImpl\DepartmentRepoImpl');
        $this->app->bind('App\Domain\Repo\EmployeeRepo',
            'App\Domain\RepoImpl\EmployeeRepoImpl');
        $this->app->bind('App\Domain\Repo\AccountRepo',
            'App\Domain\RepoImpl\AccountRepoImpl');

        $this->app->bind('App\Domain\Repo\PositionRepo',
            'App\Domain\RepoImpl\PositionRepoImpl');
    }
}
