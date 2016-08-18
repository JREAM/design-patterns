<?php
/**
 * Adapters
 *
 * @desc
 *     Classes that don't share the same methods can be interfaced
 *     and forced to behave the same without modifying the original class.
 *
 * @usage
 *     You want your payment gateways to all have the same methods
 *     You want a group of API's to share the same methods
 *
 * @example
 *     We create adapters for 3 payment gateways. Notice how they all
 *     have different payment methods. We want it all to be the same,
 *     otherwise it's easy to get confused.
 */
require_once '../constants.php'; // For NEWLINE output

interface Adapter
{
    // All Class Adapters share a common method
    public function pay($total);
}

// --------------------------------------------------------
// Fake Class(es) for Example
// --------------------------------------------------------


// Pretend this were the real PayPal API
class Paypal
{
    public function sendPayment($total) {
        return $total;
    }
}

// Pretend this were the real Stripe API
class Stripe
{
    public function payCustomer($total) {
        return $total;
    }
}

// Pretend this were the real Authorize.Net API
class AuthorizeNet
{
    public function createTransaction($total) {
        return $total;
    }
}

// --------------------------------------------------------
// Adapters
// --------------------------------------------------------
class PayPalAdapter implements Adapter {
    protected $paypal;

    public function __construct(PayPal $paypal) {
        $this->paypal = $paypal;
    }

    public function pay($total) {
        return $this->paypal->sendPayment($total);
    }
}

class StripeAdapter implements Adapter {
    protected $stripe;

    public function __construct(Stripe $stripe) {
        $this->stripe = $stripe;
    }

    public function pay($total) {
        return $this->stripe->payCustomer($total);
    }
}

class AuthorizeNetAdapter implements Adapter {
    protected $authorizenet;

    public function __construct(AuthorizeNet $authorizenet) {
        $this->authorizenet = $authorizenet;
    }

    public function pay($total) {
        return $this->authorizenet->createTransaction($total);
    }
}

// --------------------------------------------------------
// Example
// --------------------------------------------------------
$paypal = new PayPalAdapter(new PayPal());
echo $paypal->pay('50.00');
echo NEWLINE;

$stripe = new StripeAdapter(new Stripe());
echo $stripe->pay('5000');  # Stripe does cents, lol
echo NEWLINE;

$authorizenet = new AuthorizeNetAdapter(new AuthorizeNet());
echo $authorizenet->pay('50.00');
echo NEWLINE;
