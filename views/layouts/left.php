<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=\Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '菜单列表', 'options' => ['class' => 'header']],
                    ['label' => '商品列表', 'icon' => 'glyphicon glyphicon-paperclip', 'url' => ['/goods/index']],
                    ['label' => '风格列表', 'icon' => 'fa fa-dashboard', 'url' => ['/goodstyle/index']],
                    ['label' => '套餐列表', 'icon' => 'glyphicon glyphicon-usd', 'url' => ['/goodcombo/index']],
                    ['label' => '报名用户', 'icon' => 'glyphicon glyphicon-user', 'url' => '/members/index'],
                    ['label' => '订单列表', 'icon' => 'glyphicon glyphicon-shopping-cart', 'url' => '/order/index'],
                    ['label' => '热卖单品', 'icon' => 'fa fa-dashboard', 'url' => '/hotgood/index'],
                    ['label' => '所有操作', 'options' => ['class' => 'header']],
                    [
                        'label' => '所有',
                        'icon' => 'glyphicon glyphicon-folder-open',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => '商品管理',
                                'icon' => 'fa fa-circle-o text-aqua',
                                'url' => '#',
                                'items' => [
                                    ['label' => '商品列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                    ['label' => '商品新增', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => '风格管理',
                                'icon' => 'fa fa-circle-o text-aqua',
                                'url' => '#',
                                'items' => [
                                    ['label' => '风格列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                    ['label' => '风格新增', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => '套餐管理',
                                'icon' => 'fa fa-circle-o text-aqua',
                                'url' => '#',
                                'items' => [
                                    ['label' => '套餐列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                    ['label' => '套餐新增', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => '用户管理',
                                'icon' => 'fa fa-circle-o text-aqua',
                                'url' => '#',
                                'items' => [
                                    ['label' => '用户列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                    ['label' => '用户新增', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => '订单管理',
                                'icon' => 'fa fa-circle-o text-aqua',
                                'url' => '#',
                                'items' => [
                                    ['label' => '订单列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                    ['label' => '订单新增', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => '协议管理',
                                'icon' => 'fa fa-circle-o text-aqua',
                                'url' => '#',
                                'items' => [
                                    ['label' => '协议列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                                    ['label' => '协议新增', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'fa fa-circle-o text-aqua',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
//                                        ],
//                                    ],
                                ],
                            ],
                        ],
                    ],
                    ['label' => '管理员选项', 'options' => ['class' => 'header']],
                    [
                        'label' => '管理员选项',
                        'icon' => 'glyphicon glyphicon-folder-open',
                        'url' => '#',
                        'items' => [
                            ['label' => '管理员列表', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '/user/index',],
                            ['label' => '新增管理员', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '/user/signup',],
                            ['label' => '权限设置', 'icon' => 'fa fa-circle-o text-yellow', 'url' => '#',],
                        ],
                    ],
                ]
            ]
        ) ?>

    </section>

</aside>
