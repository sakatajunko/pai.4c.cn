<?php
/**
 * Desc: 商品表单
 * Author: chenzhw
 * Date: 2016/12/26 9:57
 */

namespace app\models;


use yii\base\Model;

class GoodsForm extends Model{
    public $name; //名称
    public $status; //是否上架
    public $style; //风格
    public $combo; //套餐
    public $gallery; //相册
    public $cgallery; //客片
    public $price; //全价
    public $deposit; //订金
    public $marketprice; //影楼价
    public $falsesale; //展示销量
    public $describe; //描述
}