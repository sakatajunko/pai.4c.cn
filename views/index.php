<?php
/**
 * Desc: 商品列表
 * Author: chenzhw
 * Date: 2016/12/27 11:06
 */
\yii\grid\GridView::widget([
    'dataProvider' => $model,// 你传过来的ActiveDataProvider
    // 'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],// 第一列排序

        'id',// 第二列，sid，与你查询的model字段相对应，可以少，不可以多
        [
            'attribute' => 'name',
            'label'=>'商品名称',// 自定义列名
        ],// 第三列，sname
        [
            'attribute' => 'status',
            'label'=>'商品名称',// 自定义列名
        ],// 第三列，sname
        [
            'attribute' => 'style',
            'label'=>'风格',// 自定义列名
        ],// 第三列，sname
        [
            'attribute' => 'combo',
            'label'=>'套餐',// 自定义列名
        ],// 第三列，sname
        [
            'attribute' => 'price',
            'label'=>'全价',// 自定义列名
        ],// 第三列，sname
        [
            'attribute' => 'deposit',
            'label'=>'订金',// 自定义列名
        ],// 第三列，sname
        [
            'attribute' => 'marketprice',
            'label'=>'影楼价',// 自定义列名
        ],// 第三列，sname

        [
            'class' => 'yii\grid\ActionColumn',// 动作列，默认三个动作，分别为{view}，{update}，{delete}
            'header' => '操作',// 列名
            'template' => '{stuent-view} {studnet-update} {student-delete}',// 定义这一列里面有几个操作，这里为查看，更新，删除
            'buttons' => [// 为你template中声明的操作声明动作
                'stuent-view' => function ($url, $models, $key) {// 对应{student-view}，三个参数，最主要的$key，为你model主键的id
                    $url = ['student/view', 'id'=>$key];// 为下面a链接的url，此处指向StudentController的actionView方法
                    $options = [
                        'title' => '查看',
                        'aria-label' => '查看',
                        'data-pjax' => '0',
                    ];
                    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                },
                'studnet-update' => function ($url, $models, $key) {// 对应{student-update}
                    $url = ['student/update', 'id'=>$key];
                    $options = [
                        'title' => '更新',
                        'aria-label' => '更新',
                        'data-pjax' => '0',
                    ];
                    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                },
            ]
        ],
    ],
]);