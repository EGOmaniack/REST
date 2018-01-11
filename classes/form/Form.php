<?php

class RubberField {
    public $fieldType; //textInput | checkbox ...
    public $fieldLabel;
    public $fieldName;
    public $value;

    public function __construct($fieldName, $fieldLabel, $fieldType = 'textInput', $value = '') {
        $this->fieldType = $fieldType;
        $this->fieldLabel = $fieldLabel;
        $this->fieldName = $fieldName;
        $this->value = $value;
    }
}

class Form {
    public $steps;
    public $formTitle;
    public $formSubTitle;
    public $rubberFields;
    public $validationFuncName;
    public $buttonLabel;
    public $currentStep;

    public function __construct($steps, $formTitle, $formSubtitle, $buttonLabel, $validationFuncName){
        $this->steps = $steps;
        $this->formTitle = $formTitle;
        $this->formSubTitle = $formSubtitle;
        $this->buttonLabel = $buttonLabel;
        $this->validationFuncName = $validationFuncName;
        $this->currentStep = 0;
        $this->rubberFields = array();
    }
    public function setCurrentStep(int $i) {
        $this->currentStep = $i;
    }
    public function addField(RubberField $field) {
        $this->rubberFields[] = $field;
    }
}