<?php
/**
 * Dependency Injection (DI) ak Inversion of Control (IoC)
 *
 * @desc
 *     A container that stores your dependencies to re-use and
 *     gather easier.
 *     There are two main components, Injector and Services:
 *          Injector is the main class that holds all the Services.
 *          Services are any object stored inside the injector.
 *
 *     You ALWAYS want to return something from the DI register method on the
 *     client side.
 *
 * @usage
 *     Save time from reconstructing classes
 *     Stay organized in a central place
 *
 * @example
 *     There are many ways to do this, some can be overly complicated.
 *     This example will be one way of doing it very simple.
 *
 *     Many Ways:
 *         You could make it use Static Class so its accessible everywhere
 *             (This should then be a Singleton also).
 *         You could make the class, and make a static wrapper
 *         You could make it a variable assigned to a class
 *         Just avoid global variables.
 *
 *     We will create a DI pattern and make fake services.
 *     Your services could be anything, and it's wiser in PHP
 *     to use Composer packages already written and inject them
 *     into the DI, such as Illuminate (DB) and SwiftMailer (Email).
 *
 *     This is a STATIC way of doing it.
 *
 */
use DependencyInjectionStatic as DI; // I would call the actual class this probably.

require_once '../constants.php'; // For NEWLINE output

// Fake Class(es) for Example
require_once 'FakeEmail.php';

class DependencyInjectionStatic
{
    protected static $services = [];

    /**
     * Register a service and store it in this container
     *
     * @param  str $name  Our identifier to get our service
     * @param  array  $values  [description]
     *
     * @return void
     */
    public static function register($name, callable $callable)
    {
        self::$services[$name] = $callable;
    }

    /**
     * Return One or All services
     *
     * @param  boolean|string $name Optional for specific service
     *
     * @return mixed  Whatever you define
     */
    public static function get($name)
    {
        if (self::exists($name)) {
            $closure = self::$services[$name];
            return $closure();
        }
        throw new \Exception("
            The service: $name is not in the Dependency Injector
        ");
    }

    /**
     * See if a service is set
     *
     * @param  str $name
     *
     * @return bool
     */
    public static function exists($name)
    {
        if (array_key_exists($name, self::$services)) {
            return true;
        }
        return false;
    }
}

// --------------------------------------------------------
// Fake Config for Example (Not part of the pattern)
// --------------------------------------------------------
$config = [
    'email' => [
        'smtp' => 'smtp.gmail.com',
        'port' => 587,
        'tls'  => true,
        'user' => 'email@gmail.com',
        'pass' => '',
    ]
];

// --------------------------------------------------------
// Example
// --------------------------------------------------------
// Simple
DependencyInjectionStatic::register('foo', function() {
    return 'foo'; // NEVER FOREGET to return!
});

DI::register('email', function() use ($config) {
    $email = new \EmailService();
    $email->setOptions($config['email']);
    return $email; // NEVER FOREGET to return!
});

$foo = DI::get('foo');
$email = DI::get('email');
echo $foo;
echo NEWLINE;
echo $email->send();
echo NEWLINE;