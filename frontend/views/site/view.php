<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?= Html::a(Yii::t('app', 'Назад'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'profile.name',
            'profile.surname',
            'profile.patronymic',
            'profile.birthday:date',
            'profile.about',
            [
                'attribute' => 'Аватар',
                'format' => 'raw',
                'value' => function (User $model) {
                    if (!$model->profile) {
                        return null;
                    }
                    $alias = Yii::$app->request->baseUrl . $model->profile->getThumbUploadUrl('avatar');
                    return Html::img($alias);
                }
            ],
        ],
    ]) ?>

</div>
