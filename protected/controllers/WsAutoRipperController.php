<?php

class WsAutoRipperController extends Controller
{

	public function actions()
	{
		return array(
		            'wsdl'=>array(
		                'class'=>'CWebServiceAction',
						'classMap'=>array(
					                    'NextStepResponse'=>'NextStepResponse',
						),
					
		),
		);
	}
	
	
	/**
	* Set current ripper state
	* @param integer id (auto_ripper Id)
	* @param integer idState
	* @param string description
	* @return bool success
	* @soap
	*/
	public function setState($id, $idState, $description)
	{
		$modelAutoRipper = AutoRipper::model()->findByPk($id);
		
		if(isset($modelAutoRipper))
		{
			try {
							
				$modelAutoRipper->Id_auto_ripper_state = $idState;
				$modelAutoRipper->save();
				
				$autoRipperState = new AutoRipperAutoRipperState();
				$autoRipperState->Id_auto_ripper = $id;
				$autoRipperState->Id_auto_ripper_state = $idState;				
				$autoRipperState->description = $description;
				$autoRipperState->save();
				
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
		return false;
	}
	
	/**
	* Create the Auto Ripper process and return the name
	* @return string name
	* @soap
	*/
	public function getProcessName()
	{
		$name = '';
		$model = new AutoRipperProcess();
		$model->Id = uniqid();
		if($model->save())
			$name = $model->Id;
			
		return $name;
	}
	
	/**
	* Get Next Step by idProcess
	* @param string idProcess
	* @return NextStepResponse response
	* @soap
	*/
	public function getNextStep($idProcess)
	{
		$nextStep = 0;
		$response = new NextStepResponse();
		$model = AutoRipperProcess::model()->findByPk($idProcess);
		
		$steps = array('init'=>1,
						'create_7zip'=>2,
						'create_rar'=>3,
						'create_par2'=>4,
						'upload_usenet'=>5,
						'upload_nzb'=>6,
						'delete_files'=>7,
						'eject_disc'=>8,
						'retry_upload'=>9
						);
				
		if(isset($model))
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.Id_auto_ripper_state <> 18');			
			$criteria->addCondition('t.Id_auto_ripper_process = "'.$idProcess.'"');
			$modelAutoRipper = AutoRipper::model()->find($criteria);
			
			if(isset($modelAutoRipper))
			{
				$response->file_name = $modelAutoRipper->name;
				$response->id_auto_ripper = $modelAutoRipper->Id;
				
				switch($modelAutoRipper->Id_auto_ripper_state)
				{				
					case '1':
						$nextStep = $steps['create_7zip'];
						break;					
					case '4':case '2':	//creando y error 7zip
						$nextStep = self::getStepOnError($modelAutoRipper->Id, $modelAutoRipper->Id_auto_ripper_state, $steps['init']);
						if($nextStep == 0)
						{
							$nextStep = $steps['create_7zip'];
						}
						else 
						{	
							if($nextStep == $steps['init'])
							{
								$modelAutoRipper->Id_auto_ripper_state = 18;
								$modelAutoRipper->save();
							}
						}
						break;
					case '3':
						$nextStep = $steps['create_rar'];
						break;
					case '5':case '7':	//creando y error rar						
						$nextStep = self::getStepOnError($modelAutoRipper->Id, $modelAutoRipper->Id_auto_ripper_state, $steps['delete_files']);
						if($nextStep == 0)
							$nextStep = $steps['create_rar'];												
						break;
					case '6':
						$nextStep = $steps['create_par2'];
						break;
					case '8':case '10':	 //creando y error par2
						$nextStep = self::getStepOnError($modelAutoRipper->Id, $modelAutoRipper->Id_auto_ripper_state, $steps['delete_files']);
						if($nextStep == 0)
							$nextStep = $steps['create_par2'];
						break;
					case '9':case '20':
					case '22':	
						$nextStep = $steps['eject_disc'];
						break;
					case '21':
						if($modelAutoRipper->has_error == 0)
							$nextStep = $steps['upload_usenet'];
						else
							$nextStep = $steps['delete_files'];
						break;
					case '11':case '13':
						$nextStep = $steps['retry_upload'];
						break;
					case '12':	
						$nextStep = $steps['upload_nzb'];
						break;
					case '14':case '16':	//subiendo y error nzb
						$nextStep = self::getStepOnError($modelAutoRipper->Id, $modelAutoRipper->Id_auto_ripper_state, $steps['delete_files']);
						if($nextStep == 0)
							$nextStep = $steps['upload_nzb'];
					case '15':
						$nextStep = $steps['delete_files'];
						break;
					case '17':case '19':  //borrando y error archivos
						$nextStep = self::getStepOnError($modelAutoRipper->Id, $modelAutoRipper->Id_auto_ripper_state, $steps['init']);
						if($nextStep == 0){
							$nextStep = $steps['delete_files'];
						}
						else 
						{								
							if($nextStep == $steps['init'])
							{
								$modelAutoRipper->Id_auto_ripper_state = 18;
								$modelAutoRipper->save();
							}
						}
						break;
				}
			}
			else
			{
				$nextStep = $steps['init'];
			}
		}		
		
		$response->next_step = $nextStep;
		
		return $response;
	}
	
	private function getStepOnError($idAutoRipper, $idAutoRipperState, $stepOnError)
	{		
		$step = 0;		
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('Id_auto_ripper = '. $idAutoRipper);
		$criteria->addCondition('Id_auto_ripper_state = '. $idAutoRipperState);
		
		$countError = AutoRipperAutoRipperState::model()->count($criteria);
		
		if($countError >= 3)
		{
			$modelAutoRipper = AutoRipper::model()->findByPk($idAutoRipper);
			
			if(isset($modelAutoRipper))
			{
				$modelAutoRipper->has_error = 1;
				$modelAutoRipper->save();
				
				$criteria = new CDbCriteria();
				$criteria->addCondition('Id_auto_ripper = '. $idAutoRipper);
				$criteria->addCondition('Id_auto_ripper_state = 21'); //expulsado
				$model = AutoRipperAutoRipperState::model()->find($criteria);
				if(isset($model))
					$step = $stepOnError;
				else
					$step = 8; //eject_disc;			
			}
		}
		
		return $step;
	}
	
	/**
	* Start ripper process
	* @param string idDisc
	* @param string idProcess	
	* @return integer id (auto_ripper table autogenerated Id)
	* @soap
	*/
	public function ripperStart($idDisc, $idProcess)
	{
		
		$autoRipperId = 0;
		$modelAutoRipperProcess = AutoRipperProcess::model()->findByPk($idProcess);
		if(isset($modelAutoRipperProcess) && !empty($idDisc))
		{
			$modelAutoRipper = new AutoRipper();
			$modelAutoRipper->Id_disc = $idDisc;
			$modelAutoRipper->Id_auto_ripper_process = $idProcess;
			$modelAutoRipper->Id_auto_ripper_state = 1; //Iniciando
			$modelAutoRipper->name = uniqid();
			$modelAutoRipper->save();
			
			$autoRipperId = $modelAutoRipper->Id;
			
			$autoRipperState = new AutoRipperAutoRipperState();
			$autoRipperState->Id_auto_ripper = $autoRipperId;
			$autoRipperState->Id_auto_ripper_state = 1;			
			$autoRipperState->save();
			
		}
		
		return $autoRipperId;
	
	}
	
	/**
	* Set percentage
	* @param integer id
	* @param integer percentage
	* @return bool success
	* @soap
	*/
	public function setPercentage($id, $percentage)
	{
		$modelAutoRipper = AutoRipper::model()->findByPk($id);
		
		if(isset($modelAutoRipper))
		{
			try {

				$modelAutoRipper->percentage = $percentage;
				$modelAutoRipper->save();
				
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
		return false;
	
	}
	
}
