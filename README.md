Laravel Bitbucket
==============

Laravel Bitbucket was created by, and is maintained by [JKetelaar](https://github.com/JKetelaar), and is a [PHP Bitbucket API](https://bitbucket.org/gentlero/bitbucket-api) bridge for [Laravel 5](http://laravel.com). It utilises Graham its [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package.


## Installation

[PHP](https://php.net) 5.5+ and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Bitbucket, simply run

```
composer require "jketelaar/bitbucket"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel GitHub is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'JKetelaar\Bitbucket\BitbucketServiceProvider'`

You can register the GitHub facade in the `aliases` key of your `config/app.php` file if you like.

* `'Bitbucket' => 'JKetelaar\Bitbucket\Facades\Bitbucket'`