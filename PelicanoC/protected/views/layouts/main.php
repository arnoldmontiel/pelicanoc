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
	<div class="leftcurtain hideClass"><img src="images/frontcurtain.jpg"/></div>
	<div class="rightcurtain hideClass"><img src="images/frontcurtain.jpg"/></div>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
			<?php echo CHtml::encode(Yii::app()->name); ?>
			<?php //echo CHtml::image("images/logo_pelicano.png","Pelicano",array("style"=>"width:100px;height:100px;"));?>
			 
		</div>
		<div class="customer-name">
			 <?php
			 	$customer = Setting::getInstance()->getCustomer(); 
			 	echo $customer->name.' '.$customer->name->last_name;
			 	echo '('.$customer->current_points.' points)';
			 	?>
		</div>
		<div class="browsingbox">
			<div class="browsingbox-prev">
				<?php
				echo CHtml::link(CHtml::image("images/back-black.png",'details',array('id'=>'site_prev', 'style'=>'height: 60px;width: 60px;')
				),Yii::app()->request->getUrlReferrer());
				//),Yii::app()->request->getUrlReferrer().'&pageNumber='.$this->fromPageNumber);
				?>
			</div>
			<div class="browsingbox-next">
				<?php
				echo CHtml::link(CHtml::image("images/next-black.png",'details',array('id'=>'site_next', 'style'=>'height: 60px;width: 60px;')
				),Yii::app()->request->getUrlReferrer());
				?>
			</div>
		</div>
		
	</div><!-- header -->
	<?php if ($this->showMenu):?>
	<div id="mainmenu">
		<?php
		if(Yii::app()->user->checkAccess('SiteIndex'))
		{ 
			echo CHtml::link( CHtml::image("images/home.png",'movies',array('id'=>'home_button', 'style'=>'height: 128px;width: 128px;')
			),array('/site/index'));
		}		
		if(Yii::app()->user->checkAccess('ImdbdataIndex'))
		{ 
			echo CHtml::link( CHtml::image("images/movies.png",'movies',array('id'=>'movie_button', 'style'=>'height: 128px;width: 128px;')
			),array('/imdbdata/index'));
		}
		if(Yii::app()->user->checkAccess('ImdbdataNews'))
		{ 
			echo CHtml::link( CHtml::image("images/news.png",'movies',array('id'=>'news_button', 'style'=>'height: 128px;width: 128px;')
			),array('/imdbdata/news'));
		}
		if(Yii::app()->user->checkAccess('ImdbdataTvIndex'))
		{ 
			echo CHtml::link( CHtml::image("images/series.png",'movies',array('id'=>'series_button', 'style'=>'height: 128px;width: 128px;')
			),array('/imdbdataTv/index'));
		}
		if(Yii::app()->user->checkAccess('SiteMusic'))
		{ 
			echo CHtml::link( CHtml::image("images/music.png",'movies',array('id'=>'music_button', 'style'=>'height: 128px;width: 128px;')
			),array('/site/music'));
		}
		if(Yii::app()->user->checkAccess('SabnzbdIndex'))
		{ 
			echo CHtml::link( CHtml::image("images/downloading-menu.png",'movies',array('id'=>'downloading_button', 'style'=>'height: 128px;width: 128px;')
			),array('/sabnzbd/index'));
		}
		if(Yii::app()->user->checkAccess('ImdbdataStored'))
		{
			echo CHtml::link( CHtml::image("images/stored.png",'movies',array('id'=>'stored_button', 'style'=>'height: 128px;width: 128px;')
			),array('/imdbdata/stored'));
		}
		if(Yii::app()->user->checkAccess('NzbRequested'))
		{
			echo CHtml::link( CHtml::image("images/cart.png",'movies',array('id'=>'cart_button', 'style'=>'height: 128px;width: 128px;')
			),array('/nzb/requested'));
		}
		echo CHtml::link( CHtml::image("images/logout.png",'movies',array('id'=>'logout_button', 'style'=>'height: 128px;width: 128px;float:right;')
		),array('/site/logout'));
		?>				
		<?php 
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
			$('#stored_button').hover(
			function () {
				$(this).attr('src','images/stored-light.png');
			  },
			  function () {
				$(this).attr('src','images/stored.png');
			  }
			);
			$('#series_button').hover(
			function () {
				$(this).attr('src','images/series-light.png');
			  },
			  function () {
				$(this).attr('src','images/series.png');
			  }
			);
			$('#cart_button').hover(
			function () {
				$(this).attr('src','images/cart-light.png');
			  },
			  function () {
				$(this).attr('src','images/cart.png');
			  }
			);
			$('#logout_button').hover(
			function () {
				$(this).attr('src','images/logout-light.png');
			  },
			  function () {
				$(this).attr('src','images/logout.png');
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
		?>
