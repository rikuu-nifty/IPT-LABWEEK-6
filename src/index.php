<?php
require "../vendor/autoload.php";

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('ipt10');
$log->pushHandler(new StreamHandler('ipt10.log'));

// add records to the log
$log->warning('[Jansen Earl G. Venal]');
$log->error('[venal.jansenearl@auf.edu.ph]');
$log->info('profile', [
    'student_number' => '[19-2255-291]',
    'college' => '[College of Computer Studies]',
    'program' => '[Bachelor of Information Technology]',
    'university' => '[Angeles University Foundation]'
]);

class TestClass
{
    private $logger;

    public function __construct($logger_name)
    {
        $this->logger = new Logger($logger_name);
        // Log that the class has been created
        $this->logger->pushHandler(new StreamHandler('ipt10.log'));
        $this->logger->info(__FILE__ . " Class initialized with logger name {$logger_name}");
    }

    public function greet($name)
    {
        // Provide a greeting message with the name of the invoker
        $greeting = "Greetings to {$name}";
        echo $greeting . PHP_EOL;

        // Log it
        $this->logger->info(__METHOD__ . " Greeting sent to {$name}");
    }

    public function getAverage($data)
    {
        $average = array_sum($data) / count($data);
        $this->logger->info(__CLASS__ . " Calculated the average", ['average' => $average]);
        return $average;
    }

    public function largest($data)
    {
        $largest = max($data);
        $this->logger->info(__CLASS__ . " Found the largest number", ['largest' => $largest]);
        return $largest;
    }

    public function smallest($data)
    {
        $smallest = min($data);
        $this->logger->info(__CLASS__ . " Found the smallest number", ['smallest' => $smallest]);
        return $smallest;
    }
}

// Create an instance of TestClass and pass the logger name
$obj = new TestClass('TestLogger');

// Define a name for the greet method
$my_name = "Jansen Venal";
$obj->greet($my_name);

// Define an array of numbers for calculations
$data = [100, 345, 4563, 65, 234, 6734, -99];

// Log method outputs
$average = $obj->getAverage($data);
$largest = $obj->largest($data);
$smallest = $obj->smallest($data);

echo "Average: $average" . PHP_EOL;
echo "Largest: $largest" . PHP_EOL;
echo "Smallest: $smallest" . PHP_EOL;

// Log the data array and object
$log->info('data', $data);
$log->info('object', ['class' => get_class($obj)]);
