<?php

class RubberField {
    public $fieldType; //textInput | pass | checkbox ...
    public $fieldName;
    public $value;
    public $required;

    public function __construct($fieldName, $value = '', $required = false, $fieldType = 'textInput') {
        $this->fieldType = $fieldType;
        $this->fieldName = $fieldName;
        $this->value = $value;
        $this->required = $required;
    }
}

class Form {
    public $steps;
    public $formTitle;
    public $formSubTitle;
    private $rubberFields;
    public $validationFuncName;
    public $buttonLabel;
    public $currentStep;
    public $errorMessage;

    public $currentStepFields;

    public function __construct($steps, $formTitle, $formSubtitle, $buttonLabel, $validationFuncName, $errorMessage){
        $this->steps = $steps;
        $this->formTitle = $formTitle;
        $this->formSubTitle = $formSubtitle;
        $this->buttonLabel = $buttonLabel;
        $this->validationFuncName = $validationFuncName;
        $this->currentStep = 1;
        $this->rubberFields = array();
        $this->errorMessage = $errorMessage;
    }
    public function setCurrentStep(int $i) {
        $this->currentStep = $i;
    }
    public function addField(RubberField $field, int $step = 1) {
        $this->rubberFields[$step][] = $field;
    }

    public function updateStep(int $step) {
        $this->currentStepFields = $this->rubberFields[$step];
    }

    /**
     * @return array
     */
    public function getRubberFields(): array
    {
        return $this->rubberFields;
    }

    /**
     * @param array $rubberFields
     */
    public function setRubberFields(array $rubberFields)
    {
        $this->rubberFields = $rubberFields;
    }
}