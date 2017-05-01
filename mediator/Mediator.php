<?php
/**
 * Mediator
 *
 * @desc
 *     The Mediator pattern is extremely popular in symfony as an event dispatcher.
 *         The mediator is the "man in the middle" to first store various objects,
 *         then handles those objects based on another class.
 *
 *         @more
 *         Only Read this if you went through the Observer pattern.
 *
 *         1: This is not the same as the Observer Pattern. The Observer is a
 *         one-to-many dependency, such as a "Subscriber" Object that listens to
 *         ten "Observerable" classes. It's triggered automatically when the
 *         "Observable" changes it's "state".
 *
 *         2: The Mediator encapsulates how a group of objects interact, yet these
 *         classes do not reference eachother because it's made to be loosely coupled.
 *         With a mediator, you could have a page that needs a special permission to access;
 *         The Permission Class knows nothing about the Controller Class for the Page.
 *         However, the mediator knows about them, so we ask the Mediator if the Controller
 *         has Permission there. (Perhaps that's a poor, pretend example)
 *
 *         3: Both Patterns are good for their own use caae.
 *
 * @usage
 *     You want set of single entry point Object to fire off methods in various
 *         classes one or many at a time.
 *     You don't want messy code with clustered classes.
 *     You want to trigger events.
 *     You want to see if you have a permission to do something.
 *
 * @example
 *     In reality you might have these classes:
 *         - Mediator         - You might call this "DataHandler".
 *         - Formatter(s)     - I'll use two classes for an example.
 */
require_once '../constants.php'; // For NEWLINE output

class Mediator
{
    // Holds Formatter Objects
    protected $formatters = [];

    // Allow new instances to be added to a collection
    public function addFormatter($formatter) {
        $this->formatters[] = $formatter;
    }

    // Run all the formatters on the $data
    public function processData($data) {
        foreach ($this->formatters as $format) {
            $data = $format->run($data);
        }
        return $data;
    }
}

class FormatLowercase
{
    public function run($value) {
        return strtolower($value);
    }
}

class FormatRemoveWhitespace
{
    public function run($value) {
        return preg_replace('/\s/', '', $value);
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$mediator = new Mediator();
$mediator->addFormatter(new FormatLowercase());
$mediator->addFormatter(new FormatRemoveWhitespace());

echo $mediator->processData('This Should Be Lowercase with ZERO Spaces!');

echo NEWLINE;

echo $mediator->processData('ANOTHER TRY ALL LOWERCASE');

echo NEWLINE;

// --------------------------------------------------------
// Extra Tip
// --------------------------------------------------------
//
// In a concrete example you could do this to make it secure:
//
//  1: Create an "Interface Formatter"
//
//  2: The arguement below would appear as: "Formatter $formatter"
//
//  3: Lastly, your Formatter Classes would be:
//      "class FormatterLowercase implement Formatter"
