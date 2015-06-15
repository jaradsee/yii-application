<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Anc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_SERV')->textInput() ?>

    <?= $form->field($model, 'GRAVIDA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANCNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANCRESULT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANCPLACE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROVIDER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'D_UPDATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
