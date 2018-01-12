<?php

class Flow {
    public $flowName;
    public $stateName;

    public function __construct($flowName, $stateName){
        $this->flowName = $flowName;
        $this->stateName = $stateName;
    }

    /**
     * @return mixed
     */
    public function getFlowName()
    {
        return $this->flowName;
    }

    /**
     * @param mixed $flowName
     */
    public function setFlowName($flowName)
    {
        $this->flowName = $flowName;
    }

    /**
     * @return mixed
     */
    public function getStateName()
    {
        return $this->stateName;
    }

    /**
     * @param mixed $stateName
     */
    public function setStateName($stateName)
    {
        $this->stateName = $stateName;
    }
}