<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class TopNavWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
    }
    public function run()
    {
        return $this->render('TopNavWidget');
    }
}
