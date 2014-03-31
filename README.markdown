JSMysqlndAnalytics
==================

The Mysqlnd Analytics library provides a way for an application to easily
collect statistics about MySQL operations for a given period by making
use of mysqlnd's statistic collection. This library then provides analytics
on top of these statistics to help the user to improve his application.

Requirements
-----------

For making use of this library need an application running on a PHP setup
where the mysqli extension is activated and mysqlnd is being used. The mysqli
extension is only used to retrieve data. It is no requirement for your
application to use to use mysqli. Applications using  Doctrine and PDO are
fully supported.

This library depends on [rezzza/Formulate](https://github.com/rezzza/Formulate).

Composer
--------

This library can be installed using composer:

``` bash
$ php composer.phar require "js/mysqlnd-analytics=1.1.*"
```

Take a look at [the page on Packagist web site](https://packagist.org/packages/js/mysqlnd-analytics) for more details and up-to-date version numbers.

Usage Example
-------------

A simple use case might llook like this:

```php
<?php
use JS\Mysqlnd\Analytics\Engine;
use JS\Mysqlnd\Analytics\DefaultRuleProvider;
use JS\Mysqlnd\Analytics\Calculator;
use JS\Mysqlnd\Analytics\Collector;

$collector = new Collector();
$collector->start();
/* run ext/mysql, mysqli or PDO_mysql queries */

$data = $collector->collect();
$analytics = new Engine(new DefaultRuleProvider(), new Calculator($data));

foreach ($analytics as $analytic) {
    if ($analytic->getMatched()) {
        echo $analytic->getName() . '(Severity: '. $analytic->getSeverity() . ")\n";
        echo $analytic->getGuidance()."\n\n";
    }
}
```

Notes
-----

For Symfony applications an [bundle using this library](https://github.com/johannes/JSMysqlndBundle) exists.

