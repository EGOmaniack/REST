<?php

class Flow {
    public $flowName;
    public $stateName;

    public function __construct($flowName, $stateName){
        $this->flowName = $flowName;
        $this->stateName = $stateName;
    }
}