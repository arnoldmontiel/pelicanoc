<!DOCTYPE html>
<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl."/js/tools.js");?>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
			<?php echo CHtml::encode(Yii::app()->name); ?>
			<?php //echo CHtml::image("images/logo_pelicano.png","Pelicano",array("style"=>"width:100px;height:100px;"));?>
			 
		</div>
	</div><!-- header -->
	<?php if ($this->showMenu):?>
	<div id="mainmenu">
		<?php
		Yii::app()->clientScript->registerScript('main', "
			$('#movie_button').hover(
			function () {
				$(this).attr('src','images/movies-light.png');
				//$(this).addClass('menu-hover');
			  },
			  function () {
				$(this).attr('src','images/movies.png');
				//$(this).removeClass('menu-hover');
				}
			);
			$('#news_button').hover(
			function () {
				$(this).attr('src','images/news-light.png');
			  },
			  function () {
				$(this).attr('src','images/news.png');
			  }
			);
			$('#downloading_button').hover(
			function () {
				$(this).attr('src','images/downloading-menu-light.png');
			  },
			  function () {
				$(this).attr('src','images/downloading-menu.png');
			  }
			);
			$('#home_button').hover(
			function () {
				$(this).attr('src','images/home-light.png');
			  },
			  function () {
				$(this).attr('src','images/home.png');
			  }
			);
			$('#music_button').hover(
			function () {
				$(this).attr('src','images/music-light.png');
			  },
			  function () {
				$(this).attr('src','images/music.png');
			  }
			);

			$('#site_prev').hover(
			function () {
				$(this).attr('src','images/back-black-light.png');
			  },
			  function () {
				$(this).attr('src','images/back-black.png');
			  }
			);
			$('#site_next').hover(
			function () {
				$(this).attr('src','images/next-black-light.png');
			  },
			  function () {
				$(this).attr('src','images/next-black.png');
			  }
			);
		
		");
		echo CHtml::link( CHtml::image("images/home.png",'movies',array('id'=>'home_button', 'style'=>'height: 128px;width: 128px;')
		),array('/site/index'));		
		echo CHtml::link( CHtml::image("images/movies.png",'movies',array('id'=>'movie_button', 'style'=>'height: 128px;width: 128px;')
		),array('/imdbdata'));
		echo CHtml::link( CHtml::image("images/news.png",'movies',array('id'=>'news_button', 'style'=>'height: 128px;width: 128px;')
		),array('/imdbdata/news'));
		echo CHtml::link( CHtml::image("images/music.png",'movies',array('id'=>'music_button', 'style'=>'height: 128px;width: 128px;')
		),array('/site/music'));
		echo CHtml::link( CHtml::image("images/downloading-menu.png",'movies',array('id'=>'downloading_button', 'style'=>'height: 128px;width: 128px;')
		),array('/SABnzbd'));
		?>
		<div class="browsingbox">
			<div class="browsingbox-prev">
				<?php
				echo CHtml::link(CHtml::image("images/back-black.png",'details',array('id'=>'site_prev', 'style'=>'height: 60px;width: 60px;')
				),Yii::app()->request->getUrlReferrer());
				?>
			</div>
			<div class="browsingbox-next">
				<?php
				echo CHtml::link(CHtml::image("images/next-black.png",'details',array('id'=>'site_next', 'style'=>'height: 60px;width: 60px;')
				),Yii::app()->request->getUrlReferrer());
				?>
			</div>
		</div>
				
		<?php 
// 		$this->widget('zii.widgets.CMenu',array(
// 			'items'=>array(
// 				array('label'=>'Home', 'url'=>array('/site/index')),
// 				array('label'=>'Movies', 'url'=>array('/imdbdata')),
// 				array('label'=>'News', 'url'=>array('/imdbdata/news')),
// 				array('label'=>'SABnzbd', 'url'=>array('/SABnzbd')),
// 		//		array('label'=>'Resource', 'url'=>array('/resource')),
// 				array('label'=>'Settings', 'url'=>array('/setting')),
// 		),
// 		)); 
		?>
	</div><!-- mainmenu -->
	<?php endif?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
