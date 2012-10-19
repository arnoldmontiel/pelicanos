<?php

$this->menu=array(
	array('label'=>'List Nzb Movies', 'url'=>array('index')),
	array('label'=>'List Nzb Episodes', 'url'=>array('indexEpisode')),
	array('label'=>'Manage Nzb Movies', 'url'=>array('admin')),
	array('label'=>'Manage Nzb Episodes', 'url'=>array('adminEpisode')),
);
?>

<h1>Select creation</h1>
<br>
<div >
	<div style="width:40%;float:left; display: inline-block;">
		<?php
			echo CHtml::link( CHtml::image("./images/movie.png","Automatic",array('id'=>'movie_img', 'style'=>'width: 128px;')),
				array('createAutomatic'), array('title'=>"Automatic"));
		?>
	</div>
	<div style="width:40%;float:right; display: inline-block;">
		<?php
			echo CHtml::link( CHtml::image("./images/tv.png","Manual",array('id'=>'tv_img', 'style'=>'width: 128px;')),
				array('createManual'), array('title'=>"Manual"));
		?>
	</div>
</div>