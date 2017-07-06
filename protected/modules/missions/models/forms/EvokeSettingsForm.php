<?php

namespace app\modules\missions\models\forms;

use Yii;

class EvokeSettingsForm extends \yii\base\Model
{

    public $enabled_evokations;
    public $enabled_evokation_page_visibility;
    public $enabled_intro_slide;
    public $enabled_intro_video;
    public $enabled_psychometric_questionnaire_obligation;
    public $enabled_novel_read_obligation;
    public $investment_limit;
    public $novel_order;
    const FIRST_NOVEL = 0;
    const FIRST_QUESTIONNAIRE = 1;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array(['enabled_evokations'], 'in', 'range' => array(0, 1)),
            array(['enabled_evokation_page_visibility'], 'in', 'range' => array(0, 1)),
            array(['enabled_intro_slide'], 'in', 'range' => array(0, 1)),
            array(['enabled_intro_video'], 'in', 'range' => array(0, 1)),
            array(['enabled_psychometric_questionnaire_obligation'], 'in', 'range' => array(0, 1)),
            array(['enabled_novel_read_obligation'], 'in', 'range' => array(0, 1)),
            array(['investment_limit'], 'number', 'integerOnly' => true),
            array(['novel_order'], 'in', 'range' => array(0, 1)),
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
            'enabled_intro_slide' => Yii::t('MissionsModule.base', 'Activate Introduction Slide'),
            'enabled_intro_video' => Yii::t('MissionsModule.base', 'Activate Introduction Video'),
            'enabled_psychometric_questionnaire_obligation' => Yii::t('MissionsModule.base', 'Obligate users to answer psychometric questionnaire'),
            'enabled_novel_read_obligation' => Yii::t('MissionsModule.base', 'Obligate users to read the Novel'),
            'investment_limit' => Yii::t('MissionsModule.base', 'Set Investment Limit'),
            'novel_order' => Yii::t('MissionsModule.base', 'Answer Psychometric Questionnaire before reading the Novel'),
        );
    }
}
