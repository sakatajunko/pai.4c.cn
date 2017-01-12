<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                        <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
                        <span class="hidden-xs"><?=\Yii::$app->user->identity->username?>，欢迎登录</span>
                    </a>
                    <ul class="menu">
                        <!-- User image -->
<!--                        <li class="user-header">-->
<!--                            <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle"-->
<!--                                 alt="User Image"/>-->
<!--                            <p>-->
<!--                                <small>小编编</small>-->
<!--                            </p>-->
<!--                        </li>-->
                        <!-- Menu Body -->
                        <!-- Menu Footer-->

                    </ul>
                </li>
                <li class="dropdown user user-menu">
                        <?= Html::a(
                            '退出',
                            ['/site/logout'],
                            ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat text-center']
                        ) ?>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
            </ul>
        </div>
    </nav>
</header>
