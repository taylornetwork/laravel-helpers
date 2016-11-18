<?php

namespace TaylorNetwork\LaravelHelpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TaylorNetwork\LaravelHelpers\Commands\HelperMakeCommand;

class LaravelHelpersServiceProvider extends ServiceProvider
{
    /**
     * The path to package helpers
     * 
     * @var string
     */
    protected $packageHelperPath;

    /**
     * Pattern to include package helpers by
     * 
     * @var string
     */
    protected $packageHelperPattern;

    /**
     * The package helpers
     * 
     * @var array
     */
    protected $packageHelpers;

    /**
     * The package helpers to include
     * 
     * @var array
     */
    protected $packageInclude;

    /**
     * The user created helpers to include
     * 
     * @var array
     */
    protected $customInclude;

    /**
     * The user created helpers to exclude
     * 
     * @var array
     */
    protected $customExclude;

    /**
     * The namespace to store user created helpers
     * 
     * @var string
     */
    protected $namespace;

    /**
     * LaravelHelpersServiceProvider constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->packageHelperPath = __DIR__ . '/helpers';
        $this->packageHelperPattern = $this->packageHelperPath . '/{dashName}/src/{underscoreName}.php';
        $this->packageHelpers = glob($this->packageHelperPath.'/*');

        $this->packageInclude = config('laravel_helpers.helpers', ['*']);
        $this->customInclude = config('laravel_helpers.include', ['*']);
        $this->customExclude = config('laravel_helpers.exclude', []);
        $this->namespace = config('laravel_helpers.namespace', 'Helpers');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/laravel_helpers.php' => config_path('laravel_helpers.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/laravel_helpers.php', 'laravel_helpers'
        );
        
        $this->registerCommands();
        $this->registerCustomHelpers();
        $this->registerPackageHelpers();
    }

    /**
     * Register Commands
     */
    public function registerCommands()
    {
        $this->commands([
            HelperMakeCommand::class,
        ]);
    }

    /**
     * Register the package helpers
     */
    public function registerPackageHelpers()
    {
        foreach($this->packageHelpers as $helper)
        {
            $dashName = last(explode('/', $helper));
            $underscoreName = str_replace('-', '_', $dashName);

            if(in_array('*', $this->packageInclude) ||
                in_array($dashName, $this->packageInclude) ||
                in_array($underscoreName, $this->packageInclude))
            {
                require_once $this->replaceVariables($this->packageHelperPattern, compact('dashName', 'underscoreName'));
            }
        }

    }

    /**
     * Register custom helpers
     */
    public function registerCustomHelpers()
    {
        foreach(glob(app_path($this->namespace.'/*')) as $helper)
        {
            $helperName = last(explode('/', $helper));
            if(!in_array($helperName, $this->customExclude))
            {
                if(in_array('*', $this->customInclude) || in_array($helperName, $this->customInclude))
                {
                    require_once $helper;
                }
            }
        }
    }

    /**
     * Replace variables in string with their values.
     *
     * @param $string
     * @param array $replaces
     * @return string
     */
    public function replaceVariables($string, $replaces = [])
    {
        $callback = function ($match) use ($replaces) {
            $variable = trim($match[0], '{}');

            if(array_key_exists($variable, $replaces))
            {
                return $replaces[$variable];
            }

            return $variable;
        };

        return preg_replace_callback('/{.*?}/', $callback, $string);
    }
}
