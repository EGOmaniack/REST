<?php

class Flow {
    public $flowName;
    public $stateName;

    public function __construct($flowName, $stateName = 'default'){
        $this->flowName = $flowName;
        $this->stateName = $stateName;
    }

    /**
     * @return string
     */
    public function getFlowName()
    {
        return $this->flowName;
    }

    /**
     * @param string $flowName
     */
    public function setFlowName(string $flowName)
    {
        $this->flowName = $flowName;
    }

    /**
     * @return string
     */
    public function getStateName()
    {
        return $this->stateName;
    }

    /**
     * @param string $stateName
     */
    public function setStateName(string $stateName)
    {
        $this->stateName = $stateName;
    }

}