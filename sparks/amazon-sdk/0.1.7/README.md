# Amazon AWS SDK for php 

This has been inspired from [Kohana-aws-sdk](http://s.zah.me/AlzyHg).

It has the full amazon sdk for php.

## Requirements :

* Codeigniter : 2.1.X
* PHP 5.3.x
* AWS Account.

## Minimum Requirements in a nutshell

* You are at least an intermediate-level PHP developer and have a basic understanding of object-oriented PHP.
* You have a valid AWS account, and you've already signed up for the services you want to use.
* The PHP interpreter, version 5.2 or newer. PHP 5.2.17 or 5.3.x is highly recommended for use with the AWS SDK for PHP.
* The cURL PHP extension (compiled with the OpenSSL libraries for HTTPS support).
* The ability to read from and write to the file system via file_get_contents() and file_put_contents().
* If you're not sure whether your PHP environment meets these requirements, run the SDK Compatibility Test script included in the SDK download.

## Installation

* Remember to copy the config/storage.php file to your config directory and fill out your aws.information.

## Usage:
* Copy the config/storage.php file to your config directory and fill out your aws.
* Load the spark as usual:

```php
	$this->load->spark('amazon-sdk/x.x.x');
	$s3 = $this->awslib->get_s3();
	$result = $s3->list_buckets();
	echo '<pre>' . print_r($result, TRUE) . '</pre>';
```

## Information :

* For more information about the AWS SDK for PHP, including a complete list of supported services, see [aws.amazon.com/sdkforphp](http://aws.amazon.com/sdkforphp).

## Updates :

* [25/04/2012] : updated SDK to version 1.5.4
* [05/05/2012] : adding dynamicDB function
* [14/05/2012] : update SDK to verion 1.5.5
* [21/05/2012] : update SDK to version 1.5.6
* [16/06/2012] : update SDK to version 1.5.7
* [19/06/2012] : small fix to the way that the config is loaded, and change the name of the file to awslib.
