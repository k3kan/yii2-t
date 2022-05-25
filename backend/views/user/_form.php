<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $profile \backend\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($profile, 'surname')->textInput() ?>

    <?= $form->field($profile, 'name')->textInput() ?>

    <?= $form->field($profile, 'patronymic')->textInput() ?>

    <?= $profile->getThumbUploadUrl('avatar') ? Html::img(Yii::$app->FrontManager->createAbsoluteUrl($profile->getThumbUploadUrl('avatar'))) : null ?>

    <?= $form->field($profile, 'avatar')->fileInput() ?>

    <?php echo '<label class="form-label">Укажите день рождение</label>'; ?>
    <?php echo DatePicker::widget([
        'model' => $profile,
        'attribute' => 'birthday',
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'bsVersion' => '5.x',
        'options' => ['placeholder' => 'Укажите день рождение ...', 'value' => $profile->birthday ? date('m/d/y', $profile->birthday) : null],
        'pluginOptions' => [
            'orientation' => 'top right',
            'format' => 'mm/dd/yyyy',
            'autoclose' => true,
        ]
    ]); ?>

    <?= $form->field($profile, 'about')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
