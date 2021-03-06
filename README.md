# Laravel Helpers

A collection of useful helper functions for Laravel. Also will include user created helper functions.

## Install

Via Composer

``` bash
$ composer require taylornetwork/laravel-helpers
```

## Setup

Laravel should automatically discover the package service provider. If that doesn't work for some reason, follow the Manual Setup.

### Manual Setup

Only use these steps if Laravel does not auto discover the service provider.

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

## Included Helpers

Click on any of the links to see the helper documentation

- [replace_variables][link-replace-variables]
- [associative_implode][link-associative-implode]

## Usage

To create a helper function 

``` bash
$ php artisan make:helper HelperName
```

Will create an `app/Helpers` directory and add `HelperName.php`

``` php 
// app/Helpers/HelperName.php

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
[link-replace-variables]: https://github.com/taylornetwork/replace-variables
[link-associative-implode]: https://github.com/taylornetwork/associative-implode