<?php
 /**
  * Module.php
  *
  * @author        fangliang
  * @create_time	   2015-06-16
  */

namespace modules\demo;


class Module extends \yii\base\Module
{
    public $layout = "main";
    public $controllerNamespace = 'modules\demo\controllers';

    public function init()
    {
        parent::init();
        //do something init here
    }
} 