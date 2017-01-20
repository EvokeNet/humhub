<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Missions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="missions-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'id_code')->textarea(['rows' => 1]) ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'id' => 'description-field']) ?>

    <?php // $form->field($model, 'description')->textarea(['rows' => 0, 'id' => 'description-field', 'style' => 'visibility:hidden; margin-top: -70px']) ?>

    <!-- <div id="editor-container">
        <?php // isset($model->description) ? Html::encode($model->description) : '' ?>
    </div> -->

    <!-- <a href = "#"" id="custom-button">editor</a> -->

    <br />

    <?= $form->field($model, 'locked')->dropDownList(['0' => 'Unlocked', '1' => 'Locked'], ['prompt' => 'Select Option']) ?>
    
    <?= $form->field($model, 'position')->textarea(['rows' => 1]) ?>
                 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MissionsModule.base', 'Create') : Yii::t('MissionsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'primary-submit-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];


var quill = new Quill('#editor-container', {
  modules: {
    toolbar: toolbarOptions
  },
  placeholder: 'Compose an epic...',
  theme: 'snow'
});

var customButton = document.querySelector('#primary-submit-button');
customButton.addEventListener('click', function() {
    var value = JSON.stringify(quill.getContents());
    var one = JSON.parse(value)
    console.log(value);
    console.log(one.ops[0].insert);

    var description = document.getElementById('description-field');
    description.value = one.ops[0].insert;
});

// var form = document.querySelector('form');
// form.onsubmit = function(){
//     var value = JSON.stringify(quill.getContents());
//     var one = JSON.parse(value)
//     console.log(value);
//     console.log(one.ops[0].insert);

//     var description = document.getElementById('description-field');
//     description.value = one.ops[0].insert;

// }
// form.onsubmit = function() {
//   // Populate hidden form on submit
//   var about = document.querySelector('input[name=Missions[description]]');
//   about.value = JSON.stringify(quill.getContents());
  
//   alert(quill.getContents());
//   console.log("Submitted", $(form).serialize(), $(form).serializeArray());
  
//   // No back end to actually submit to!
//   alert('Open the console to see the submit data!')
//   return false;
// };

</script>