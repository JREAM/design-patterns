<?php
/**
 * Factory (Factory Method)
 *
 * @desc
 *     This loads/creates instances of it's common subclasses.
 *     It's really a factory, something that produces classes.
 *
 *     All items in a factory must have the same methods,
 *         so an abstract class is used to enforce this.
 *
 * @usage
 *     Load various Shipping Suppliers.
 *
 * @example
 *     We will create a Shipping Provider Factory.
 *     In reality you should would name the classes:
 *         - ShippingFactory
 *         - AbstractShippingFactory
 */
require_once '../constants.php'; // For NEWLINE output

class Factory
{
    // Thsi generates
    public function createProvider($provider) {
        // In reality you would want to check things
        // like casing of the class, namespaces, etc..
        if (class_exists($provider)) {
            return new $provider;
        }
        return false;
    }
}

// --------------------------------------------------------
// Fake Class(es) for Example
// --------------------------------------------------------

abstract class AbstractProvider {
    // This enforces rules on our SubClasses so they
    // are all the same.
    abstract function getName();
    abstract function getStdRate();
}

// A Factory Item thats Generated
class UPS extends AbstractProvider {

    private $name = 'UPS';

    public function getName() {
        return $this->name;
    }

    public function getStdRate() {
        return 22.00;
    }
}

// Another Factory Item thats Generated
class FedEx extends AbstractProvider {

    private $name = 'UPS';

    public function getName() {
        return $this->name;
    }

    public function getStdRate() {
        return 20.00;
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$factory = new Factory();
$ups   = $factory->createProvider('UPS');
$fedex = $factory->createProvider('FedEx');

echo NEWLINE;
echo $ups->getName();
echo NEWLINE;
echo $ups->getStdRate();

echo str_repeat(NEWLINE, 2);

echo $fedex->getName();
echo NEWLINE;
echo $fedex->getStdRate();
echo NEWLINE;