<?php
/**
 * Multi Inheritance
 *
 * @desc
 *     In some languages you can extend multiple classes, for example python:
 *         class User(Address, Profile):
 *
 *     In PHP we accomplish this with Traits, they are very convenient.
 *     These were introduced in 5.4.
 *
 * @usage
 *
 *     Give any class re-usable functionality by typing it once.
 *
 * @example
 *     We will have a User class that extends a fake Model
 *     We want the User to inherit features from: Profile, TimeInfo
 *     We will use Traits
 *
 */
require_once '../constants.php'; // For NEWLINE output

// --------------------------------------------------------
// One way of doing this is by faking it
//      Note: This isn't considered bad, it's a pattern that
//            actually separates dependencies and can be used
//            for many things other than this.
// --------------------------------------------------------

class BasicModel {};    // Our main item to Extend
class BasicProfile {};  // A utility class
class BasicTimeInfo {}; // A utility class

// You'd do something like this
class BasicUser extends BasicModel {
    public function __construct() {
        $this->profile = new BasicProfile();
        $this->dateTime = new BasicTimeInfo();
    }
}


// --------------------------------------------------------
// A Better way to do it, use Traits (They are Classes)
// --------------------------------------------------------
class Model {
    public $info = 'I something important, I think.';
};

trait Profile {
    public function calculateAge($birthday) {
        // I'm not doing logic :)
        return 90;
    }
}

trait TimeInfo {
    public function getUTC() {
        // Not doing logic :)
        return time();
    }
}

class User extends Model {
    use Profile;
    use TimeInfo;

    public function hello() {
        return 'hello';
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------

$user = new User;

$a = $user->hello();
echo "From the user Class: $a" . NEWLINE;

$b = $user->info;
echo "From the model Class: $b" . NEWLINE;

$c = $user->calculateAge('10-25-84');
echo "From the Profile Trait: $c" . NEWLINE;

$d = $user->getUTC();
echo "From the TimeInfo Trait: $b" . NEWLINE;

echo NEWLINE;
