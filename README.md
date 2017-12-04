# aiphilos - Artificial Intelligence as a Service
[![Build Status](https://travis-ci.org/aiphilos/api-sdk-php.svg?branch=master)](https://travis-ci.org/aiphilos/api-sdk-php) [![Latest Stable Version](https://poser.pugx.org/aiphilos/api-sdk-php/v/stable)](https://packagist.org/packages/aiphilos/api-sdk-php) [![Total Downloads](https://poser.pugx.org/aiphilos/api-sdk-php/downloads)](https://packagist.org/packages/aiphilos/api-sdk-php) [![Latest Unstable Version](https://poser.pugx.org/aiphilos/api-sdk-php/v/unstable)](https://packagist.org/packages/aiphilos/api-sdk-php) [![License](https://poser.pugx.org/aiphilos/api-sdk-php/license)](https://packagist.org/packages/aiphilos/api-sdk-php)

**aiphilos** provides natural language processing capabilities including advanced semantical and lexicographical analysis based on recent advancements in Artificial Intelligence technology.

Currently, **aiphilos** provides two sets of APIs:
- **semantics** can split natural human language input into machine-readable chunks and attach additional information usable to deepen natural language understanding in your application (part of speech, word classes and categories, lexicographical data, synonyms/hypernyms/hyponyms, similarity and sentiment data, and learnt knowledge)
- **items** provides a real-time database and search engine backed by **semantics** focused on improving state-of-the-art search results for yor data by adding natural language analysis and Artificial Intelligence as a component to understand the searched data

For more, visit [aiphilos.com](https://aiphilos.com).

For documentation, see [docs.aiphilos.com](https://docs.aiphilos.com).

## Installation
The easiest way to install this library is to use [composer](https://getcomposer.org/).

```json
{
    "require": {
        "aiphilos/api-sdk-php": "1.*"
    }
}
```

## Usage
### Semantics (Semantic analysis of natural language input)

#### Creating and configuring the client
```php
// Create client
$client = new Aiphilos\Api\Semantics\Client();

// Configure client
$client->setAuthCredentials('user', 'pass');
$client->setDefaultLanguage('de-de');
```

#### Parsing a single string
```php
$res = $client->parseString('Ordner');
```

#### Parsing multiple strings
```php
$res = $client->parseStrings(array('Ordner leitz', 'tastatur'));

// Alternative
$res = $client->parseStrings(array('example_1' => 'Ordner leitz', 'example_2' => 'tastatur'));
```

#### Using custom implementations for Lexemes and Synsets
```php
Aiphilos\Api\Semantics\LexemeFactory::setDefaultClass('My\Namespace\And\Classname'); // Instance of Aiphilos\Api\Semantics\LexemeInterface
Aiphilos\Api\Semantics\SynsetFactory::setDefaultClass('My\Namespace\And\Classname'); // Instance of Aiphilos\Api\Semantics\SynsetInterface
```

### Items (Database and search engine)
**TBD**

## License
This library is available under the [Apache 2.0 License](LICENSE).

## Contact
Want to get in touch?
Contact: [aiphilos.com](https://aiphilos.com/kontakt/).
