# Laravel Helpers

A collection of useful helper functions for Laravel. Also will include user created helper functions.

## Install

Via Composer

``` bash
$ composer require taylornetwork/laravel-helpers
```

## Setup

Add the service provider to the providers array in your `config/app.php`

``` php
'providers' => [

	TaylorNetwork\LaravelHelpers\LaravelHelpersServiceProvider::class,

];
```

### Publish Config

``` bash
$ php artisan vendor:publish
```

This adds `laravel_helpers.php` to your `config` directory

## Usage

To create a helper function 

``` bash
$ php artisan make:helper HelperName
```

Will create an `app/Helpers` directory and add `HelperName.php`

``` php 
\\ app/Helpers/HelperName.php

if(!function_exists('HelperName'))
{
	/**
	 * HelperName 
	 */ 
	function HelperName ()
	{
		// Code
	}
}
```

This will automatically be included and you can call `HelperName()` anywhere in your code.

### Customization

By default `TaylorNetwork\LaravelHelpers\LaravelHelpersServiceProvider` will include all helpers included with this package and all helpers found in `app\Helpers`. You can change this in `config/laravel_helpers.php`


## Credits

- Main Author: [Sam Taylor][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/taylornetwork