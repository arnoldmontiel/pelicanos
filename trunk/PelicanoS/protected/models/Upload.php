<?php	
class Upload extends CFormModel
{
	public $file;
	
	public function rules()
	{
		return array(
			array('file', 'file', 'types'=>'nzb,srt'),
		);
	}
}