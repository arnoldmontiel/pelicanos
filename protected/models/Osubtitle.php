<?php
class Osubtitle extends CFormModel
{
	private $_attributes = array();
	
	
	/**
	* Constructor.
	* @param  $model the model instance
	*/
	public function __construct()
	{
		$this->_attributes['query'] = "";
		$this->_attributes['idImdb'] = "";
		$this->_attributes['movieHash'] = "";
		$this->_attributes['movieSize'] = "";
		$this->_attributes['language'] = "";
		$this->_attributes['season'] = "";
		$this->_attributes['episode'] = "";
	}
	/**
	* PHP getter magic method.
	* This method is overridden so that AR attributes can be accessed like properties.
	* @param string $name property name
	* @return mixed property value
	* @see getAttribute
	*/
	public function __get($name)
	{
		if(isset($this->_attributes[$name]))
			return $this->_attributes[$name];
		return parent::__get($name);
	}
	
	/**
	 * PHP setter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @param mixed $value property value
	 */
	public function __set($name,$value)
	{
		if($this->setAttribute($name,$value)===false)
		{
			parent::__set($name,$value);
		}
	}
	/**
	 * Sets the named attribute value.
	 * You may also use $this->AttributeName to set the attribute value.
	 * @param string $name the attribute name
	 * @param mixed $value the attribute value.
	 * @return boolean whether the attribute exists and the assignment is conducted successfully
	 * @see hasAttribute
	 */
	public function setAttribute($name,$value)
	{
		if(property_exists($this,$name))
			$this->$name=$value;
		else if($name == "attributes"){
			foreach ($value as $item)
			{
				$this->_attributes[ key($value) ] = $item;
				next($value);
			}
		}
		else
			return false;
		return true;
	}
	
	/**
	* Checks if a property value is null.
	* This method overrides the parent implementation by checking
	* if the named attribute is null or not.
	* @param string $name the property name or the event name
	* @return boolean whether the property value is null
	*/
	public function __isset($name)
	{
		if(isset($this->_attributes[$name]))
			return true;
		else
			return parent::__isset($name);
	}
	
	static public function downloadSubtitle($idSubtitleFile)
	{
		require_once 'ripcord.php';
		$client = ripcord::client('http://api.opensubtitles.org/xml-rpc');
	
		//open OpenSource API connection
		$token_from_login = $client->LogIn('pelicanosys','Pelicano','','Pelicano User Agent');
	
		$arrResponse = $client->DownloadSubtitles($token_from_login['token'], array($idSubtitleFile));
		
	
		//close OpenSource API connection
		$client->LogOut($token_from_login['token']);
	
		return $arrResponse['data'][0]['data'];
	}
	/**
	* The function that actually sends an XML-RPC request to the server, handles
	* errors accordingly and returns the appropriately decoded data sent as response
	* from the server.
	*
	* @param XML_RPC_Message $request An appropriately encoded XML-RPC message
	*                                  that needs to be sent as a request to the
	*                                  server.
	* @param XML_RPC_Client  $client  The XML-RPC client as which the request
	*                                  is to be sent.
	*
	* @return Array The appropriately decoded response sent by the server.
	*/
	public static function sendRequest($request, $client)
	{
		$response = $client->send($request);
		if (!$response) {
			throw new CHttpException(
		                'XML-RPC communication error: ' . $client->errstr
			);
		} else if ($response->faultCode() != 0) {
			throw new CHttpException(
			$response->faultString()." ".$response->faultCode()
			);
		}
	
		$value = XML_RPC_Decode($response->value());
		if (!is_array($value) || !isset($value['faultCode'])) {
			return $value;
		} else {
			throw new CHttpException(
			$value['faultString']." ".$value['faultCode']
			);
		}
	}
	public function searchSubtitle()
	{
		$rpc_client = new XML_RPC_Client(
		'/xml-rpc',
		'http://api.opensubtitles.org'
		);
		$username = new XML_RPC_Value('pelicanosys', 'string');
		$password = new XML_RPC_Value('Pelicano', 'string');
		$language = new XML_RPC_Value('', 'string');
		$useragent = new XML_RPC_Value('Pelicano User Agent', 'string');
		
		$request = new XML_RPC_Message(
		            'LogIn',
		array($username,$password,$language,$useragent
		)
		);
		$response = Osubtitle::sendRequest($request, $rpc_client);
		

		$token = new XML_RPC_Value($response['token'], 'string');
		$get = array();
		
		if(!(empty($this->movieHash) && empty($this->movieSize))) {
			$sublanguageid = new XML_RPC_Value($this->getLanguageFilter(), 'string');
			$season = new XML_RPC_Value($this->season, 'string');
			$episode = new XML_RPC_Value($this->episode, 'string');
			$moviehash = new XML_RPC_Value($this->movieHash, 'string');
			$moviesize = new XML_RPC_Value($this->movieSize, 'string');

			$paramStruct = new XML_RPC_Value(
				array('sublanguageid'=>$sublanguageid,
					'season'=>$season,
					'episode'=>$episode,
					'moviehash'=>$moviehash,
					'moviebytesize'=>$moviesize),
							'struct');
			$paramArray =new XML_RPC_Value(array($paramStruct),'array');

			$request = new XML_RPC_Message('SearchSubtitles',array($token,$paramArray));

			$get = Osubtitle::sendRequest($request, $rpc_client);
		} elseif (!empty($this->idImdb) ) {
			$sublanguageid = new XML_RPC_Value($this->getLanguageFilter(), 'string');
			$season = new XML_RPC_Value($this->season, 'string');
			$episode = new XML_RPC_Value($this->episode, 'string');
			$imdbid = new XML_RPC_Value($this->idImdb, 'string');
			$paramStruct = new XML_RPC_Value(
				array('sublanguageid'=>$sublanguageid,
					'season'=>$season,
					'episode'=>$episode,
					'imdbid'=>$imdbid),
				'struct');
			$paramArray =new XML_RPC_Value(array($paramStruct),'array');

			$request = new XML_RPC_Message('SearchSubtitles',array($token,$paramArray));

			$get = Osubtitle::sendRequest($request, $rpc_client);
		} elseif (!empty($this->query)) {
			$sublanguageid = new XML_RPC_Value($this->getLanguageFilter(), 'string');
			$season = new XML_RPC_Value($this->season, 'string');
			$episode = new XML_RPC_Value($this->episode, 'string');
			$query = new XML_RPC_Value($this->query, 'string');
			$paramStruct = new XML_RPC_Value(
				array('sublanguageid'=>$sublanguageid,
					'season'=>$season,
					'episode'=>$episode,
					'query'=>$query),
				'struct');
			$paramArray =new XML_RPC_Value(array($paramStruct),'array');

			$request = new XML_RPC_Message('SearchSubtitles',array($token,$paramArray));

			$get = Osubtitle::sendRequest($request, $rpc_client);
			
		} else {
			$get = null;
		}
		
		$this->saveSubtitles($get);
		
		$request = new XML_RPC_Message('LogOut',array($token));
			
		Osubtitle::sendRequest($request, $rpc_client);
	}
	
	private function getLanguageFilter()
	{
		$languageFilter = 'all';
		if(!empty($this->language))
			$languageFilter = implode(',',$this->language);
		
		return $languageFilter;	
	}
	
	private function saveSubtitles($searchSubtitles)
	{

		if($searchSubtitles!= null)
		{
			OpenSubtitle::model()->deleteAllByAttributes(array('Id_user'=>Yii::app()->user->id));
			if($searchSubtitles['data']){
				$sql = '';
				$regCount = 0;
				foreach ($searchSubtitles['data'] as $item)
				{
					$sql = 'INSERT INTO open_subtitle (Id_user, IDSubtitleFile, SubFileName, ZipDownloadLink, SubtitlesLink, MovieNameEng, MovieName, MovieByteSize, SeriesSeason, SeriesEpisode, LanguageName)
												 VALUES ("' . Yii::app()->user->id.
															'", "' . $item['IDSubtitleFile'] .
												 			'", "' . $item['SubFileName'] . 
															'", "' . $item['ZipDownloadLink'].
															'", "' . addslashes($item['SubtitlesLink']).
															'", "' . addslashes($item['MovieNameEng']).
															'", "' . addslashes($item['MovieName']).
															'", "' . $item['MovieByteSize'].
															'", "' . $item['SeriesSeason'].
															'", "' . $item['SeriesEpisode'].
															'", "' . $item['LanguageName']. '");';
					$command = Yii::app()->db->createCommand($sql);
					$command->execute();
					
					$regCount++;
					if($regCount > 50)
						return true;
				}
			}
		}
	}
}
