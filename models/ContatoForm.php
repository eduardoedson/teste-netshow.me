<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "avisos".
 *
 * @property string $nome
 * @property string $email
 * @property string $telefone
 * @property string $mensagem
 * @property string $file_dir
 */

class ContatoForm extends \yii\db\ActiveRecord
{
  public static function tableName()
  {
    return 'contato';
  }
  
  public function rules()
  {
    return [
      [['nome', 'email', 'telefone', 'mensagem'], 'required'],
      
      ['email', 'email'],
      ['nome', 'string', 'max' => 50],
      ['telefone', 'string', 'max' => 20],
      
      [['file_dir'], 'file', 'extensions' => 'pdf, docx, odt, txt', 'maxSize' => 500 * 1024, 'tooBig' => 'Limit is 500KB']
    ];
  }

  public function attributeLabels() {
    return [
        'nome' => 'Nome',
        'email' => 'E-mail',
        'telefone' => 'Telefone',
        'mensagem' => 'Mensagem',
        'file_dir' => 'Arquivo',
    ];
}
  
  public function contact($email)
  {
    if ($this->validate()) {
      Yii::$app->mailer->compose()
      ->setTo($email)
      ->setFrom([$this->email => $this->nome])
      ->setSubject($this->nome)
      ->setTextBody($this->mensagem)
      ->send();
      return true;
    }
    return false;
  }
}
