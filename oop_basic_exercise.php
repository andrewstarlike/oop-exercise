<?php

/*
 * The purspose of this file is to do basic PHP OOP Exercises
 * I'll try to pass through most important features
 * Inspiration:
 * http://www.phpbuilder.com/articles/application-architecture/object-oriented/advanced-object-oriented-programming-in-php.html
 * http://stackoverflow.com/questions/1912902/what-exactly-are-late-static-bindings-in-php
 */

/**
 * Helper functions
 */
require_once('functions.php');

/**
 * Basic inheritance (using public methods the child class 
 * will inherit methods and properties from the parent class)
 */
Class Employee {

    public $firstName;
    public $lastName;
    public $salary;

    public function dailiyCommonTask() {
//general code for all types of employees
    }

}

class Acountant extends Employee {

    public function processMonthlySalary($salary) {
        var_dump($salary);
//code for processing salary of the acountat employee type
    }

}

/**
 * Demonstration and basic usage
 */
$acountant = new Acountant();
dumpPropertiesAndMethods($acountant);
$acountant->processMonthlySalary($acountant->salary);

/**
 * Accessors and mutators
 * In decent PHP OOP properties are accessed and set via methods called accessors and mutators.
 * Thus we are providing a single point for accessing and setting that property.
 * You need some practice to realize how important these methods really are.
 * On this path you will never go back.
 */
class Dog {

    public $name;
    public $type;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getType() {
        return $this->getType();
    }

    public function setType($type) {
        $this->type = $type;
    }

}

/**
 * Demonstration
 */
$dog = new Dog();
dumpPropertiesAndMethods($dog);

/**
 * Static keyword.
 * Using static keyword is common practice in OOP PHP.
 * Static methods or variables are used without creating an instance of the class.
 * $this (the reference of the instance) is not alowed since we don't have an instance of the class.
 */
class StaticSample {

    public static $myStaticVar;

    public static function setStaticValue() {
        self::$myStaticVar = 'some value defined';
        return self::$myStaticVar;
    }

}

class StaticShow extends StaticSample {

    public function checkStaticMethod() {
        return parent::setStaticValue() . ' and some addon';
    }

}

/**
 * Demonstration and usage
 */
var_dump(StaticSample::setStaticValue()); //notice class is not instantiated
$staticShow = new StaticShow;
var_dump($staticShow->checkStaticMethod()); //only the second class is instantiated

/**
 * Abstract classes can't be instantiated but they can be inherited.
 * Unlike interfaces they can contain code logic (method body).
 * Unlike interfaces but like normal classes only one single abstract class can be extended.
 */
abstract class testPartentAbstract {

    public function myWrittenFunction() {
        //body of the method
    }

}

class testChildAbstract extends testPartentAbstract {

    public function myWittenFunctionInChild() {
        //body of the method
    }

}

/**
 * Demonstration
 */
$testChildAbstract = new testChildAbstract();
dumpPropertiesAndMethods($testChildAbstract);

/**
 * Intefaces.
 * By implementing an interface we force a class to follow the methods defined in the interface.
 * A class can implement multiple interfaces.
 */
interface MyIFace {

    public function myFunction($name);
}

class myImplementation implements MyIFace {

    public function myFunction($name) {
        //function body
    }

}

/**
 * Demonstration
 * Notice that if the class myImplementation wouldn't contain the same method as 
 * the interface we would receive an error. Play with this :)
 */
$myImplementation = new myImplementation();
dumpPropertiesAndMethods($myImplementation);

/**
 * Late static binding since PHP 5.3
 * Advanced topic in the PHP world, one of my favourite.
 * More explanations here http://stackoverflow.com/questions/1912902/what-exactly-are-late-static-bindings-in-php
 * Late static binding was a feature introduced in PHP 5.3.
 * It alows is to inherit static methods from a parent class and to reference the child class being called.
 * You are able to reference the child class using the static::method() while the self::method() will reference the parent.
 * A more complicated example of static vs self http://stackoverflow.com/a/24285655/1056285 and public vs private (great example once understood!)
 */
class Animal {

    public static function init() {
        return static::getAnimalName();
    }

    public static function displayWeight() {
        return self::getWeight();
    }

    private static function getAnimalName() {
        return 'Animal <br />';
    }

    private static function getWeight() {
        return '10 kg';
    }

}

class Bird extends Animal {

    public static function getAnimalName() {
        return 'Bird <br />';
    }

    public static function getWeight() {
        return '2 kg';
    }

}

/**
 * Demonstration
 * Notice the self keyword in Animal::displayWeight - if one would replace self with
 * static the output would be as expected - play with this :)
 */
var_dump(Animal::init());
var_dump(Animal::displayWeight());
var_dump(Bird::init());
var_dump(Bird::displayWeight());

/**
 * Something about traits?!?
 */
