<?php

namespace humhub\modules\space\widgets;

use humhub\components\Widget;
use Yii;

/**
 * Class Survey
 * @package humhub\modules\space\widgets
 */
class Survey extends Widget
{
    public function run()
    {
        $login='nouser';
        If (isset(Yii::$app->user->getIdentity()->username)){
            $login=Yii::$app->user->getIdentity()->username;
        }
        
        $url= 'http://10.11.42.39:8087/#/landing?username=' . $login .'&token=bXktbG9uZy1zZWNyZXQta2V5LXNldC13b3JraW5nLWp3dC1sZW5naHQtcGFzc3dvcmQtd2l0aC1taW5pbXVtLWxlbmdodC1ieS01MTItYml0cwo=';
        return $url;
    }
}
