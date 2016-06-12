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
 *     There are many ways to do this, some can be overly complicated.
 *     This example will be one way of doing it very simple.
 *
 * @usage
 *     Save time from reconstructing classes
 *     Stay organized in a central place
 *
 * @example
 *     We will create a DI pattern and make two fake services.
 *     Your services could be anything, and it's smarter in PHP
 *     to use Composer packages already written and inject them
 *     into the DI, such as Illuminate (DB) and SwiftMailer (Email).
 *
 *     Yet for these examples I will use two fake classes.
 *
 */
class DependencyInjection
{

}
// --------------------------------------------------------
// Fake Class(es) for Example
// --------------------------------------------------------
class DatabaseService
{
    public function __construct() {
        return 'Database';
    }

}

class EmailService
{
    public function __construct() {
        return 'Email Service';
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
