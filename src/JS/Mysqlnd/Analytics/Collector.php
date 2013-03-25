<?php
namespace JS\Mysqlnd\Analytics;

/**
 * Class to wrap mysqli_get_client_stats() calls and calculate stas
 *
 * This class wraps calls to mysqli_get_client_stats() and calculates
 * the difference between the initial value and the collection point.
 * This is needed as mysqli_get_client_stats() counts from server
 * start.
 */
class Collector
{
    private $initialData = NULL;

    public static function canCollect()
    {
        return function_exists('mysqli_get_client_stats');
    }

    public function start()
    {
        $this->initialData = mysqli_get_client_stats();
    }

    public function collect()
    {
        $retval = $this->initialData;
        array_walk($retval, function (&$value, $key, $current_values) {
            $value = $current_values[$key] - $value;
        }, mysqli_get_client_stats());
        return $retval;
    }
}
