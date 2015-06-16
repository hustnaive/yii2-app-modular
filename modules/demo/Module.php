<?php
 /**
  * Module.php
  *
  * @author        xiongzg
  * @create_time	   2015-01-15 09:58
  */

namespace modules\demo;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'modules\demo\controllers';

    public function init()
    {
        parent::init();
        $this->setViewPath(__DIR__.'/views/');
        $this->setLayoutPath(__DIR__.'/views/layouts/');
    }
} 