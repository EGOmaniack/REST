<?php

class SessionWork {

    private $user;
    private $currentWorkflow;

    public function getAccessLvl() {
        return 'guest';
    }

    public function pushWorkflowState(Flow $newFlow) {

        $workflowsCount = count($this->currentWorkflow);

        if($this->currentWorkflow[$workflowsCount-1]->getFlowName() != $newFlow->getFlowName()) {
            $this->currentWorkflow[] = $newFlow;
            $_SESSION['workflow'] = serialize($this->currentWorkflow);
        }
    }

    /**
     * @param Flow $flow
     */
    public function upDateWorkflowState(Flow $flow) {
        $workflowsCount = count($this->currentWorkflow);
        if($this->currentWorkflow[$workflowsCount-1]->getFlowName() == $flow->getFlowName()) {
            $this->currentWorkflow[$workflowsCount-1]->getStateName($flow->getStateName());
        } else {
            $this->resetWorkflowState();
        }
    }
    public function popWorkflowState() {
        $workflowsCount = count($this->currentWorkflow);
        if($workflowsCount > 1) {
            unset($this->currentWorkflow[$workflowsCount-1]);
            $_SESSION['workflow'] = serialize($this->currentWorkflow);
        } else {
            $this->resetWorkflowState();
        }
    }
    public function getCurrentWorkflow() {
        $workflowsCount = count($this->currentWorkflow);
        return $this->currentWorkflow[$workflowsCount-1];
    }

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
    }

    private function resetWorkflowState() {
        $this->currentWorkflow = array(new Flow("StartPage", "Cards"));
        $_SESSION['workflow'] = serialize($this->currentWorkflow);
    }

    public function rollBack() {
        // убрали предыдущий flow из стека
        $this->popWorkflowState();
        // запускаем предыдущий стэйт
        $newFlowName = $this->getCurrentWorkflow();
        include '../../v1/changeFlow/index.php';
        changeFlow($newFlowName->getFlowName());
    }

}