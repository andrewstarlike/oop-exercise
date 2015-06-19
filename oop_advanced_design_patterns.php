<?php

/*
 * The purspose of this file is to do advanced PHP OOP Exercises
 * by implementing most common design patterns (Factory, Singleton, Strategy and Facade)
 * Inspiration:
 * http://www.phptherightway.com/pages/Design-Patterns.html
 * http://code.tutsplus.com/series/design-patterns-in-php--cms-747
 */

/**
 * Factory pattern.
 * Useful to create an object from a single point in the application.
 */
class Automobile {

    private $vehicleMake;
    private $vehicleModel;

    public function __construct($make, $model) {
        $this->vehicleMake = $make;
        $this->vehicleModel = $model;
    }

    public function getMakeAndModel() {
        return $this->vehicleMake . ' ' . $this->vehicleModel;
    }

}

class AutomobileFactory {

    public static function create($make, $model) {
        return new Automobile($make, $model);
    }

}

$veyron = AutomobileFactory::create('Bugatti', 'Veyron');
print_r($veyron->getMakeAndModel()); //"Bugatti Veyron"

/**
 * Singleton pattern.
 * Useful to create only one single instance even if it is used multiple times.
 */
class Singleton {

    /**
     * The reference to singleton class
     * @var type 
     */
    private static $instance;

    /**
     * Returns the Singleton instance of this class
     * @return type
     */
    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Protected constructor to prevent creating a new instance via the new operator
     */
    protected function __construct() {
        
    }

    /**
     * Private clone to prevent object cloning
     */
    private function __clone() {
        
    }

    /**
     * Private unserialize method to prevent unserializing of the Singleton
     */
    private function __wakeup() {
        
    }

}

$object = Singleton::getInstance();
var_dump($object === Singleton::getInstance()); //true

/**
 * Strategy pattern.
 * Useful to encapsulate specific families of algorithms allowing the client class 
 * responsible for instantiating a particular algorithm to have no knowledge of the 
 * actual implementation.
 */
interface OutputInterface {

    public function load($arrayOfData);
}

class SerializedArrayOutput implements OutputInterface {

    public function load($arrayOfData) {
        return serialize($arrayOfData);
    }

}

class JsonStringOutput implements OutputInterface {

    public function load($arrayOfData) {
        return json_encode($arrayOfData);
    }

}

class ArrayOutput implements OutputInterface {

    public function load($arrayOfData) {
        return $arrayOfData;
    }

}

/**
 * Client class that uses an algorithm from the above and sets the behaviour required
 * at runtime.
 */
class SomeClient {

    private $output;

    public function setOutputType(OutputInterface $outputType) {
        $this->output = $outputType;
    }

    public function loadOutput($arrayOfData) {
        return $this->output->load($arrayOfData);
    }

}

/**
 * Usage
 */
$client = new SomeClient();
//an array
$client->setOutputType(new ArrayOutput());
$arrayData = $client->loadOutput(array(1 => 2));
var_dump($arrayData);

//JSON
$client->setOutputType(new JsonStringOutput());
$jsonData = $client->loadOutput(array(1 => 2));
var_dump($jsonData);

/**
 * Facade pattern ?!?
 */