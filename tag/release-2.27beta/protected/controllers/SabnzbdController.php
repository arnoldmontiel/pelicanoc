<?php

class SabnzbdController extends Controller
{
	public $layout='//layouts/column1';
	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
		array('allow',
					'users'=>array('*'),
		),
		);
	}
	
	public function actionIndex()
	{
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		
		$arrayDataProvider=new CArrayDataProvider($sABnzbdStatus->jobs,
			array(
				'pagination'=>array('pageSize'=>10,)
			)
		);
		
		$this->render('index',
			array('modelStatus'=>$sABnzbdStatus,
				'arrayDataProvider'=>$arrayDataProvider,
			)
		);
		
	}
	
	private function generateHeader()
	{		
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		
		$header = CHtml::openTag("table", array('id'=>'yw0','class'=>'detail-view'));
		$header.= 	CHtml::openTag("tbody");
		
		$arrayAttr = $sABnzbdStatus->getAttributes();
		
		$isOdd = true;
		$arraySize = count($arrayAttr);
		$index = 0;
		
		while ($index < $arraySize) {
			$value = current($arrayAttr);
			if(!is_array($value))
			{
				if($isOdd)
				{
					$header.= 		CHtml::openTag("tr",array('class'=>'odd'));
					$isOdd = false;
				}
				else
				{
					$header.= 		CHtml::openTag("tr",array('class'=>'even'));
					$isOdd = true;
				}
				$header.= 	CHtml::openTag("th");
				$header.= 	$sABnzbdStatus->getAttributeLabel(key($arrayAttr));
				$header.=   CHtml::closeTag("th");
				$header.= 	CHtml::openTag("td");
				$header.= 	$value;
				$header.=   CHtml::closeTag("td");
				$header.=   CHtml::closeTag("tr");
			}	
			next($arrayAttr);
			$index = $index + 1;
		}
		$header.=   CHtml::closeTag("tbody");
		$header.=   CHtml::closeTag("table");
		return $header;
	}
	
	public function actionAjaxRefreshHeader()
	{
		$sABnzbdStatus= new SABnzbdStatus();
		$sABnzbdStatus->getStatus();
		echo CJSON::encode($sABnzbdStatus->attributes);
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
			'wsdl'=>array(
				'class'=>'CWebServiceAction',
				'classMap'=>array(
					'MovieResponse'=>'MovieResponse',  // or simply 'Post'
				),
			),		
		);
	}

	*/
}