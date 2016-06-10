<?php
/**
 * Singleton
 * @desc Only allow a single einstance of the sub classes
 *      By having a singleton class, we ar enot limited to writing
 *      static getters and checkers for every singleton object.
 */
class Singleton
{
    private static $instance;

    // This is how we get our instance
    public static function getInstance() {

        // If instantied, return the current instance
        if (self::$instance) {
            return self::$instance;
        }

        // Late Static Binding (not self)
        // Allows this class to be re-used
        return new static();
    }

    // Dont allow this to be fetched with  "new Class;"
    protected function __construct() {}


    // Prevent cloning
    private function __clone() {}

    // Prevent unserialization
    private function __wakeup() {}

}

// Now we can have as many singleton classes as we want
class UserSingleton extends Singleton
{
    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $name;
    }
}

/**
 * Example
 */
$user = new Singleton();
$user->setName('Jesse');
