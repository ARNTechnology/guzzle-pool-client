# arntech/guzzle-pool-client
[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![PHP Version][badge-php]][php]
[![Total Downloads][badge-downloads]][downloads]

## What is this?
This is a library that implements multiple (hopefully in the future will be more than one) pool types for the Guzzle client.
For the moment, the focus was on using a non locked pool that enables a better async schedule for the remote calls.
### What does that mean?
Guzzle by default has blocking pools. They do not accept newer requests after you call $promise->wait().
The problem with that is if you need to make new calls based on the response from the old calls.
For this, one should (traditionally) wait for the current request queue to settle.

## Installation

The preferred method of installation is via [Composer][]. Run the following
command to install the package and add it as a requirement to your project's
`composer.json`:

```bash
composer require arntech/card
```

## Usage
### Create a new Pool
```php
$pool = new DynamicPool(100);// where 100 is the pool size
```
### Create a client
```php
$pool = new DynamicPool(100);// where 100 is the pool size
$client = new DynamicPoolClient(['pool'=>$pool]);
//or
$client = new DynamicPoolClient(['pool_size'=>100]);// where 100 is the pool size
//or use uniqe calls for each request
$client = new DynamicUniquePoolClient(['pool_size'=>100]);
$client->add($promise, 'key');
```
***DynamicPoolClient*** extends ***GuzzleHttp\Client***.
The constructor accepts all GuzzleHttp\Client arguments plus __pool__ or __pool_size__.
***DynamicUniquePoolClient*** is a client that requires and uses ***DynamicUniquePool*** this pool ensures that any consecutive requests are executed only once. This is achieved by setting a key (for example a hash between url and requested arguments).

## Example
### 1. DynamicPoolClient
```php
$this->client = new DynamicPoolClient(['pool_size'=>10]);
$req1=$this->client->getAsync('http://first.url')
    ->then(function ($response) {
        //do something
        $req2=$this->client->getAsync('http://second.url')
            ->then(function ($response) {
                //do something with response
            });
        $this->client->add($req2);
    });
$this->client->add($req1);
$this->client->wait();
```
### 2. DynamicUniquePoolClient
```php
private function runGet($url)
{
    $this->client->add($this->client->getAsync($url), $url);
}
$this->client = new DynamicUniquePoolClient(['pool_size'=>10]);
$this->runGet('http://first.url');
$this->runGet('http://second.url');
$this->runGet('http://first.url'); //this will be canceled

$this->client->wait();
```

[badge-source]: https://img.shields.io/static/v1?label=source&message=arntech/guzzle-pool-client&color=blue&style=flat-square
[badge-release]: https://img.shields.io/packagist/v/arntech/guzzle-pool-client.svg?style=flat-square&label=release
[badge-license]: https://img.shields.io/packagist/l/arntech/guzzle-pool-client.svg?style=flat-square
[badge-php]: https://img.shields.io/packagist/php-v/arntech/guzzle-pool-client.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/arntech/guzzle-pool-client.svg?style=flat-square&colorB=mediumvioletred

[source]: https://github.com/ARNTechnology/guzzle-pool-client
[release]: https://packagist.org/packages/arntech/guzzle-pool-client
[license]: https://github.com/ARNTechnology/guzzle-pool-client/blob/master/LICENSE
[php]: https://php.net
[downloads]: https://packagist.org/packages/arntech/guzzle-pool-client
