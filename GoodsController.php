<?php
/**
 * Desc: 商品类
 * Author: chenzhw
 * Date: 2016/12/26 10:08
 */

namespace app\controllers;


use app\models\Cgallery;
use app\models\Goodcombo;
use app\models\Goodgallery;
use app\models\Goods;
use app\models\GoodsForm;
use app\models\Goodstyle;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Request;

class GoodsController extends Controller{
    /**
     * @desc 商品列表
     */
    public function actionIndex(){
        $model = Goods::find()->all();
        return $this->render('index',['model'=>$model]);

    }

    /**
     * @desc  商品新增
     * @return string
     */
    public function actionAdd(){
        $model = new GoodsForm();
        $goodstyle = Goodstyle::find()->asArray()->all();
        $goodcombo = Goodcombo::find()->all();
        $request = new Request();
//        if($request->getMethod() == 'POST'){
//
//        }
//        var_dump($goodstyle);exit;
        return $this->render('add',[
            'model'=>$model,
            'goodstyle'=>$goodstyle,
            'goodcombo'=>$goodcombo,
        ]);
    }

    public function actionEdit($id=''){
        $model = new GoodsForm();
        $goodgallery = Goodgallery::find()->where(['goodsid'=>$id])->asArray()->all();
        $cgallery = Cgallery::find()->where(['goodsid'=>$id])->asArray()->all();
        $goodstyle = Goodstyle::find()->asArray()->all();
        $goodcombo = Goodcombo::find()->all();
        $p1 = $p2 = [];
        if($goodgallery){
            foreach($goodgallery as $k=>$v){
                $p1[$k] = $v['gallery'];
                $p2[$k] = [
                    //要删除商品图的地址
                    'url' => Url::toRoute('/gallery/delete'),
                    //对应的图片ID
                    'id'=> $v['id'],
                ];
            }
        }
        $p3 = $p4 = [];
        if($cgallery){
            foreach($cgallery as $k=>$v){
                $p3[$k] = $v['cgallery'];
                $p4[$k] = [
                    //要删除商品图的地址
                    'url' => Url::toRoute('/cgallery/delete'),
                    //对应的图片ID
                    'id'=> $v['id'],
                ];
            }
        }
        return $this->render('edit',[
            'goodgallery'=>$goodgallery,
            'cgallery'=>$cgallery,
            'model'=>$model,
            'goodstyle'=>$goodstyle,
            'goodcombo'=>$goodcombo,
            'p1'=>$p1,
            'p2'=>$p2,
            'p3'=>$p3,
            'p4'=>$p4,
            'id'=>$id,
        ]);
    }

}