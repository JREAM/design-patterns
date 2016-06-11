<?php
/**
 * SingletonLegacy
 *
 * @desc
 *     Allows only one instance of the class
 *
 * @example
 *     You only wanted one Database object
 *     You only wanted one Front Controller (MVC)
 */
class SingletonLegacy
{
    /**
     * This stores the only instance of this class.
     *
     * @var boolean|object
     */
    private static $instance = false;

    protected $dsn;

    /**
     * This is how we get our single instance
     *
     * @return object
     */
    public static function getInstance() {
        // If we have no instance, create one.
        if (self::$instance == false) {
            $class = __CLASS__;
            self::$instance = new SingletonLegacy;
        }

        // If we have an instance, return it
        return self::$instance;
    }

    /**
     * Called Internally, but must be protected or private
     */
    private function __construct() {
        return "Class Created.";
    }

    /**
     * Example method (Not part of the pattern)
     *
     * @param string $dsn
     */
    public function setDsn($dsn) {
        $this->dsn = $dsn;
    }

    /**
     * Example method (Not part of the pattern)
     */
    public function getDsn() {
        return $this->dsn;
    }

    /**
     * Don't allow clones of this object
     */
    private function __clone() {}

    /**
     * Don't allow serialization of this object
     */
    private function __wakeup() {}
}

/**
 * Example
 */
$database = SingletonLegacy::getInstance();
$database->setDsn('mysql://');
echo $database->getDsn() . PHP_EOL;

// Getting the instance again will still use the same instance
$foo = SingletonLegacy::getInstance();
$foo->setDsn('postgres://');

echo $foo->getDsn() . PHP_EOL;
echo $database->getDsn() . PHP_EOL;

