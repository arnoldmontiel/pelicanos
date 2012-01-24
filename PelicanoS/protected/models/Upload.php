<?php
class Upload extends CFormModel
{
	public $file;
	public $subt_file;
	
	public function rules()
	{
		return array(
			array('file', 'file', 'types'=>'nzb', 'allowEmpty' => true),
			array('subt_file', 'file', 'types'=>'txt', 'allowEmpty' => true),
		);
	}
}
