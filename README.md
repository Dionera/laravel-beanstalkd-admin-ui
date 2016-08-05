# Laravel Beanstalkd Admin UI

[![Code Climate](https://codeclimate.com/github/ksassnowski/laravel-beanstalkd-admin-ui/badges/gpa.svg)](https://codeclimate.com/github/ksassnowski/laravel-beanstalkd-admin-ui)
[![Build Status](https://travis-ci.org/Dionera/laravel-beanstalkd-admin-ui.svg?branch=master)](https://travis-ci.org/Dionera/laravel-beanstalkd-admin-ui)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/656659a9-5b94-453f-9780-f6b48c49f15f/mini.png)](https://insight.sensiolabs.com/projects/656659a9-5b94-453f-9780-f6b48c49f15f)

![](https://raw.githubusercontent.com/ksassnowski/laravel-beanstalkd-admin-ui/master/preview.png)

A slick Admin Interface for managing and monitoring Beanstalkd right out of your Laravel application.

## Installation

Require the package through composer

```
composer require dionera/laravel-beanstalkd-ui
```

Add the following line to your `providers` array in `config/app.php` to register the service provider into your application.

```php
<?php

// config/app.php

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

Now navigate to `beanstalkd/tubes` in your browser. If you're not already authenticated you will now be asked to log in. This is because by
default all routes use the `auth` middleware. See the `Configuration` section for information about how to overwrite this.

## Features

_This sections is still under construction_

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
| `middleware` | `['auth']` | An array of middlewares which get applied to all the package's routes. If no middleware should be applied simply provide `[]`. |
