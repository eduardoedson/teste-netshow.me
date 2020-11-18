<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Contato';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
      <div class="alert alert-success">
        Obrigado pelo contato.
      </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                    <?= $form->field($model, 'nome')->textInput(['autofocus' => true, 'maxlength' => 50]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>
                    <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99) 9 9999 - 9999']) ?>
                    <?= $form->field($model, 'mensagem')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'file_dir')->fileInput(['multiple' => false]) ?>
                    <div class="form-group">
                      <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
