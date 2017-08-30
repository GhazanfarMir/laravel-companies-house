# Laravel Companies House [![Build Status](https://travis-ci.org/ghazanfarmir/laravel-companies-house.svg?branch=master)](https://travis-ci.org/ghazanfarmir/laravel-companies-house) [![StyleCI](https://styleci.io/repos/100057895/shield?branch=master)](https://styleci.io/repos/100057895)

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

#### Company

```
// search companies by name

CompaniesHouseApi::company()->search('Company name');
```

`CompaniesHouseApi::company()->find('company number')` is now going to return an **object** which can be chained to get other resources related data.

For example, calling `get()` on the object will return company information:

```
// find companies by number

CompaniesHouseApi::company()->find('company number')->get();
```

Similarly, you may get information related to other company resources such offices, company_registered_office, filing_history etc using the helper method **with()** which accepts an array of resources you need.

**Example**

```
$obj = CompaniesHouseApi::company()->with('officers')->find('company_number');

$company = $obj->get();

$officers = $obj->officers();

...
```

You may include more than one resources in **with()** within an array as follows:

```

$obj = CompaniesHouseApi::company()->with(['officers', 'registered_office_address'])->find('company_number');

$officers = $obj->officers(); // get company's officers collection

$registered_address = $obj->registeredOfficeAddress(); // get company's registered address

```

#### Officers

```
CompaniesHouseApi::officers()->search('Mir'); // search officers by name
```

```
CompaniesHouseApi::officers()->disqualified()->search('Mir'); // search disqualified officers
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
