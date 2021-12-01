<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--header-->
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="<?= \yii\helpers\Url::home() ?>"><?= Html::img('@web/images/logo.jpg', ['alt' => 'Blogname']) ?></a>
        </div>
        <!---start-top-nav---->
        <div class="top-menu">
            <div class="search">
                <form>
                    <input type="text" placeholder="" required="">
                    <input type="submit" value=""/>
                </form>
            </div>
            <span class="menu"> </span>
            <ul>
                <li class="active"><a href="index.html">HOME</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="contact.html">CONTACT</a></li>
                <div class="clearfix"> </div>
            </ul>
        </div>
        <div class="clearfix"></div>

        <!---//End-top-nav---->
    </div>
</div>
<!--/header-->
<div class="content">
    <div class="container">
        <div class="content-grids">
            <div class="col-md-8 content-main">
                <?= app\components\VidsWidget::widget()?>
                <?=$content;
                    echo Nav::widget([
   'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Home', 'url' => ['/site/index']],
       ['label' => 'About', 'url' => ['/site/about']],
       ['label' => 'Запросы', 'url' => ['/hotel/query1']],
       ['label' => 'Админ панель', 'url' => ['admin/booking']],
       ['label' => 'rbac', 'url' => ['index/rbac']],
      Yii::$app->user->isGuest ? (
      ['label' => 'Login', 'url' => ['/site/login']]
      ) : (
         '<li>'
          . Html::beginForm(['/site/logout'], 'post')
         . Html::submitButton(
             'Logout (' . Yii::$app->user->identity->username . ')',
              ['class' => 'btn btn-link logout']
           )
         . Html::endForm()
            . '</li>'
       )
   ],
]);
                ?>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<div class="footer">
    <div class="container">
        <p>Copyrights © 2015 Blog All rights reserved | Template by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>