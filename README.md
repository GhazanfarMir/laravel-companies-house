# Laravel Companies House [![Build Status](https://travis-ci.org/ghazanfarmir/laravel-companies-house.svg?branch=master)](https://travis-ci.org/ghazanfarmir/laravel-companies-house)

Laravel package to access CompaniesHouse API within Laravel application

**Please note, this package is still under development and isn't ready for production yet. Once ready, I will remove this warning; so keep looking at this space.**

## Installation

To install, use the following to pull the package via `Composer`.

```
composer require ghazanfar/laravel-companies-house
```

Now register the Service provider in `config/app.php`

```
'providers' => [
    ...
    Ghazanfar\CompaniesHouse\CompaniesHouseServiceProvider::class,
],
```
And also add the alias to the same file.

```
'aliases' => [
    ...
    'CompaniesHouse' => Ghazanfar\CompaniesHouse\Facades\CompaniesHouse::class,
],
```

## How to use?

```
Put instructions on how to use the package
```

## Configuration

### Obtaining the CompaniesHouse API Key

 - You will need to register an application with **CompaniesHouse** by visiting https://developer.companieshouse.gov.uk/developer/applications.
 - then get API Key which can be used within your Laravel Application.

## Companies House API (Beta release)

 - [Getting started](https://developer.companieshouse.gov.uk/api/docs/) 
 - [Authorisation](https://developer.companieshouse.gov.uk/api/docs/index/gettingStarted/apikey_authorisation.html)
 - [Rate Limitation](https://developer.companieshouse.gov.uk/api/docs/index/gettingStarted/rateLimiting.html)

## Questions
Feel free to submit an issue if you have any issues.

## License

MIT License 2017 - Ghazanfar Mir
