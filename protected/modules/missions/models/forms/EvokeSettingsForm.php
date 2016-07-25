<?php

namespace app\modules\missions\models\forms;

use Yii;

class EvokeSettingsForm extends \yii\base\Model
{

    public $enabled_evokations;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array(['enabled_evokations'], 'in', 'range' => array(0, 1))
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
            'enabled_evokations' => Yii::t('MissionsModule.base', 'Enable Evokations'),
        );
    }
}
