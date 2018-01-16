<?php

class SessionWork {

    private $user;
    private $currentWorkflow;
    private $subFlowTask;
    private $subflow;

    public function __construct () {
        if(isset($_SESSION['user']) && isset($_SESSION['workflow'])) {
//            echo json_encode($_SESSION); exit;
            $this->user = unserialize($_SESSION['user']);
            $this->currentWorkflow = unserialize($_SESSION['workflow']);
        } else {
            $this->user = new User();
            $_SESSION['user'] = serialize($this->user);
            $this->resetWorkflowState();
        }
        if(isset($_SESSION['subflowtask']) && isset($_SESSION['subflow'])) {
            $this->subFlowTask = unserialize($_SESSION['subflowtask']);
            $this->subflow = unserialize($_SESSION['subflow']);
        }
    }

    public function getAccessLvl() {
        return 'guest';
    }
    public function updateUser(string $comandName, $params) {
        if($comandName == 'fullUpdate') {
            $this->user = $params;
            $_SESSION['user'] = serialize($this->user);
        }
    }
    public function pushWorkflowState(Flow $newFlow) {

        $workflowsCount = count($this->currentWorkflow);

        if($this->currentWorkflow[$workflowsCount-1]->getFlowName() != $newFlow->getFlowName()) {
            $this->currentWorkflow[] = $newFlow;
            $_SESSION['workflow'] = serialize($this->currentWorkflow);
        } else {
            $this->upDateWorkflowState($newFlow);
        }
    }

    /**
     * @param Flow $flow
     */
    public function upDateWorkflowState(Flow $flow)
    {
        $workflowsCount = count($this->currentWorkflow);
        if($this->currentWorkflow[$workflowsCount-1]->getFlowName() == $flow->getFlowName())
        {
            $this->currentWorkflow[$workflowsCount-1]->getStateName($flow->getStateName());
        } else {
            $this->resetWorkflowState();
        }
    }

    public function popWorkflowState()
    {
        $workflowsCount = count($this->currentWorkflow);
        if($workflowsCount > 1)
        {
            unset($this->currentWorkflow[$workflowsCount-1]);
            $_SESSION['workflow'] = serialize($this->currentWorkflow);
        } else {
            $this->resetWorkflowState();
        }
    }

    public function getCurrentWorkflow(): Flow
    {
        $workflowsCount = count($this->currentWorkflow);
        return $this->currentWorkflow[$workflowsCount-1];
    }

    private function resetWorkflowState()
    {
        $this->currentWorkflow = array(new Flow("StartPage", "Cards"));
        $_SESSION['workflow'] = serialize($this->currentWorkflow);
    }

    public function rollBack()
    {
        // убрали предыдущий flow из стека
        $this->popWorkflowState();
        // запускаем предыдущий стэйт
        $newFlowName = $this->getCurrentWorkflow();
        include_once '../../v1/changeFlow/index.php';
        changeFlow($newFlowName->getFlowName());
    }

    public function newSubFlowTask(SubFlowTask $subFlTask)
    {
        $this->subFlowTask['task'] = $subFlTask;
        $this->subFlowTask['done'] = false;

        $_SESSION['subflowtask'] = serialize($this->subFlowTask);
    }

    public function startSubFlow(Flow $subFlow, Flow $target)
    {
        $this->subflow['flow'] = $subFlow;
        $this->subflow['target'] = $target;
        $_SESSION['subflow'] = serialize($this->subflow);
        include_once '../../v1/changeFlow/index.php';
        changeFlow($this->subflow['flow']->getFlowName());
    }

    /**
     * @return bool
     */
    public function hasSubFlowTask(): bool
    {
        $hasSubTask = false;

        if (isset($this->subFlowTask) && !$this->subFlowTask['done'])
        {
            $hasSubTask = true;
        }

        return $hasSubTask;
    }

    /**
     * @return SubFlowTask
     */
    public function getSubFlowTask(): SubFlowTask {
//        var_dump($this->subFlowTask); exit;

        return $this->subFlowTask['task'];
    }

    public function getFlowSubFlowName(): string {
        $flowName = $this->getCurrentWorkflow()->getFlowName();

        if(isset($this->subFlowTask) && !$this->subFlowTask['done']) {
            $flowName = $this->subflow['flow']->getFlowName();
        }
        return $flowName;
    }

    /**
     * @return string
     */
    public function getSubFlowTargetName(): string
    {
        string: $result = '';
        if(isset($this->subflow)) {
            $result = $this->subflow['target']->getFlowName();
        }
        return $result;
    }

    public function isSubFlowTaskDone(): bool {
        bool: $result = false;
        if(isset($this->subFlowTask['done'])) {
            $result = $this->subFlowTask['done'];
        }
        return $result;
    }

    public function setTaskDone()
    {
        if (isset($this->subFlowTask))
        {
            $this->subFlowTask['done'] = true;
            $_SESSION['subflowtask'] = serialize($this->subFlowTask);
//            var_dump($this->subFlowTask);exit;
            include_once '../../v1/changeFlow/index.php';
            changeFlow($this->subflow['target']->getFlowName());
        }
    }

    public function setUserRegSended()
    {
        $this->user->setRegSended();
        $_SESSION['user'] = serialize($this->user);
    }

    public function freeSubflow()
    {
        unset($this->subflow);
        unset($this->subFlowTask);
        unset($_SESSION['subflowtask']);
        unset($_SESSION['subflow']);
    }

    public function SubFlowTaskAddStep(): bool
    {
        $added = $this->getSubFlowTask()->addStep();
        $_SESSION['subflowtask'] = serialize($this->subFlowTask);
        return $added;
    }

}