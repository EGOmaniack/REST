<?php

class RubberField {
    public $fieldType; //textInput | pass | checkbox ...
    public $fieldLabel;
    public $fieldName;
    public $value;
    public $required;

    public function __construct($fieldName, $fieldLabel, $value = '', $required = false, $fieldType = 'textInput') {
        $this->fieldType = $fieldType;
        $this->fieldLabel = $fieldLabel;
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

    public $currentStepFields;

    public function __construct($steps, $formTitle, $formSubtitle, $buttonLabel, $validationFuncName){
        $this->steps = $steps;
        $this->formTitle = $formTitle;
        $this->formSubTitle = $formSubtitle;
        $this->buttonLabel = $buttonLabel;
        $this->validationFuncName = $validationFuncName;
        $this->currentStep = 1;
        $this->rubberFields = array();
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