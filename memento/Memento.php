<?php
/**
 * Momento
 *
 * @desc
 *     Memento holds the state of another object.
 *     Memento is the Caretaker of the Originating class.
 *
 * @usage
 *     You want an object to have undo functionality.
 *
 * @example
 *     We will create a Task List.
 *
 */
require_once '../constants.php'; // For NEWLINE output

class Memento
{
    private $task;
    private $details;

    public function __construct($task, $details) {
        $this->task = $task;
        $this->details = $details;
    }

    public function setTask($task) {
        $this->task = $task;
    }

    public function setDetails($details) {
        $this->details = $details;
    }

    public function getTask() {
        return $this->task;
    }

    public function getDetails() {
        return $this->details;
    }
}

class Task
{
    private $task;
    private $details;

    public function __construct(Memento $memento) {
        $this->setTask($memento);
        $this->setdetails($memento);
    }

    public function setTask(Memento $momento) {
        $this->task = $memento->getTask();
    }

    public function setDetails(Memento $momento) {
        $this->details = $memento->getDetails();
    }

    public function getTask(Memento $momento) {
        $memento->setDetails($this->task);
    }

    public function getDetails(Memento $momento) {
        $memento->setDetails($this->details);
    }

}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$todo = 'Create Bucket List';
$description = 'I want to make a bucket list for adventures.';

$memento = new Momento($todo, $description);
$task = new Task($momento);

$memento->setTask("Practice Basketball");
$memento->setTask("I need to do a lot of layups");

echo $memento->getTask();
echo NEWLINE;
echo $memento->getDescription();
echo NEWLINE;
