<?php
/**
 * Observer
 *
 * @desc
 *     The Observer pattern has two classes minimum: Subject and Observer(s).
 *         Observers listen for notifications.
 *         Subjects notify the Observer.
 *
 *     You can have many observers attached to one Subject.
 *
 * @usage
 *     You want to know what happens in your framework everywhere.
 *     You want to know what happens in any object.
 *     You want to log anything from anywhere.
 *
 * @example
 *     In reality you might have these classes:
 *         - MessageObserver
 *         - RouteObserver
 *         - Subject
 */
require_once '../constants.php'; // For NEWLINE output

class Observer
{
    public function update($subject) {
        // Handle what to do when an object changes
        printf("State Change, new subject: %s", $subject);
    }
}

class Subject
{
    // Array of all listening observers (aka subscribers)
    private $observers = [];

    // You could call this: listen, register, etc
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    // You call call this: unlisten, remove, et
    public function detach(Observer $observer) {
        foreach ($this->observers as $key => $obs) {
            if ($observer == $obs) {
                unset($this->observers[$key]);
                break;
            }
        }
    }

    // You could call this: update, push, etc
    public function notify() {
        // Updates all classes subscribed to this object
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    // Example of notifying the observer state change
    public function updateName($name) {
        $this->name = $name;

        // This triggers all attached observers
        $this->notify();
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$subject  = new Subject();
$observer = new Observer();
$subject->attach($observer);

// Notificies the Observer(s)
$subject->updateName('Jesse');  // Outputs Event
$subject->updateName('Joseph'); // Outputs Event
