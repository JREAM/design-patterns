<?php
/**
 * Singleton
 *
 * @desc
 *     Allows only one instance of the class.
 *     The modern way allows you to define Singleton once.
 *
 * @usage
 *     You only wanted one Database object.
 *     You only wanted one Front Controller (MVC).
 *
 * @example
 *     We create a fake Singleton Database Object.
 *
 */
require_once '../constants.php'; // For NEWLINE output

class Singleton
{
    /**
     * This stores the only instance of this class.
     *
     * @var boolean|object
     */
    private static $instance = false;

    /**
     * This is how we get our single instance
     *
     * @return object
     */
    public static function getInstance() {
        // If we have no instance, create one.
        if (self::$instance == false) {
            self::$instance = new static();
        }

        // Late Static Binding,
        // Allows Pattern to be Re-used
        return self::$instance;
    }


    /**
     * Don't allow the "new Class" construct
     */
    protected function __construct() {}

    /**
     * Don't allow clones of this object
     */
    private function __clone() {}

    /**
     * Don't allow serialization of this object
     */
    private function __wakeup() {}
}

// --------------------------------------------------------
// Fake Class(es) for Example
// --------------------------------------------------------
class Database extends Singleton
{
    protected $dsn;

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
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$database = Database::getInstance();
$database->setDsn('mysql://');

echo $database->getDsn();
echo NEWLINE;

// Getting the instance again will still use the same instance
$foo = Database::getInstance();
$foo->setDsn('postgres://');

echo $foo->getDsn();
echo NEWLINE;
echo $database->getDsn();
echo NEWLINE;
