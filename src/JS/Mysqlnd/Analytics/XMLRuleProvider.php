<?php

namespace JS\Mysqlnd\Analytics;

/**
 * Load rules from an XML file
 *
 * This class loads rule from an XML file.
 */
class XMLRuleProvider implements \IteratorAggregate, RuleProvider 
{
    private $dom;

    public function __construct($filename)
    {
        $this->dom = new \DOMDocument();
        if (!$this->dom->load($filename)) {
            throw new \RuntimeException("Failed to load $filename");
        }
    }

    public function getIterator()
    {
        return new DefaultRuleIterator($this->dom->getElementsByTagName('rule'));
    }
}

/**
 * Internal helper class for DefaultRuleProvider
 */
class DefaultRuleIterator extends \IteratorIterator
{
    public function __construct(\DOMNodeList $nodes)
    {
        // parent::__construct($nodes);
	// Work-around due to Bug #60762 (IteratorIterator doesn't iterate over DomNodeList)
        parent::__construct(new \ArrayIterator(iterator_to_array($nodes)));
    }

    public function current()
    {
        $node = parent::current();
	return new Rule(
            $node->getElementsByTagname('left')->item(0)->textContent,
            $node->getElementsByTagname('right')->item(0)->textContent,
            $node->getElementsByTagname('operator')->item(0)->textContent,
            $node->getAttribute('name'),
	    $node->getAttribute('severity'), 
            $node->getElementsByTagname('guidance')->item(0)->textContent
        );
    }
}

