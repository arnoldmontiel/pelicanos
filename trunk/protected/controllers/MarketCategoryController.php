<?php

class MarketCategoryController extends Controller
{
	public function actionIndex()
	{
		$modelMarketCategory = new  MarketCategory('search');
		$modelMarketCategory->unsetAttributes();  // clear any default values
		if(isset($_GET['MarketCategory']))
			$modelMarketCategory->attributes=$_GET['MarketCategory'];
		
		$this->render('index',array(
				'modelMarketCategory'=>$modelMarketCategory,
		));
	}
	
	public function actionAjaxOpenForm()
	{
		$id = isset($_POST['idCategory'])?$_POST['idCategory']:null;
	
		if(isset($id))
		{
			if($id == 0)
				$modelMarketCategory = new MarketCategory();
			else
				$modelMarketCategory = MarketCategory::model()->findByPk($id);
	
		}
		$criteria = new CDbCriteria();
		$criteria->order = 't.order ASC';
		$models = MarketCategory::model()->findAll($criteria);		
		if(isset($models))
		{
			foreach($models as $item)
			{
				$orderList[$item->order] = $item->order;
			}	
		}
		else
			$orderList = array('1'=>'1');
		
		echo $this->renderPartial('_modalForm', array('modelMarketCategory'=>$modelMarketCategory, 'orderList'=>$orderList));
	}
	
	public function actionAjaxSaveCategory()
	{
		$modelMarketCategory = new MarketCategory();
	
		if(isset($_POST['MarketCategory']))
		{
			$isUpdate = false;
			if(isset($_POST['MarketCategory']['Id']))
			{
				$modelMarketCategory = MarketCategory::model()->findByPk($_POST['MarketCategory']['Id']);
				$oldOrder = $modelMarketCategory->order;
				$isUpdate = true;
			}
			
			$modelMarketCategory->attributes = $_POST['MarketCategory'];
			
			if($isUpdate)
			{
				if($modelMarketCategory->order == 0)
				{
					$order = 1;
					$criteria = new CDbCriteria();
					$criteria->order = 't.order DESC';
					$model = MarketCategory::model()->find($criteria);
					if(isset($model))
						$order = $model->order;
				
					$modelMarketCategory->order = $order;
				
				}
				
				if($oldOrder > $modelMarketCategory->order)
				{
					$criteria = new CDbCriteria();
					$criteria->addCondition('t.order >= '.$modelMarketCategory->order);
					$criteria->addCondition('t.order < '.$oldOrder);
					$criteria->order = 't.order ASC';
					$models = MarketCategory::model()->findAll($criteria);
						
					foreach($models as $item)
					{
						$item->order = $item->order + 1;
						$item->save();
					}
				}
				else 
				{					
					$criteria = new CDbCriteria();
					$criteria->addCondition('t.order > '.$oldOrder);
					$criteria->addCondition('t.order <= '.$modelMarketCategory->order);
					$criteria->order = 't.order DESC';
					$models = MarketCategory::model()->findAll($criteria);
						
					foreach($models as $item)
					{
						$item->order = $item->order - 1;
						$item->save();
					}
				}
			}
			else 
			{
				if($modelMarketCategory->order == 0)
				{
					$order = 1;
					$criteria = new CDbCriteria();
					$criteria->order = 't.order DESC';
					$model = MarketCategory::model()->find($criteria);
					if(isset($model))
						$order = $model->order + 1;
				
					$modelMarketCategory->order = $order;
				}
				else 
				{
					$criteria = new CDbCriteria();
					$criteria->addCondition('t.order >= '.$modelMarketCategory->order);
					$criteria->order = 't.order ASC';
					$models = MarketCategory::model()->findAll($criteria);
					
					foreach($models as $item)
					{
						$item->order = $item->order + 1; 
						$item->save();
					}
				}
			}
				
			if($modelMarketCategory->save())
				self::updateNzbDeviceRelation($modelMarketCategory->Id);
						
		}
	}
	
	public function actionAjaxDelete()
	{
		$id = isset($_POST['idCategory'])?$_POST['idCategory']:null;
	
		$modelMarketCategory = MarketCategory::model()->findByPk($id);
	
		if(isset($modelMarketCategory))
		{
			$transaction = $modelMarketCategory->dbConnection->beginTransaction();
			try {
				
				$criteria = new CDbCriteria();
				$criteria->addCondition('t.order > '.$modelMarketCategory->order);
				$criteria->order = 't.order ASC';
				$models = MarketCategory::model()->findAll($criteria);
					
				foreach($models as $item)
				{
					$item->order = $item->order - 1;
					$item->save();
				}
				self::updateNzbDeviceRelation($id);
				MarketCategoryNzb::model()->deleteAllByAttributes(array('Id_market_category'=>$id));
				$modelMarketCategory->delete();
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
			}
		}
	}
	
	private function updateNzbDeviceRelation($id)
	{
		$criteria = new CDbCriteria();
		$criteria->join = 'inner join market_category_nzb n on (n.Id_nzb = t.Id_nzb)';
		$criteria->addCondition('n.Id_market_category = '.$id);		
		
		$modelRelation = NzbDevice::model()->findAll($criteria);
	
		if(!empty($modelRelation) )
		{
			foreach ($modelRelation as $modelRel){
				$modelRel->need_update = 1;
				$modelRel->save();
			}
		}
	}
}