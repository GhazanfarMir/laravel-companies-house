# Laravel Companies House 

[![Build Status](https://travis-ci.org/GhazanfarMir/laravel-companies-house.svg?branch=master)](https://travis-ci.org/ghazanfarmir/laravel-companies-house)
[![StyleCI](https://styleci.io/repos/100057895/shield?branch=master)](https://styleci.io/repos/100057895) 
[![License](https://poser.pugx.org/ghazanfarmir/laravel-companies-house/license)](https://packagist.org/packages/ghazanfarmir/laravel-companies-house) 
[![Latest Stable Version](https://poser.pugx.org/ghazanfarmir/laravel-companies-house/v/stable)](https://packagist.org/packages/ghazanfarmir/laravel-companies-house)
[![Total Downloads](https://poser.pugx.org/ghazanfarmir/laravel-companies-house/downloads)](https://packagist.org/packages/ghazanfarmir/laravel-companies-house)

This Laravel Package implements an API client for the Companies House REST API. It can be used to look up information about companies registered in the United Kingdom.
As of July 2016, this API is described by Companies House as a "beta service."
More information about this free API can be found
[on the Companies House API website](https://developer.companieshouse.gov.uk/api/docs/index.html).

**Please note, this package is still under development and isn't ready for production yet. Once ready, I will remove this warning; so keep looking at this space.**

## Installation

To install, use the following to pull the package via Composer.

```bash
composer require ghazanfarmir/laravel-companies-house
```

Now register the Service Provider in config/app.php

```php
'providers' => [
    
    ...
    
    GhazanfarMir\CompaniesHouse\CompaniesHouseServiceProvider::class,
],
```
And also add the alias to the same file.

```php
'aliases' => [
    
    ...
    
    'CompaniesHouse' => GhazanfarMir\CompaniesHouse\Facades\CompaniesHouse::class,
],
```
Finally publish the config file.
```bash
php artisan vendor:publish
```

## How to use?

```php
use GhazanfarMir\CompaniesHouse\Facades\CompaniesHouse;
```

#### Search

```php
CompaniesHouse::search()->all('Ebury');
CompaniesHouse::search()->companies('Ebury');
CompaniesHouse::search()->officers('Ebury');
CompaniesHouse::search()->disqualified_officers('Ebury');
```

#### Companies

```php
CompaniesHouse::company('07086058'); // returns an object
CompaniesHouse::company('07086058')->get();
CompaniesHouse::company('07086058')->registered_office_address();
CompaniesHouse::company('07086058')->officers();
CompaniesHouse::company('07086058')->insolvency();
CompaniesHouse::company('07086058')->establishments();
CompaniesHouse::company('07086058')->registers(); // returns 404
CompaniesHouse::company('07086058')->excemptions();
```

#### Charges

```php
CompaniesHouse::charges('07086058')->all();
CompaniesHouse::charges('07086058')->find(chargesId);
```

#### Filing History

```php
CompaniesHouse::filingHistory('07086058')->all();
CompaniesHouse::filingHistory('07086058')->find('MzE4MjE3NzM2MGFkaXF6a2N4');
```

## Configuration

### Obtaining the CompaniesHouse API Key

 - You will need to register an application with **CompaniesHouse** by visiting https://developer.companieshouse.gov.uk/developer/applications.
 - then get API Key which can be used within your Laravel Application in config/companies.php.

## Companies House API (Beta release)

 - [Getting started](https://developer.companieshouse.gov.uk/api/docs/) 
 - [Authorisation](https://developer.companieshouse.gov.uk/api/docs/index/gettingStarted/apikey_authorisation.html)
 - [Rate Limitation](https://developer.companieshouse.gov.uk/api/docs/index/gettingStarted/rateLimiting.html)

## Questions
Feel free to submit an issue if you have any issues.

## Contributing
 - Fork it!
 - Create your feature branch: git checkout -b my-new-feature
 - Commit your changes: git commit -m 'Add some feature'
 - Push to the branch: git push -u origin my-new-feature
 - Submit a pull request - cheers!

## License

MIT License 2017 - Ghazanfar Mir
