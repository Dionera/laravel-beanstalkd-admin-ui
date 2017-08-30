# Laravel Beanstalkd Admin UI

[![Code Climate](https://codeclimate.com/github/ksassnowski/laravel-beanstalkd-admin-ui/badges/gpa.svg)](https://codeclimate.com/github/ksassnowski/laravel-beanstalkd-admin-ui)
[![Build Status](https://travis-ci.org/Dionera/laravel-beanstalkd-admin-ui.svg?branch=master)](https://travis-ci.org/Dionera/laravel-beanstalkd-admin-ui)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/656659a9-5b94-453f-9780-f6b48c49f15f/mini.png)](https://insight.sensiolabs.com/projects/656659a9-5b94-453f-9780-f6b48c49f15f)
[![Current Version](https://img.shields.io/badge/version-0.3.4-blue.svg)](https://img.shields.io/badge/version-0.3.4-blue.svg)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://img.shields.io/badge/license-MIT-blue.svg)

![](preview.png)

:fire: A slick Admin Interface for monitoring your Beanstalkd queues right out of your Laravel application. :fire:

## Installation

Require the package through composer

```
composer require dionera/laravel-beanstalkd-ui
```

Add the following line to your `providers` array in `config/app.php` to register the service provider into your application.

```php
<?php

// inside config/app.php...

'providers' => [
    // cut for brevity
    Dionera\BeanstalkdUI\BeanstalkdUIServiceProvider::class,
]
```

Next we need to publish the package's assets. We do this by running the following command:

```
php artisan vendor:publish --provider="Dionera\BeanstalkdUI\BeanstalkdUIServiceProvider" --tag="public"
```

This will publish all the required Javascript and CSS into your applications `public/vendor/beanstalkdui` folder.

### Laravel 5.1

This packages by default assumes that you are at least using Laravel 5.2. Nevertheless, it is still fully compatible with Laravel 5.1.
If you are Laravel 5.1 there is simple one additional adjustment to make.

First publish the config file by executing the following artisan command

```
php artisan vendor:publish --provider="Dionera\BeanstalkdUI\BeanstalkdUIServiceProvider" --tag="config"
```

Now open `config/beanstalkdui.php` and remove the `web` entry from the `middleware` array. That's it. You're all good to go!

### View it in the browser

Now navigate to `http://<your-app>/beanstalkd/tubes` in your browser. If you're not already authenticated you will now be asked to log in. This is because by
default all routes use the `auth` middleware. See the [Configuration](#configuration) section for information about how to overwrite this.

## Live Updating

![](https://raw.githubusercontent.com/Dionera/laravel-beanstalkd-admin-ui/master/live_updating.gif)

## Configuration

In order to overwrite the default configuration we first need to publish the package's config file.

```
php artisan vendor:publish --provider="Dionera\BeanstalkdUI\BeanstalkdUIServiceProvider" --tag="config"
```

This will place a `beanstalkdui.php` in your application's `config` folder. Inside you will find the following settings:

| Value | Default | Description |
|-------|--------|:---------|
| `host` | `'127.0.0.1'` | The Beanstalkd host. |
| `port` | `11300` | The Port Beanstalkd is running on. |
| `middleware` | `['web', 'auth']` | An array of middlewares which get applied to all the package's routes. If no middleware should be applied simply remove `auth` from the array. |
| `failed_jobs` | `true` | Defines if you want to be able to also manage your failed jobs through the UI. If set to `true` an additional table containing all failed jobs for the current tube will be displayed. |
| `failed_jobs_table` | `failed_jobs` | The name of the table containing your failed jobs. |
