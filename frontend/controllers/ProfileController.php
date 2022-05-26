<?php

namespace frontend\controllers;

use backend\models\UserProfile;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
                ],
        ];
    }

    public function actionView()
    {
        $model = Yii::$app->user->identity;

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionEdit()
    {
        $model = Yii::$app->user->identity;
        $profile = $model->profile ? UserProfile::find()->where(['user_id' => $model->id])->one() : new UserProfile();
        $profile->setScenario('update');

        if ($model->load($this->request->post()) && $model->save() && $profile->load($this->request->post())) {
            $profile->user_id = $model->id;
            $profile->birthday = strtotime($profile->birthday);
            if ($profile->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('edit', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }

}