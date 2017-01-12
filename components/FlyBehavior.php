<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 13:36
 */

namespace app\commands;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class FlyBehavior extends Behavior{
    private $_wing;
    public function setWing($value){
        $this->_wing = $value;
    }
    public function getWing(){
        return $this->_wing;
    }
    public function fly(){
        echo '用'.$this->_wing.'起飞';

    }
    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE=>'beforeValidate',
        ];
    }

}