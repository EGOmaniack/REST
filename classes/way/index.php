<?php

class Way {
    public $wayName;
    public $flowName;
    public $stateName;

    public function __construct($wayName, $flowName, $stateName){
        $this->wayName = $wayName;
        $this->flowName = $flowName;
        $this->stateName = $stateName;
    }
}

class GetWayAnswer
{
    public $way;
    public $initData;

    public function __construct(Way $Way, $initData) {
        $this->way = $Way;
        $this->initData = $initData;
    }
}