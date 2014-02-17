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
										'FileSubtitleRequest'=>'FileSubtitleRequest',
										'FileAudioRequest'=>'FileAudioRequest',
						),
					
		),
		);
	}
	
	/**
	 * Set file subtitles
	 * @param integer id (auto_ripper Id)
	 * @param string name
	 * @param FileAudioRequest[]
	 * @return bool success
	 * @soap
	 */
	public function setFileAudio($id, $name, $fileAudioRequest)
	{
		$modelAutoRipperFile = AutoRipperFile::model()->findByAttributes(array('Id_auto_ripper'=>$id, 'name'=>$name));
		if(isset($modelAutoRipperFile))	
		{
			foreach($fileAudioRequest as $item)
			{
				$modelAudioTrack = AudioTrack::model()->findByAttributes(array('language'=>$item->language,
															'short_language'=>$item->short_language,
															'type'=>$item->type,
															'short_type'=>$item->short_type,
															'type_extra'=>$item->type_extra,));
				if(!isset($modelAudioTrack))
				{
					$modelAudioTrack = new AudioTrack();
					$modelAudioTrack->language = $item->language;
					$modelAudioTrack->short_language = $item->short_language;
					$modelAudioTrack->type = $item->type;
					$modelAudioTrack->short_type = $item->short_type;
					$modelAudioTrack->type_extra = $item->type_extra;
					$modelAudioTrack->save();
				}
				$modelFileAudio = AutoRipperFileAudioTrack::model()->findByAttributes(array('Id_audio_track'=>$modelAudioTrack->Id,
																							'Id_auto_ripper_file'=>$modelAutoRipperFile->Id));
				
				if(!isset($modelFileAudio))	
				{
					$modelFileAudio = new AutoRipperFileAudioTrack();
					$modelFileAudio->Id_audio_track = $modelAudioTrack->Id;
					$modelFileAudio->Id_auto_ripper_file = $modelAutoRipperFile->Id;
					$modelFileAudio->save();
				}
				
			}
		}
		return false;
	}
	
	/**
	 * Set file subtitles	 
	 * @param integer id (auto_ripper Id)
	 * @param string label
	 * @param FileSubtitleRequest[]
	 * @return bool success
	 * @soap
	 */
	public function setFileSubtitle($id, $label, $fileSubtitleRequest)
	{
		$modelAutoRipperFile = AutoRipperFile::model()->findByAttributes(array('Id_auto_ripper'=>$id, 'name'=>$name));
		if(isset($modelAutoRipperFile))	
		{
			foreach($fileSubtitleRequest as $item)
			{
				$modelSubtitle = Subtitle::model()->findByAttributes(array('language'=>$item->language,
																				'short_language'=>$item->short_language,
																				'type'=>$item->type,
																				'description'=>$item->description,));
				if(!isset($modelSubtitle))
				{
					$modelSubtitle = new AudioTrack();
					$modelSubtitle->language = $item->language;
					$modelSubtitle->short_language = $item->short_language;
					$modelSubtitle->type = $item->type;
					$modelSubtitle->description = $item->description;
					$modelSubtitle->save();
				}
				$modelFileSubtitle = AutoRipperFileSubtitle::model()->findByAttributes(array('Id_subtitle'=>$modelSubtitle->Id,
																						'Id_auto_ripper_file'=>$modelAutoRipperFile->Id));
					
				if(!isset($modelFileSubtitle))
				{
					$modelFileSubtitle = new AutoRipperFileSubtitle();
					$modelFileSubtitle->Id_subtitle = $modelSubtitle->Id;
					$modelFileSubtitle->Id_auto_ripper_file = $modelAutoRipperFile->Id;
					$modelFileSubtitle->save();
				}
					
			}
		}
		return false;
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
				
				if($idState == 18 && $modelAutoRipper->has_error == 0) //SOLO SI ES 18 y no hubo errores creo el NZB y sus dependencias
				{
					AutoRipperHelper::generateNzbs($id);
					AutoRipperHelper::findVideoInfo($id);
				}
				
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
	 * Get New Name by idProcess
	 * @param string idProcess
	 * @param string label
	 * @param integer size
	 * @return string name
	 * @soap
	 */
	public function getNewName($idProcess, $label, $size)
	{
		$name = '';
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.Id_auto_ripper_state <> 18');
		$criteria->addCondition('t.Id_auto_ripper_process = "'.$idProcess.'"');
		$modelAutoRipper = AutoRipper::model()->find($criteria);
			
		if(isset($modelAutoRipper))
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.label like "'.$label.'"');
			$criteria->addCondition('t.Id_auto_ripper = "'.$modelAutoRipper->Id.'"');
			$modelAutoRipperFile = AutoRipperFile::model()->find($criteria);
			
			if(!isset($modelAutoRipperFile))
			{
				$modelAutoRipperFile = new AutoRipperFile();
				$modelAutoRipperFile->Id_auto_ripper = $modelAutoRipper->Id;
				$modelAutoRipperFile->label = $label;
				$modelAutoRipperFile->size = $size;
				$modelAutoRipperFile->name = uniqid();
				$modelAutoRipperFile->save();
			}
			
			$name = $modelAutoRipperFile->name;
			
		}
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
						'retry_upload'=>9,
						'create_mkv'=>10
						);
				
		if(isset($model))
		{
			$criteria = new CDbCriteria();
			$criteria->addCondition('t.Id_auto_ripper_state <> 18');			
			$criteria->addCondition('t.Id_auto_ripper_process = "'.$idProcess.'"');
			$modelAutoRipper = AutoRipper::model()->find($criteria);
			
			if(isset($modelAutoRipper))
			{
				$response->id_auto_ripper = $modelAutoRipper->Id;
				
				switch($modelAutoRipper->Id_auto_ripper_state)
				{				
// 					case '1':
// 						$nextStep = $steps['create_7zip'];
// 						break;
					case '1':
						$nextStep = $steps['create_mkv'];
						break;				
					case '23':case '25':	 //creando y error mkv
						$nextStep = self::getStepOnError($modelAutoRipper->Id, $modelAutoRipper->Id_auto_ripper_state, $steps['init']);
						if($nextStep == 0)
						{
							$nextStep = $steps['create_mkv'];
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
					case '24':
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
	* @param string discLabel
	* @return integer id (auto_ripper table autogenerated Id)
	* @soap
	*/
	public function ripperStart($idDisc, $idProcess, $discLabel)
	{
		
		$autoRipperId = 0;
		$modelAutoRipperProcess = AutoRipperProcess::model()->findByPk($idProcess);
		if(isset($modelAutoRipperProcess) && !empty($idDisc))
		{
			$modelAutoRipperDB = AutoRipper::model()->findByAttributes(array('Id_disc'=>$idDisc, 
																			'Id_auto_ripper_state'=>18, 
																			'has_error'=>0, 
																			'Id_auto_ripper_process'=>$idProcess));
			if(!isset($modelAutoRipperDB))
			{
				$modelAutoRipper = new AutoRipper();
				$modelAutoRipper->Id_disc = $idDisc;
				$modelAutoRipper->Id_auto_ripper_process = $idProcess;
				$modelAutoRipper->Id_auto_ripper_state = 1; //Iniciando
				$modelAutoRipper->name = str_replace('_', ' ', $discLabel);
				$modelAutoRipper->save();
				
				$autoRipperId = $modelAutoRipper->Id;
				
				$autoRipperState = new AutoRipperAutoRipperState();
				$autoRipperState->Id_auto_ripper = $autoRipperId;
				$autoRipperState->Id_auto_ripper_state = 1;			
				$autoRipperState->save();
			}
			
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
