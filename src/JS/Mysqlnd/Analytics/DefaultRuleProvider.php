<?php

namespace JS\Mysqlnd\Analytics;

/**
 * Default set of rules.
 *
 * By default rules are loaded from an XML file called analytics.xml which
 * has to be located next to this file.
 *
 * @todo Don't hard-code the location
 */
class DefaultRuleProvider extends XMLRuleProvider 
{
    public function __construct()
    {
        parent::__construct(__DIR__.'/analytics.xml');
    }
}

