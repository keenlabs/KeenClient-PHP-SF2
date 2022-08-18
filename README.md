Keen IO Symfony2 Bundle
=======================

[![CI](https://github.com/keenlabs/KeenClient-PHP-SF2/actions/workflows/ci.yml/badge.svg)](https://github.com/keenlabs/KeenClient-PHP-SF2/actions/workflows/ci.yml)

### Overview

The Keen IO Symfony2 Bundle allows you to quickly and easily use the [Keen IO PHP Client](https://github.com/keenlabs/KeenClient-PHP) in your Symfony 2 applications.

### Community-Supported SDK
This is an _unofficial_ community supported SDK. 

### KeenIO Bundle Installation

The best method of installation is through the use of composer.

##### Add the bundle to Composer

```json
{
    "require": {
        "keen-io/keen-io-bundle": "~1.3"
    }
}
```

##### Update AppKernel.php

Add The KeenIO Bundle to your kernel bootstrap sequence

```php
public function registerBundles()
{
	$bundles = array(
    	// ...
    	new KeenIO\Bundle\KeenIOBundle\KeenIOBundle(),
    );

    return $bundles;
}
```

##### Configure the Client

The values for the configuration can be found in the Project Overview section of your Keen IO Dashboard

```
#app/config.yml

keen_io:
	version:    <version> //version is optional and correctly defaults to 3.0
	project_id: <project id>
	master_key: <master key>
	write_key:  <write key>
	read_key:   <read key>
```

### Using the Client

Once configured the client is available through the service container in your application.

```php
#src/AcmeBundle/Controller/YourController

public function indexAction()
{
    $client = $this->get('keen_io');
    $client->addEvent('example_collection', array( 'foo' => 'bar' ));

    // ...
}
```

Or it can be passed into your services through dependency injection:

```
#app/config/services.yml

# Example Tracking Service
tracking.service:
	class: Acme\Bundle\AcmeBundle\Service\Tracking
    arguments:
    	- @keen_io
```

Questions & Support
-------------------
If you have any questions, bugs, or suggestions, please report them via Github Issues. Or, come chat with us anytime at http://keen.chat. We'd love to hear your feedback and ideas!

Contributing
------------
This is an open source project and we love involvement from the community! Hit us up with pull requests and issues.
