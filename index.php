<?php

include('classes/index.php');

header("Access-Control-Allow-Origin: *");

class RestAPI {
    public $rout;
    private $settings;
    private $answer;

    function __construct ($thisrout){
        $this->rout = $thisrout;
        $this->settings = new Settings();
    }

    public function makeAnsver () {
        switch ($this->rout) {
            case 'cardsv1':
                $cards = new Cards($this->settings);
                $this->answer = $cards -> getCards();
                break;
            
            default:
                $this->answer = "ERROR: There is no such rout - {$this->rout}";
                break;
        }
    }
    public function giveAnsver() {
        echo $this->answer;
    }
}

?>
