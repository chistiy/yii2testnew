<?php

namespace app\components;
use yii\base\Widget;
use app\models\hotel\Clients;

class VidsWidget  extends Widget
{
    public function run()
    {
        $vids = \app\models\hotel\Clients::find()->select('name')->asArray()->orderBy('name')->all();
        return $this->render('vids', compact('vids'));
    }
}