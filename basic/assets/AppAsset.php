<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'http://fonts.googleapis.com/css?family=Oswald:100,400,300,700',
        'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic',
    ];
    public $js = [
        'js/move-top.js',
        'js/easing.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

//NavBar::begin([
//    'brandLabel' => Yii::$app->name,
//    'brandUrl' => Yii::$app->homeUrl,
//    'options' => [
//        'class' => 'navbar-inverse navbar-fixed-top',
//    ],
//]);
//echo Nav::widget([
//    'options' => ['class' => 'navbar-nav navbar-right'],
//    'items' => [
//        ['label' => ' Главная', 'url' => ['/admin/default/index']],
//        ['label' => 'О нас и о вас ', 'url' => ['/admin/default/about']],
//        ['label' => 'Запросы', 'url' => ['/hotel/query1']],
//        ['label' => 'Пользователи', 'url' => ['/rbac/default/index']],
//        ['label' => 'crud',
//            'items' => [
//                '<li class="divider"></li>',
//                ['label' => 'booking', 'url' => '/admin/booking'],
//                ['label' => 'clientbookingroom', 'url' => '/admin/clientbookingroom'],
//                ['label' => 'clients', 'url' => '/admin/clients'],
//                ['label' => 'feedback', 'url' => '/admin/feedback'],
//                ['label' => 'floors', 'url' => '/admin/floors'],
//                ['label' => 'hotel building', 'url' => '/admin/hotelbuilding'],
//                ['label' => 'hotelroom', 'url' => '/admin/hotelroom'],
//                ['label' => 'organizations', 'url' => '/admin/organizations'],
//                ['label' => 'paymentforservices', 'url' => '/admin/paymentforservices'],
//                ['label' => 'services', 'url' => '/admin/services'],
//            ],
//
//        ],
//
//        Yii::$app->user->isGuest ? (
//        ['label' => 'Войти', 'url' => ['/site/login']]
//        ) : (
//            '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Выйти (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>'
//        )
//    ],
//]); ?>
