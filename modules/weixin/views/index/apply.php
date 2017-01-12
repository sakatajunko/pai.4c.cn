<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>放心拍</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?=\yii\helpers\Html::cssFile('@web/css/index.css')?>
</head>
<body>
	<div id="apply">
		<nav>
			<div class="left">
				<a href="javascript:;" class="back">
					<img src="<?php echo \Yii::getAlias('@web/images');?>/back.png">
				</a>			
			</div>
			<div class="center">报名预约</div>
		</nav>
		<div class="main">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/apply-title.png"></h3>
			<div class="form">
				<p>
					<label><img src="<?php echo \Yii::getAlias('@web/images');?>/user-name.png"></label>
					<input type="text" placeholder="请输入您的姓名">
				</p>
				<p>
					<label><img src="<?php echo \Yii::getAlias('@web/images');?>/user-tel.png"></label>
					<input type="tel" placeholder="请输入您的11位手机号码">
				</p>
				<a href="javascript:;"><img src="<?php echo \Yii::getAlias('@web/images');?>/submit.png"></a>
			</div>
		</div>
		<div class="item focus">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/focus-title.png"></h3>
			<div class="cont">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/focus-cont.png">
			</div>
		</div>
	</div>
	<?=\yii\helpers\Html::jsFile('@web/js/jquery-3.0.0.min.js')?>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<?=\yii\helpers\Html::jsFile('@web/js/fastclick.js')?>
	<?=\yii\helpers\Html::jsFile('@web/js/swiper.js')?>
	<?=\yii\helpers\Html::jsFile('@web/js/index.js')?>
	<script type="text/javascript">
        //微信分享
		wx.config({
            debug: false,
            appId: "{pigcms:$getSignPackage.appId}",
            timestamp: "{pigcms:$getSignPackage.timestamp}",
            nonceStr: "{pigcms:$getSignPackage.nonceStr}",
            signature: "{pigcms:$getSignPackage.signature}",
            jsApiList: [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ'
            ]
        })
	</script>
</body>
</html>