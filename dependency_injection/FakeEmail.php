<?php
class EmailService
{
    /** Class Vars */
    protected $smtp;
    protected $port;
    protected $user;
    protected $pass;
    protected $tls;
    protected $ssl;

    protected $required = [
        'smtp' => null,
        'port' => null,
        'user' => null,
        'pass' => null,
    ];

    public function __construct() {
        return 'Email Service';
    }

    /**
     * Sets class-wide options.
     */
    public function setOptions($data)
    {
        if (isset($data['smtp'])) {
            $this->smtp = (string) $data['smtp'];
        }

        if (isset($data['port'])) {
            $this->port = (int)    $data['port'];
        }

        if (isset($data['user'])) {
            $this->user = (string) $data['user'];
        }

        if (isset($data['pass'])) {
            $this->pass = (string) $data['pass'];
        }

        if (isset($data['tls'])) {
            $this->tls = $data['tls'];
        }

        if (isset($data['ssl'])) {
            $this->ssl = $data['ssl'];
        }

        if (isset($data['tls']) && isset($data['ssl'])) {
            throw new \InvalidArgumentException("
                You can only use one or the other: TLS or SSL
            ");
        }
    }

    /**
     * Sends an email, this is just pretend.
     */
    public function send() {
        return "Fake Email Send";
    }

}