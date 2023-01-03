# Wumbo Framework

***Go from Mini to Wumbo!***

Wumbo is a framework for building simple web applications in PHP.


## Installation

### Install via Composer

[Install Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) if you don't already have it present on your system.

To install the library, run the following command and you will get the latest version:

    $ composer require secondtruth/wumbo:dev-main


## Usage

Create a new file called `public/index.php` and add some code like this:

```php
<?php
namespace Secondtruth\SampleWebsite;

use DI\Container;
use Secondtruth\Wumbo\Application;
use Secondtruth\Wumbo\View\Templating\TemplatingEngineInterface;
use Secondtruth\Wumbo\View\Templating\TwigEngine;
use Secondtruth\Wumbo\Loader\Routes\MultisiteRoutesLoader;

define('APP_ROOT', realpath(__DIR__ . '/..'));
define('CONFIG_DIR', APP_ROOT . '/config');

require APP_ROOT . '/vendor/autoload.php';

// Create a DI container to inject the dependencies you want to use.
// We use the PHP-DI container here, but you can use any other PSR-11 compatible container as well.
// In this example, we set Twig as our template engine.
$container = new Container();
$container->set(TemplatingEngineInterface::class, TwigEngine::create(APP_ROOT . '/resources/views', [
    'cache' => APP_ROOT . '/var/cache/twig',
]));

// Create and set up a routes loader and give it to the application.
$routesLoader = new MultisiteRoutesLoader(CONFIG_DIR);
$routesLoader->registerSite('example.com'); // Give the domain of your website

// Create a new Application instance and set routes loader and container.
$app = new Application($routesLoader, $container);
$app->setCachePath(APP_ROOT . '/var/cache');

$app->run();
```


## Author, Credits and License

This project was created by [Christian Neff](https://www.secondtruth.de) ([@secondtruth](https://github.com/secondtruth))
and is licensed under the MIT license.
  
Thanks to [all other Contributors](https://github.com/secondtruth/wumbo/graphs/contributors)!
