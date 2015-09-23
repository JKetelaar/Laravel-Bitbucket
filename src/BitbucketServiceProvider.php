<?php
/**
 * @author JKetelaar
 */
namespace JKetelaar\Bitbucket;

use Bitbucket\API\Api;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use JKetelaar\Bitbucket\Authenticators\AuthenticatorFactory;

class GitHubServiceProvider extends ServiceProvider {
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot() {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig() {
        $source = realpath(__DIR__ . '/../config/bitbucket.php');
        if (class_exists('Illuminate\Foundation\Application', false)) {
            $this->publishes([$source => config_path('bitbucket.php')]);
        }
        $this->mergeConfigFrom($source, 'bitbucket');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->registerAuthFactory($this->app);
        $this->registerGitHubFactory($this->app);
        $this->registerManager($this->app);
        $this->registerBindings($this->app);
    }

    /**
     * Register the auth factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerAuthFactory(Application $app) {
        $app->singleton('bitbucket.authfactory', function () {
            return new AuthenticatorFactory();
        });
        $app->alias('bitbucket.authfactory', AuthenticatorFactory::class);
    }

    /**
     * Register the github factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBitbucketFactory(Application $app) {
        $app->singleton('bitbucket.factory', function ($app) {
            $auth = $app['bitbucket.authfactory'];
            $path = $app['path.storage'] . '/bitbucket';
            return new BitbucketFactory($auth, $path);
        });
        $app->alias('bitbucket.factory', BitbucketFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app) {
        $app->singleton('bitbucket', function ($app) {
            $config = $app['config'];
            $factory = $app['bitbucket.factory'];
            return new BitbucketManager($config, $factory);
        });
        $app->alias('bitbucket', BitbucketManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app) {
        $app->bind('bitbucket.connection', function ($app) {
            $manager = $app['bitbucket'];
            return $manager->connection();
        });
        $app->alias('bitbucket.connection', Api::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides() {
        return [
            'bitbucket.authfactory',
            'bitbucket.factory',
            'bitbucket',
            'bitbucket.connection',
        ];
    }
}
