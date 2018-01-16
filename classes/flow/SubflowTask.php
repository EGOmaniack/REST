<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 015 15.01.18
 * Time: 8:34
 */
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

class SubflowTask {
    public $toEditForm;

    public function __construct(Form $taskForm) {
        $this->toEditForm = $taskForm;
    }

    /**
     * @param int $step
     * @return Form
     */
    public function getToEditForm(int $step): Form
    {
        $this->toEditForm->updateStep($step);
        return $this->toEditForm;
    }

    /**
     * @param $data
     */
    public function update($data) {
        $fieldsArray = $this->toEditForm->getRubberFields();
        $currentStep = $this->toEditForm->currentStep;

        foreach ($fieldsArray[$currentStep] as $field) {
            foreach ($data as $dataField) {
                if ($field->fieldName == $dataField->fieldName) {
                    $field->value = $dataField->value;
                }
            }
        }
//        var_dump($this->toEditForm); exit;

    }

    public function addStep(): bool {
        $this->toEditForm->currentStep++;
        $havMoreSteps = true;
        if($this->toEditForm->currentStep > $this->toEditForm->steps) {
            $havMoreSteps = false;
        }
        return $havMoreSteps;

    }

    public function getForm()
    {
        return $this->toEditForm;
    }

}