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
	<!-- <div class="loading">
		<div class="load">
			<div class="rect1"></div>
			<div class="rect2"></div>
			<div class="rect3"></div>
			<div class="rect4"></div>
			<div class="rect5"></div>
		</div>
	</div> -->
	<div id="details">
		<a href="javascript:;" class="icon back"></a>
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php foreach ($gallery as $list):?>
				<div class="swiper-slide">
					<img src="<?=$list->url?>">
				</div>
				<?php endforeach;?>
<!--				<div class="swiper-slide">-->
<!--					<img src="--><?php //echo \Yii::getAlias('@web/images');?><!--/6.jpg">-->
<!--				</div>-->
<!--				<div class="swiper-slide">-->
<!--					<img src="--><?php //echo \Yii::getAlias('@web/images');?><!--/6.jpg">-->
<!--				</div>-->
			</div>			
			<div class="swiper-pagination"></div>
		</div>
		<div class="info">
			<h2><?=$model->goodname?></h2>
			<div class="price">
				<p><i>¥</i><?=$model->price?></p>
				<span>定金:¥<?=$model->deposit?></span>
			</div>
			<div class="number">已售:<i><?=$model->falsesale?></i></div>
		</div>
		<div class="main">
			<ul class="tabs" id="tabs">
		       <li class="icon tabs-icon"><a href="javascript:;"></a></li>
		       <li class="icon tabs-icon"><a href="javascript:;"></a></li>
		    </ul>
		    <ul class="tab_conbox" id="tab_conbox">
		        <li class="tab_con">
					<?=$model->describe?>
		        </li>
		        <li class="tab_con">
					<?php foreach ($cgallery as $list):?>
						<img src="<?=$list->url?>">
					<?php endforeach;?>

		        </li>
		    </ul>
		</div>
		<footer>
			<a href="javascript:;"><img src="<?php echo \Yii::getAlias('@web/images');?>/advisory.png"></a>
			<a href="javascript:;"><img src="<?php echo \Yii::getAlias('@web/images');?>/make.png"></a>
			<!-- <a href="./index"><img src="<?php echo \Yii::getAlias('@web/images');?>/go-index.png" class="go-index"></a> -->
		</footer>
	</div>
	<?=\yii\helpers\Html::jsFile('@web/js/jquery-3.0.0.min.js')?>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<?=\yii\helpers\Html::jsFile('@web/js/fastclick.js')?>
	<?=\yii\helpers\Html::jsFile('@web/js/swiper.js')?>
	<?=\yii\helpers\Html::jsFile('@web/js/index.js')?>
	<script type="text/javascript">
		var swiper = new Swiper('.swiper', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            // autoplay: 2500,
            loop:true,
            autoplayDisableOnInteraction: false
        }); 
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