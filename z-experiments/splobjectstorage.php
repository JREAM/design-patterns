<?php
/**
 * This is just for testing things myself.
 *
 * I don't believe SplObjectStorage is better than an Assoc Array in terms of Speed
 * and memory from what I've found. Array = 3% faster but 50% less memory.
 */
require_once '../constants.php';

$storage = new \SplObjectStorage();

interface Animal {
    function talk();
}

class Dog implements Animal {
    public function talk() {
        return 'Arf';
    }
}

class Pig implements Animal {
    public function talk() {
        return 'Oink';
    }
}

$d1 = new Dog();
$d2 = new Dog();
$p1 = new Pig();
$p2 = new Pig();

// Setting (Attaching)
$storage->attach($d1);
$storage->attach($d2);
$storage->attach($p1);
$storage->attach($p2);

echo NEWLINE;
print_r($storage->contains($d1));
echo NEWLINE;
print_r($storage->contains($p1));

$storage->detach($d2);

echo NEWLINE;
print_r($storage->contains($d1));
echo NEWLINE;
print_r($storage->contains($p1));


echo NEWLINE;

// Setting As a Map (must be attached)
$storage[$d1] = "Hey";
print_r($storage[$d1]);
echo NEWLINE;
$storage->offsetSet($p1, "offsetSet");
print_r($storage[$p1]);

echo NEWLINE;

// Getting
print_r($storage->offsetGet($d1));
echo NEWLINE;
print_r($storage[$d1]);
echo NEWLINE;

// Offset Unset
$storage->offsetUnset($d1);
try {
    var_dump($storage[$d1]);
} catch (\UnexpectedValueException $e) {
    echo "Item removed successfully.";
}

echo NEWLINE;