# README
[![Build Status](https://travis-ci.org/aiphilos/api-sdk-php.svg?branch=master)](https://travis-ci.org/aiphilos/api-sdk-php) [![Latest Stable Version](https://poser.pugx.org/aiphilos/api-sdk-php/v/stable)](https://packagist.org/packages/aiphilos/api-sdk-php) [![Total Downloads](https://poser.pugx.org/aiphilos/api-sdk-php/downloads)](https://packagist.org/packages/aiphilos/api-sdk-php) [![Latest Unstable Version](https://poser.pugx.org/aiphilos/api-sdk-php/v/unstable)](https://packagist.org/packages/aiphilos/api-sdk-php) [![License](https://poser.pugx.org/aiphilos/api-sdk-php/license)](https://packagist.org/packages/aiphilos/api-sdk-php)
## Installation
The best way to install this library is to use [composer](https://getcomposer.org/).

```json
{
    "require": {
        "aiphilos/api-sdk-php": "1.*"
    }
}
```

## Usage
### Semantics
#### Creating, configuring and using the default client
```php
//create client
$c = new Aiphilos\Api\Semantics\Client();
//configurate default settings
$c->setAuthCredentials('user', 'pass');
$c->setDefaultLanguage('de-de');
//parses a single string
$res = $c->parseString('Ordner');
//parse multiple strings
$res = $c->parseStrings(array('Ordner leitz', 'tastatur'));
//or
$res = $c->parseStrings(array('example_1' => 'Ordner leitz', 'example_2' => 'tastatur'));
```

### Using custom implementations for Lexemes and Synsets
```php
Aiphilos\Api\Semantics\LexemeFactory::setDefaultClass('My\Namespace\And\Classname'); //instance of Aiphilos\Api\Semantics\LexemeInterface
Aiphilos\Api\Semantics\SynsetFactory::setDefaultClass('My\Namespace\And\Classname'); //instance of Aiphilos\Api\Semantics\SynsetInterface
```

## License
This library is available under the [Apache 2.0 License](LICENSE).
