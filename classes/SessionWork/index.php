<?php

class SessionWork {

    private $user;

    public function __construct () {
        if(isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        } else {
            $this->user = new User();

            $_SESSION['user'] = $this->user;
        }
    }

    public function getAccessLvl() {
        return 'guest';
    }
}