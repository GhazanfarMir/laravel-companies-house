# Laravel Companies House 

[![Build Status](https://travis-ci.org/ghazanfarmir/laravel-companies-house.svg?branch=master)](https://travis-ci.org/ghazanfarmir/laravel-companies-house) [![StyleCI](https://styleci.io/repos/100057895/shield?branch=master)](https://styleci.io/repos/100057895) [![License](https://poser.pugx.org/ghazanfarmir/laravel-companies-house/license)](https://packagist.org/packages/ghazanfarmir/laravel-companies-house) [![Latest Stable Version](https://poser.pugx.org/ghazanfarmir/laravel-companies-house/v/stable)](https://packagist.org/packages/ghazanfarmir/laravel-companies-house)

This Laravel Package implements an API client for the Companies House REST API. It can be used to look up information about companies registered in the United Kingdom.
As of July 2016, this API is described by Companies House as a "beta service."
More information about this free API can be found
[on the Companies House API website](https://developer.companieshouse.gov.uk/api/docs/index.html).

**Please note, this package is still under development and isn't ready for production yet. Once ready, I will remove this warning; so keep looking at this space.**

## Installation

To install, use the following to pull the package via Composer.

```
composer require ghazanfarmir/laravel-companies-house
```

Now register the Service Provider in config/app.php

```
'providers' => [
    
    ...
    
    GhazanfarMir\CompaniesHouse\CompaniesHouseServiceProvider::class,
],
```
And also add the alias to the same file.

```
'aliases' => [
    
    ...
    
    'CompaniesHouse' => GhazanfarMir\CompaniesHouse\Facades\CompaniesHouse::class,
],
```

## How to use?

#### Search

```
CompaniesHouse::search()->all('Ebury');
CompaniesHouse::search()->companies('Ebury');
CompaniesHouse::search()->officers('Ebury');
CompaniesHouse::search()->disqualified_officers('Ebury');
```

#### Companies

```
CompaniesHouse::companies('07086058'); // returns an object
CompaniesHouse::companies('07086058')->get();
CompaniesHouse::companies('07086058')->registered_office_address();
CompaniesHouse::companies('07086058')->officers();
CompaniesHouse::companies('07086058')->insolvency();
CompaniesHouse::companies('07086058')->establishments();
CompaniesHouse::companies('07086058')->registers(); // returns 404
CompaniesHouse::companies('07086058')->excemptions();
```

#### Charges

```
CompaniesHouse::charges('07086058')->all();
CompaniesHouse::charges('07086058')->find(chargesId);
```

#### Filing History

```
CompaniesHouse::filingHistory('07086058')->all();
CompaniesHouse::filingHistory('07086058')->find('MzE4MjE3NzM2MGFkaXF6a2N4');
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
