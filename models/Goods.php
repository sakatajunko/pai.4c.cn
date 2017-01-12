<?php
/**
 * Desc:  商品模型类
 * Author: chenzhw
 * Date: 2016/12/30 11:57
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property integer $style
 * @property integer $gallery
 * @property string $price
 * @property string $deposit
 * @property string $marketprice
 * @property integer $comment
 * @property integer $realsale
 * @property integer $falsesale
 * @property integer $pv
 * @property string $describe
 * @property integer $display
 */
class Goods extends \yii\db\ActiveRecord{
    static $_status = ['下架','上架'];
    static $_ishot = ['否','是'];
    public $gallery;
    public $cgallery;
    public $image;
//    const SCENARIO_CREATE = 'create';
//    public function scenarios(){
//        $scenarios = parent::scenarios();
//        $scenarios[self::SCENARIO_CREATE] = ['goodname'];
//        return $scenarios;
//    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodname','price','deposit','marketprice','falsesale','describe'],'required'],
//            [['goodname'],'unique'],
            [['status', 'style','ishot', 'falsesale', 'display','combo','order','comment'], 'integer'],
            [['price', 'deposit', 'marketprice'], 'number'],
            [['gallery','cgallery','image','addtime'], 'safe'],
            [['goodname', 'describe','url'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goodname' => '商品名称',
            'status' => '是否上架',
            'ishot'=>'首页展示',
            'style' => '商品风格',
            'combo' => '套餐',
            'url'=>'商品封面',
            'image'=>'首页图片',
            'gallery' => '商品相册',
            'cgallery' => '客片展示',
            'price' => '全价',
            'deposit' => '订金',
            'marketprice' => '影楼价',
            'realsale' => '真实销量',
            'falsesale' => '展示销量',
            'describe' => '描述',
            'pv'=>'浏览量',
            'order'=>'订单数量',
            'comment'=>'晒单数量',
            'addtime'=>'创建时间',
            'goodstyle.name'=>'商品风格',
            'goodcombo.name'=>'商品套餐',

        ];
    }
    /**
     * @desc 关联style表
     * @return \yii\db\ActiveQuery
     */
    public function getGoodstyle(){
        return $this->hasOne(Goodstyle::className(),['id'=>'style']);
    }

    public function getGoodcombo(){
        return $this->hasOne(Goodcombo::className(),['id'=>'combo']);
    }

}
