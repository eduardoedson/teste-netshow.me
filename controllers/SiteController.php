<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\ContatoForm;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    /**
    * {@inheritdoc}
    */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        $model = new ContatoForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['contatoEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            
            if($model->validate()){
                $doc = UploadedFile::getInstance($model, 'file_dir');
                
                $path = 'uploads/';
                FileHelper::createDirectory($path);
                
                $path_final = $path.md5($doc->baseName) . '.' . $doc->extension;
                
                $doc->saveAs($path_final);
                $model->file_dir = $path_final;

                $model->ip = Yii::$app->request->userIP;

                $model->save();
                return $this->refresh();    
            }
        }
        return $this->render('contato', ['model' => $model]);
    }
}
