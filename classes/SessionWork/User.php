<?php

class User {

    private $autorized;
    private $regSended;

    public function __construct () {
        $this->autorized = false;
        $this->regSended = false;
    }

    public function setRegSended()
    {
        $this->regSended = true;
    }
}