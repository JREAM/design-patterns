<?php
/**
 * Prototype
 *
 * @desc
 *     This is like cloning sheep and multiplying them rapidly.
 *
 *
 * @usage
 *     desc
 *
 * @example
 *     We will clone sheep.
 */
require_once '../constants.php'; // For NEWLINE output

class Prototype
{
    public static $instances = 0;

    public function __construct() {
        // Increment how many instances there are
        $this->instance = ++self::$instances;
    }

    public function __clone() {
        $this->instance = ++self::$instances;
    }
}

// --------------------------------------------------------
// Fake Class(es) for Example
// --------------------------------------------------------
class Sheep
{
    public $herd = [];

    public function __clone() {
        // If we don't clone the variable rather than the class,
        // it will copy an existing instance.
        $this->herd[] = clone $this->herd[0];
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$prototype = new Prototype();
$sheep = new Sheep();
$sheep->herd[] = clone $sheep;
$sheep->herd[] = clone $sheep;

$cloned_herd = clone($sheep);

echo NEWLINE;
echo 'Main Sheep Object:<br>';
print_r($sheep);

echo NEWLINE;
echo 'Cloned Sheep Objects:<br>';
print_r($cloned_herd);
echo NEWLINE;