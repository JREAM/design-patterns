<?php
/**
 * Factory or Factory Method
 * @desc This creates instances of subclasses. If you were wanted to load various shipping vendors this would work.
 *
 * All items in a factory must have the same methods, so use an abstract class to enforce this.
 *
 * In reality you should would name this:
 *     - ShippingFactory
 *     - AbstractShippingFactory
 */
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

// This enforces rules on our SubClasses so they
// are all the same.
abstract class AbstractProvider {
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

/**
 * Example
 */
$factory = new Factory();
$ups   = $factory->createProvider('UPS');
$fedex = $factory->createProvider('FedEx');

echo $ups->getName() . '<br>';
echo $ups->getStdRate() . '<br>';
echo '<hr>';
echo $fedex->getName() . '<br>';
echo $fedex->getStdRate() . '<br>';
