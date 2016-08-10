<?php

namespace app\modules\missions\models\forms;

use Yii;

class EvokeSettingsForm extends \yii\base\Model
{

    public $enabled_evokations;
    public $enabled_evokation_page_visibility;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array(['enabled_evokations'], 'in', 'range' => array(0, 1)),
            array(['enabled_evokation_page_visibility'], 'in', 'range' => array(0, 1))
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'enabled_evokations' => Yii::t('MissionsModule.base', 'Allow Evokation Submissions'),
            'enabled_evokation_page_visibility' => Yii::t('MissionsModule.base', 'Show Evokation Page on Team Page'),
        );
    }
}
