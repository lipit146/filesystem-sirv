# Sirv Images Filesystem Driver
This package provides a filesystem driver for Sirv Images. If you need more control or want to want to implement more Sirv API endpoints have a look at our [Laravel wrapper for Sirv](https://github.com/lipit146/filesystem-sirv) which is also used by this packages.  

The full documentation of the Sirv Images API can be found [here](https://sirv.com/help/articles/s3-api/php-sdk-for-sirv-s3/).

## Requirements

- PHP >= 8.0
- Laravel >= 9.0

## Installation
To start using the package, you need to install it via Composer:
```sh
composer require lipit146/filesystem-sirv
```

### Laravel version compatibility

| Laravel version | Laravel Cloudflare version |
| :-------------- | :------------------------- |
| 8.x             | 1.x                        |

### Service Provider

Add the package service provider in your `config/app.php`

```php
'providers' => [
    // ...
    Lipit146\FilesystemSirv\FilesystemSirvImagesServiceProvider::class,
];
```

## Publish package assets

Publish the package asset files using this `php artisan` command

```sh
$ php artisan vendor:publish --provider="Lipit146\FilesystemSirv\FilesystemSirvImagesServiceProvider"
```

## Confuguration
Add the following to your config/filesystems.php file:
```
'sirv' => [
    'driver' => 'sirv',
    'key' => env('SIRV_ACCESS_KEY_ID'),
    'secret' => env('SIRV_SECRET_ACCESS_KEY'),
    'region' => env('SIRV_DEFAULT_REGION'),
    'bucket' => env('SIRV_BUCKET'),
    'url' => env('SIRV_URL'),
    'endpoint' => env('SIRV_ENDPOINT'),
    'scheme'  => 'https',
],
```
Add the following environment variables to your .env file:
```
SIRV_ACCESS_KEY_ID="<your_email>"
SIRV_SECRET_ACCESS_KEY="<your_access_key>"
SIRV_DEFAULT_REGION="<option_region>"
SIRV_BUCKET="<your_bucket>"
SIRV_ENDPOINT="https://s3.sirv.com"
SIRV_URL="https://<your_bucket>.sirv.com"
```
If you did not have our [Laravel-Sirv](https://github.com/lipit146/filesystem-sirv) wrapper yet you also need to add the following environment variables to your .env file:
```
SIRV_ACCESS_KEY_ID=""
SIRV_SECRET_ACCESS_KEY=""
SIRV_BUCKET=""
```

## Getting started
The Sirv Images filesystem driver can be used as you would use another filesystem driver. The documentation for the Laravel filesystem can be found [here](https://laravel.com/docs/master/filesystem). 

The following example shows how to use the Sirv Images filesystem driver to store a file.
```
use Illuminate\Support\Facades\Storage;

Storage::disk('sirv')->put('example.png', 'contents');
```

## Notes
Sirv Images doesnot support directories so not all filesystem methods are available. The following methods are supported:

- `get`
- `put`
- `delete`
- `directories`

The following methods are not supported:
- `files`
- `allFiles`
- `allDirectories`
- `createDirectory`
- `deleteDirectory`
- `fileExists`
- `url`
- `copy`
- `rename`
- `visibility`

The following methods still need to be implemented:
- `setVisibility`
- `getVisibility`

## Security Vulnerabilities

If you discover a security vulnerability within this project, please email me via [songviytuong@gmail.com](mailto:songviytuong@gmail.com).

## Official Website

- [https://sirv.com](https://sirv.com) - Image CDN: Image Optimization, Processing & Hosting • Sirv
- [https://sirv.com/help/articles/s3-api/php-sdk-for-sirv-s3/](https://sirv.com/help/articles/s3-api/php-sdk-for-sirv-s3/) - PHP SDK for Sirv S3
