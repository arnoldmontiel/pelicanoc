<?php
class TMDBHelper
{
	static public function downloadAndLinkImages($TMDBId,$idResource,$sourceType,$poster,$bigPoster,$backdrop)
	{
		try {
			if($sourceType == 1)
			{
				$modelResource = Nzb::model()->findByPk($idResource);
				$model = $modelResource->TMDBData;
			}
			else if($sourceType == 2)
			{
				$modelResource = RippedMovie::model()->findByPk($idResource);
				$model = $modelResource->TMDBData;
			}
			else
			{
				$modelResource = LocalFolder::model()->findByPk($idResource);
				$model = $modelResource->TMDBData;
			}
			
			if(!isset($model))
			{
				$model = new TMDBData();
			}
			
			if($poster!="")
				$model->poster = self::getImage($poster, $TMDBId);
			if($bigPoster!="")
				$model->big_poster = self::getImage($bigPoster, $TMDBId."_big");
			if($backdrop!="")
				$model->backdrop = self::getImage($backdrop, $TMDBId."_bd");
			
			$model->TMDB_id = $TMDBId;
			
			$model->save();
			$modelResource->Id_TMDB_data = $model->Id;
			$modelResource->save();
			
		} catch (Exception $e) {
		}
	}
	private function getImage($original, $newFileName)
	{
		$validator = new CUrlValidator();
		$setting = Setting::getInstance();
	
		$name = 'no_poster.jpg';
		if($original!='' && $validator->validateValue($original))
		{
			try {
				$content = @file_get_contents($original);
				if ($content !== false) {
					$file = fopen($setting->path_images."/".$newFileName.".jpg", 'w');
					fwrite($file,$content);
					fclose($file);
					$name = $newFileName.".jpg";
				} else {
					// an error happened
				}
			} catch (Exception $e) {
				throw $e;
				// an error happened
			}
		}
	
		return $name;
	
	}
	
}