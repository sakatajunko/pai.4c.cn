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
	<div id="sentiment">
		<nav>
			<div class="left">
				<a href="javascript:;" class="back">
					<img src="<?php echo \Yii::getAlias('@web/images');?>/back.png">
				</a>
			</div>
			<div class="center">所有单品</div>
		</nav>
		<div class="arrange">
			<div class="left">
				<a href="javascript:;" <?php echo $hot?"class='selected'":''?> hot="hot">
					<span class="icon hot"></span>
					<i>最热</i>
					<span class="icon triangle"></span>
				</a>
				<a href="javascript:;"  <?php echo $new?"class='selected'":''?> hot="new">
					<span class="icon new"></span>
					<i>最新</i>
					<span class="icon triangle"></span>
				</a>
			</div>
			<div class="right">
				<a href="javascript:;">
					<span class="icon choose"></span>
					<i>筛选</i>
				</a>
			</div>
		</div>
		<div class="item">
			<ul>
				<?php foreach ($model as $list):?>
				<li>
					<div class="cont">
						<a href="./signgood?id=<?=$list->id?>">
							<div class="icon"><?=$arr[$list->style]?></div>
							<img src="<?=$list->url?>">
							<div class="cont-bottom">
								<h4><?=$list->goodname?></h4>
								<div>
									<p>¥<?=$list->price?><span>影楼价:<i>¥<b><?=$list->marketprice?></b></i></span></p>
									<p>已售:<?=$list->falsesale?></p>
								</div>
							</div>
						</a>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<footer>
			<a href="http://kefu.qycn.com/vclient/chat/?m=m&websiteid=122265"><img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-nav1.png"></a>
			<a href="http://kefu.qycn.com/vclient/chat/?m=m&websiteid=122265"><img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-nav2.png"></a>
		</footer>
		<div class="classify">
			<div class="classify-main">
				<div class="cid">
					<p>套餐:</p>
					<ul>
						<li><a href="javascript:;" <?php echo $cid==0?"class='selected'":''?>>全部</a></li>
						<?php foreach ($combo as $list):?>
						<li><a href="javascript:;" cid="<?php echo $list['id']?>"  <?php echo $cid==$list['id']?"class='selected'":''?>><?php echo $list['name']?></a></li>
						<?php endforeach;?>
					</ul>
				</div>
				<div class="sid">
					<p>风格:</p>
					<ul>
						<li><a href="javascript:;" <?php echo $sid==0?"class='selected'":''?>>全部</a></li>
						<?php foreach ($style as $list):?>
							<li><a href="javascript:;" sid="<?php echo $list['id']?>" <?php echo $sid==$list['id']?"class='selected'":''?>><?php echo $list['name']?></a></li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
		<div class="pop"></div>
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