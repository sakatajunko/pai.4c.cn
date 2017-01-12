<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 14:47
 */

namespace app\models;


use yii\base\Model;
class UploadForm extends Model{
    public $gallery;
    public $cgallery;
    public $url;
    public function rules(){
        return [
            [['image','gallery','cgallery','url'], 'safe'],
            [['image','gallery','cgallery','url'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }
}