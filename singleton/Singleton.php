<?php
/**
 * Singleton
 * @desc Only allow a single einstance of the class
 */
class Singleton
{
    protected static $instantiated = false;
    protected $name;

    public function __construct() {
        // If instantied, return the current instance
        if (self::$instantiated) {
            return $this;
        }

        // Only allow one instantiation
        self::$instantiated = true;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

/**
 * Example
 */
$singleton = new Singleton();
$singleton->setName('Jesse');

// Returns $singleton instance rather than a new one
$try_new = new Singleton();

// Returns Jesse, non-singletons would return the default value.
$try_new->getName();
