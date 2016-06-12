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
 *     This is a STANDARD (NON STATIC) way of doing it.
 *
 */
require_once '../constants.php'; // For NEWLINE output

// Fake Class(es) for Example
require_once 'FakeEmail.php';

class DependencyInjection
{
    protected $services = [];

    public function __construct() {
        // See: http://php.net/manual/pl/class.splobjectstorage.php
    }

    /**
     * Register a service and store it in this container
     *
     * @param  str $name  Our identifier to get our service
     * @param  array  $values  [description]
     *
     * @return void
     */
    public function register($name, callable $callable)
    {
        $this->services[$name] = $callable;
    }

    /**
     * See if a service is set
     *
     * @param  str $name
     *
     * @return bool
     */
    public function exists($name)
    {
        if (array_key_exists($name, $this->services)) {
            return true;
        }
        return false;
    }

    /**
     * Return One or All services
     *
     * @param  boolean|string $name Optional for specific service
     *
     * @return mixed  Whatever you define
     */
    public function get($name)
    {
        if ($this->exists($name)) {
            return $this->services[$name]();
        }
        throw new \Exception("
            The service: $name is not in the Dependency Injector
        ");
    }

    /**
     * Magic Method for shorthand
     *     eg: $di->email = function() { ... };
     *
     * @param string   $name
     * @param callable $callable
     */
    public function __set($name, callable $callable) {
        $this->register($name, $callable);
    }

    /**
     * Magic method for shorthand
     *     eg: $di->email;
     *
     * @param string   $name
     */
    public function __get($name) {
        return $this->get($name);
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
$DI = new \DependencyInjection();

// Simple
$DI->register('foo', function() {
    return 'foo'; // NEVER FOREGET to return!
});

// Using a Config
$DI->register('email', function() use ($config) {
    $email = new \EmailService();
    $email->setOptions($config['email']);
    return $email; // NEVER FOREGET to return!
});

// Custom Inside Class
$DI->register('formatter', function() {
    // You can even build a class within and use it,
    // though I wouldn't personally recommend it.

    $f = new \stdClass();

    // call_user_func($varname->lc, 'uppercase me.');
    $f->lc = function($str) {
        return strtolower($str);
    };

    // call_user_func($varname->lc, 'uppercase me.');
    $f->uc = function($str) {
        return strtoupper($str);
    };

    // call_user_func_array($varname->add, [5, 5]);
    $f->add = function($a, $b) {
        if ( ! is_int($a) || ! is_int($b) ) {
            throw new \InvalidArgumentException('$a and $b must both be integers');
        }
        return $a + $b;
    };

    return $f; // NEVER FOREGET to return!

});

// Get the DI Objects
// This would be called from somewhere in your application,
//      wherever you pass it to.
$foo      = $DI->get('foo');
$email    = $DI->get('email');
$formatter= $DI->get('formatter');

echo $foo;
echo NEWLINE;

echo $email->send();
echo NEWLINE;

echo call_user_func($formatter->lc, 'LOWERCASE ME.');
echo NEWLINE;
echo call_user_func($formatter->lc, 'uppercase me.');
echo NEWLINE;
echo call_user_func_array($formatter->add, [5, 5]);
echo NEWLINE;

