<?php

class SABnzbdController extends Controller
{
	public function actionIndex()
	{
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		
		$arrayDataProvider=new CArrayDataProvider($sABnzbdStatus->jobs,
			array(
				'pagination'=>array('pageSize'=>10,)
			)
		);
		
		$this->render('SABnzbdStatus',array('modelStatus'=>$sABnzbdStatus,'arrayDataProvider'=>$arrayDataProvider));
		
	}
	
	public function actionRefreshHeader()
	{
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
	
		$this->render('SABnzbdStatus',array('modelStatus'=>$sABnzbdStatus));
	
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}