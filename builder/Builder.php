<?php
/**
 * Builder
 * @desc There are two classes, a Builder and a Director. The Builder assembles object or output, The Director defines the setings for the builder.
 *
 * We need something to build with our two classes, so for an example we are going to build a House
 *
 */
class Builder
{
    private $house;

    public function __construct($subject) {
        // Define what we are building
        $this->house = new House();
    }

    public function setSize($size) {
        $this->house->setSize($size);
    }

    public function setColor($color) {
        $this->house->setColor($color);
    }
}

class Director
{
    private $builder;

    public function __construct(Builder $builder) {
        // Builder contains what we are building
        $this->builder = $builder;
    }

    public function buildHouse() {
        $this->builder->setSize('1750 sq.ft');
        $this->builder->setColor('Olive');
    }

    public function getHouse() {
        return $this->builder->getHouse();
    }
}

class House
{
    private $house; // This contains the House object
    private $color;
    private $size;

    public function getHouse()
    {
        return $this->house;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setSize($size) {
        $this->size = $size;
    }
}

/**
 * Example
 */
$builder  = new Builder();
$director  = new Director();
$director->buildHouse();
$house = $director->getHouse();

print '<pre>' . print_r($house) . '</pre>';
