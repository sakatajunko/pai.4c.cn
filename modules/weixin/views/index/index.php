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
	<div id="index">
		<nav>
			<div class="left">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/logo.png">
			</div>
			<div class="right">
				<a href="tel:962599">
					<img src="<?php echo \Yii::getAlias('@web/images');?>/tel.png">962599
				</a>
			</div>
			<div class="center">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/title.png">
			</div>			
		</nav>
		<div class="swiper">
			<div class="swiper-wrapper">
				<!-- <div class="swiper-slide">
					<img src="<?php echo \Yii::getAlias('@web/images');?>/1.jpg">
				</div>
				<div class="swiper-slide">
					<img src="<?php echo \Yii::getAlias('@web/images');?>/1.jpg">
				</div>
				<div class="swiper-slide">
					<img src="<?php echo \Yii::getAlias('@web/images');?>/1.jpg">
				</div> -->
			</div>			
			<div class="swiper-pagination"></div>
		</div>
		<div class="introduce">
			<img src="<?php echo \Yii::getAlias('@web/images');?>/introduce.png">
		</div>
		<div class="nav">
			<a href="http://kefu.qycn.com/vclient/chat/?m=m&websiteid=122265">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/index-nav-one.png">
			</a>
			<a href="javascript:;">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/index-nav-two.png">
			</a>
			<a href="./apply">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/index-nav-three.png">
			</a>
		</div>
		<div class="item hot">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/hot-title.png"></h3>
			<ul>
				<?php foreach ($hotgood as $list):?>
				<li>
					<img src="<?php echo \Yii::getAlias('@web/images');?>/hot-bg.png">
					<div class="cont">
						<a href="./signgood?id=<?=$list->id?>">
							<div class="icon"><?=$style[$list->style]?></div>
							<img src="<?=$list->url?>">
							<div class="cont-bottom">
								<h4><?=$list->goodname?><span>已售:<?=$list->falsesale?></span></h4>
								<p>惊爆价:¥<?=$list->price?><span>影楼价:<i>¥<b><?=$list->marketprice?></b></i></span></p>
							</div>
						</a>						
					</div>
				</li>
				<?php endforeach;?>
			</ul>
			<a href="./sentiment" class="more">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/more.png">
			</a>
		</div>
		<div class="item sentiment">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-title.png"></h3>
			<ul>
				<?php foreach ($hotstyle as $list):?>
					<li>
						<img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-bg.png">
						<div class="icon-hot"><img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-hot.png" alt=""></div>
						<div class="icon"><img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-icon.png" alt=""></div>
						<div class="cont">
							<a href="javascript:;">
								<img src="<?=$list->url?>">
								<div class="cont-bottom">
									<h4><?=$list->name?></h4>
									<p>¥2888<span>影楼价:<i>¥<b>2888</b></i></span></p>
								</div>
								<div class="sentiment-view"><img src="<?php echo \Yii::getAlias('@web/images');?>/sentiment-view.png" alt=""></div>
							</a>
						</div>
					</li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="item process">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/process-title.png"></h3>
			<div class="cont">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/process-cont.png">
			</div>
		</div>
		<div class="item goods">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/goods-title.png"></h3>
			<ul>
				<li>
					<img src="<?php echo \Yii::getAlias('@web/images');?>/goods-bg.png">
					<div class="cont">
						<a href="javascript:;">
							<img src="<?php echo \Yii::getAlias('@web/images');?>/4.jpg">
							<div class="info">
								<p>放心拍给了我一次难忘婚照体验!透明消费，工作人员都超级nice~</p>
								<span>王女士<i>成都</i></span>
							</div>
						</a>						
					</div>
				</li>
				<li>
					<img src="<?php echo \Yii::getAlias('@web/images');?>/goods-bg.png">
					<div class="cont">
						<a href="javascript:;">
							<img src="<?php echo \Yii::getAlias('@web/images');?>/4.jpg">
							<div class="info">
								<p>放心拍给了我一次难忘婚照体验!透明消费，工作人员都超级nice~</p>
								<span>王女士<i>成都</i></span>
							</div>
						</a>						
					</div>
				</li>
			</ul>
			<div class="goods-label">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/goods-label.png">
			</div>
		</div>
		<div class="item guide">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/guide-title.png"></h3>
			<ul>
				<li>
					<a href="http://www.4c.cn/thread-1245433270-1-1.html">
						<img src="<?php echo \Yii::getAlias('@web/images');?>/guide-bg1.png">
						<div class="cont">						
							<h4>2017最新结婚吉日早知道!</h4>
							<p>2017最新结婚吉日早知道！明年所有的吉日都在这儿了！有需要的赶紧来看！</p>
						</div>
					</a>
				</li>
				<li>
					<a href="http://www.4c.cn/thread-1245440036-1-1.html">
						<img src="<?php echo \Yii::getAlias('@web/images');?>/guide-bg2.png">
						<div class="cont">
							<h4>选婚纱前必须要提前做的准备!</h4>
							<p>囍妹儿提醒您：为了拍出美美哒婚照，选婚纱时可以提前做好这些准备哦！</p>
						</div>
					</a>
				</li>
				<li>
					<a href="http://www.4c.cn/thread-1245438815-1-1.html">
						<img src="<?php echo \Yii::getAlias('@web/images');?>/guide-bg3.png">
						<div class="cont">
							<h4>婚纱照绝对不能摆这些POSE!</h4>
							<p>避雷！做了这些动作绝对会毁了你的婚纱照！</p>
						</div>
					</a>
				</li>
				<li>
					<a href="http://www.4c.cn/thread-1245436413-1-1.html">
						<img src="<?php echo \Yii::getAlias('@web/images');?>/guide-bg4.png">
						<div class="cont">
							<h4>最全婚照防坑指南!</h4>
							<p>与其拿到照片和账单懵逼，不如看看这篇婚照防坑计！</p>
						</div>
					</a>
				</li>
				<li>
					<a href="http://www.4c.cn/thread-1245441329-1-1.html">
						<img src="<?php echo \Yii::getAlias('@web/images');?>/guide-bg5.png">
						<div class="cont">
							<h4>婚照史上最大的难题已经解决!</h4>
							<p>囍妹儿向婚姐发出了一个爱的抱抱并表示这个难题终于已经得到解决了！</p>					
						</div>
					</a>
				</li>
			</ul>
		</div>
		<div class="item focus">
			<h3><img src="<?php echo \Yii::getAlias('@web/images');?>/focus-title.png"></h3>
			<div class="cont">
				<img src="<?php echo \Yii::getAlias('@web/images');?>/focus-cont.png">
			</div>
		</div>
		<footer>
			All Rights Reserved<br>©2016 第四城4c.cn
		</footer>
		<a href="#index" class="gotop"><img src="<?php echo \Yii::getAlias('@web/images');?>/gotop.png"></a>
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
			appId: "<?php echo $sign['appId'];?>",
			timestamp: <?php echo $sign['timestamp'];?>,
			nonceStr: "<?php echo $sign['nonceStr'];?>",
			signature: "<?php echo $sign['signature'];?>",
            jsApiList: [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ'
            ]
        })
	</script>
</body>
</html>