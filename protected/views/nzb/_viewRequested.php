<?php 
Yii::app()->clientScript->registerScript(__CLASS__.'#Imdbdata_view', "

");

?>

<div class="single-movie-index-view" >
	<div class="single-movie-view" >
		<?php		
		$pagination = $widget->dataProvider->getPagination();
		if(isset($data->imdbdata))
		{
			$imdb = $data->imdbdata;
		}else
		{
			$imdbParent = $data->imdbdataTv->parent; 
			$imdb = $data->imdbdataTv;				
		}
		echo CHtml::link( CHtml::image("images/".$imdb->Poster,'details',array('id'=>'Imdbdata_Poster_button', 'style'=>'height: 260px;width: 185px;')
			),array('viewRequested', 'id'=>$data->Id,'currentPage'=>$pagination->getCurrentPage()));
		?>
		<p class="single-serie-view-title">
		<?php 
			$title = ''; 
			if(isset($imdbParent))	$title = $imdbParent->Title.': ';
			$title.= $imdb->Title;
			echo CHtml::encode($title); 
		?>
		</p>  
		<p class="single-serie-view-title">
		<?php echo isset($imdb->Season)?'S'.CHtml::encode($imdb->Season):'';?>
		<?php echo isset($imdb->Episode)?'/E'.CHtml::encode($imdb->Episode):'';?>
		</p>  
		
	</div>

</div>