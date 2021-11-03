# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [4.0.0] - 2021-11-03
### Added
- Added support for PHP 8

### Changed
- Dropped support for Laravel 7

## [3.1.1] - 2020-09-13
### Changed
- Added minimum version for `laravel/framework` dependency

## [3.1.0] - 2020-09-13
### Changed
- Added support for Laravel 8


## [3.0.0] - 2020-06-07
### Changed 
- Replace `phpspec/phpspec` with `pestphp/pest`
- Add typed properties where possible
- Drop support for Laravel 6
- Drop support for PHP 7.3

## [2.0.2] - 2019-09-16
### Changed
- Views now get published as well when running `artisan vendor:publish`

## [2.0.1] - 2019-09-16
### Changed
- Added support for Laravel ^6.0

## [2.0.0] - 2019-04-29
### Changed
- Added support for Laravel 5.8
- Dropped support for Laravel versions older than 5.7.28

## [1.3.0] - 2018-07-17
### Added
- Added extra column to failed jobs table containing the exception. (#11)

## [1.2.0] - 2018-02-12
### Added
- Add support for Laravel 5.6 (#9)

## [1.1.0] - 2018-01-31
### Added
- Added configuration option to prefix ui route with a custom prefix.

## [1.0.0] - 2017-08-30
### Added
- Add support for Laravel 5.5 package auto discovery.

### Changed
- Require PHP 7 or higher

## [0.3.4] - 2017-04-23
### Changed
- Removed middleware groups from `routes` file. Now these can actually be overwritten using the config .

## [0.3.3] - 2016-09-09
### Changed
- Moved actions column in failed jobs table to the left
- Added `current-watching` stat to overview table

## [0.3.2] - 2016-08-15
### Changed
- Use more precise descriptions in the stat descriptions according to the [Beanstalkd Protocol](https://raw.githubusercontent.com/kr/beanstalkd/master/doc/protocol.txt).

## [0.3.1] - 2016-08-12
### Changed
- Added missing `use` statement

## [0.3.0] - 2016-08-12
### Added
- Added table to manage failed jobs for a queue.

### Changed
- Turn most of the HTML into Vue components

## [0.2.2] - 2016-08-07
### Changed
- Fix out of date composer dependencies

## [0.2.1] - 2016-08-06
### Changed
- Added missing Javascript files

## [0.2.0] - 2016-08-06
### Added
- Tubes view now updates in real time

### Changed
- Fixed broken table layout

## [0.1.1] - 2016-08-05
### Changed
- Add missing `web` middleware to default configuration

[4.0.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/3.1.1...4.0.0
[3.1.1] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/3.1.0...3.1.1
[3.1.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/3.0.0...3.1.0
[3.0.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/2.0.2...3.0.0
[2.0.2] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/2.0.1...2.0.2
[2.0.1] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/2.0.0...2.0.1
[2.0.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/1.3.0...2.0.0
[1.3.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/1.2.0...1.3.0
[1.2.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/1.1.0...1.2.0
[1.1.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/1.0.0...1.1.0
[1.0.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.3.4...1.0.0
[0.3.4] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.3.3...0.3.4
[0.3.3] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.3.2...0.3.3
[0.3.2] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.3.1...0.3.2
[0.3.1] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.3.0...0.3.1
[0.3.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.2.2...0.3.0
[0.2.2] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.2.1...0.2.2
[0.2.1] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.2.0...0.2.1
[0.2.0] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.1.1...0.2.0
[0.1.1] https://github.com/Dionera/laravel-beanstalkd-admin-ui/compare/0.1.0...0.1.1
