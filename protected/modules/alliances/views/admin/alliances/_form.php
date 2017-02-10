<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->field($model, 'team_1')->dropdownList(ArrayHelper::map($teams, 'id', 'name')); ?>
    <?php echo $form->field($model, 'team_2')->dropdownList(ArrayHelper::map($teams, 'id', 'name')); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MarketplaceModule.base', 'Create') : Yii::t('MarketplaceModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>

  $(document).on('ready', function(){

    var $team_1_select = $('#alliance-team_1'),
        $team_2_select = $('#alliance-team_2');

    $team_1_select.on('change', function(e){
      $team_2_select.find('option:disabled').prop('disabled', false);

      $team_2_select.find('option[value*=' + $team_1_select.val() + ']').prop('disabled', true);
    });

    $team_2_select.on('change', function(e){
      $team_1_select.find('option:disabled').prop('disabled', false);

      $team_1_select.find('option[value*=' + $team_2_select.val() + ']').prop('disabled', true);
    });


  });

</script>
