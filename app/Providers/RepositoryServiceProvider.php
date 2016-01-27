<?php namespace Knoters\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Knoters\Repositories\AssetParameterRepository',
            'Knoters\Repositories\Eloquent\AssetParameterEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\AssetRepository',
            'Knoters\Repositories\Eloquent\AssetEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\EmailRepository',
            'Knoters\Repositories\Eloquent\EmailEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\NoteParameterRepository',
            'Knoters\Repositories\Eloquent\NoteParameterEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\NoteRepository',
            'Knoters\Repositories\Eloquent\NoteEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\ReplyRepository',
            'Knoters\Repositories\Eloquent\ReplyEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\TrafficRepository',
            'Knoters\Repositories\Eloquent\TrafficEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\StatusRepository',
            'Knoters\Repositories\Eloquent\StatusEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\ProjectRepository',
            'Knoters\Repositories\Eloquent\ProjectEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\SourceRepository',
            'Knoters\Repositories\Eloquent\SourceEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\ProjectUserRepository',
            'Knoters\Repositories\Eloquent\ProjectUserEloquentRepository'
        );

        $this->app->bind(
            'Knoters\Repositories\UserRepository',
            'Knoters\Repositories\Eloquent\UserEloquentRepository'
        );
    }

}
