# MTS Communicator PHP API

PHP wrapper around the MTS Communicator M2M API https://mcommunicator.ru/M2M/m2m_api.asmx

## Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require darkridder/mts-communicator-php-api "*"
```

or add

```
"darkridder/mts-communicator-php-api": "*"
```

to the require section of your `composer.json` file.

## Usage
-----

```php
$mts = new \MtsCommunicator\Client('login', 'password');
$sender = new \MtsCommunicator\Send($mts);
$result1 = $sender->message('Message', "71010000000");
$result2 = $sender->messages('Message', ['71010000000', '71010000001']);
```

## License

Apache 2.0