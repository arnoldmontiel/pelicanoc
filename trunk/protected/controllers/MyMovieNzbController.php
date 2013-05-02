<?php

class MyMovieNzbController extends Controller
{
	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	
	public function loadModel($id)
	{
		$model=Nzb::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionIndex()
	{	
		//$this->updateFromServer(); en PelicanoHelper
		$this->render('index');
	}

	
	public function actionAjaxStartDownload()
	{
		if(isset($_POST['Id_nzb']))
		{
			$nzb = Nzb::model()->findByPk($_POST['Id_nzb']);
			if(!$nzb->downloading)
			{
				$setting = Setting::getInstance();
				try
				{
					if(copy($setting->path_pending.'/'.$nzb->file_name, $setting->path_ready.'/'.$nzb->file_name))
					{
						$nzb->downloaded = 0;
						$nzb->downloading = 1;
						$nzb->Id_nzb_state = 2;
						$nzb->change_state_date = new CDbExpression('NOW()');
						$nzb->sent = 0;
						$nzb->save();
	
						PelicanoHelper::sendPendingNzbStates();
					}					
				}
				catch (Exception $e)
				{
				}
			}
		}
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$pageNumber=0;
		if(isset($_GET['currentPage']))
		{
			$this->fromPageNumber=$_GET['currentPage'];
		}
		$model = Nzb::model()->findByPk($id);

		
		$this->render('view',array(
				'model'=>$model,
		));
	}
	//move to DuneHelper
	private function playDune($id)
	{
		$model = $this->loadModel($id);
		$setting = Setting::getInstance();
	
		if($model->Id_resource_type == 2)
		{
			$cmd = 'start_bluray_playback';
		}
		else if($model->Id_resource_type == 3)
		{
			$cmd = 'start_dvd_playback';
		}
		else if($model->Id_resource_type == 1)
		{
			$cmd = 'start_file_playback';
		}
	
		$nzbFinalPath = explode('.',$model->file_name);
		$url = $setting->players[0]->url . '/cgi-bin/do?cmd='.$cmd.'&media_url='.$setting->players[0]->file_protocol.':';
		$url = $url . '//'. $setting->host_file_server . $setting->host_file_server_path .'/'.$nzbFinalPath[0].'/'. $model->final_content_path;
		//TODO: analizar el resultado e indicar si la reproducción se a concretado.
		@file_get_contents($url);
		return true;
	}
	
	public function actionAjaxUseRemote()
	{
		$irCode = $_GET['ir_code'];
		$setting = Setting::getInstance();
		echo file_get_contents( $setting->players[0]->url .'/cgi-bin/do?cmd=ir_code&ir_code='.$irCode);
	}
	
	public function actionAjaxStart($id)
	{
		$this->showMenu = false;
		$this->showBrowsingBox = false;		
		if($this->playDune($id))
		{
			$this->render('start',array(
				'model'=>$this->loadModel($id),
			));
		}
	}
	
	public function actionCurrent($id)
	{
		$this->render('start',array(
						'model'=>$this->loadModel($id),
		));
	}
	
}