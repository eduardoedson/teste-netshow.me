<?php

namespace tests\unit\models;

use app\models\ContatoForm;
use yii\mail\MessageInterface;

class ContatoFormTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testEmailIsSentOnContact()
    {
        /** @var ContactForm $model */
        $this->model = $this->getMockBuilder('app\models\ContatoForm')
            ->setMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $this->model->attributes = [
            'nome' => 'Tester',
            'email' => 'tester@example.com',
            'telefone' => '(99) 9 9999 - 9999',
            'mensagem' => 'body of current message',
        ];

        expect_that($this->model->contact('admin@example.com'));
    }
}
