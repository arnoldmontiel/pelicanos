<?php

$this->menu=array(
	array('label'=>'Summary', 'url'=>array('summary')),
);
?>

<h1>Summary Nzb</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nzb-summary-grid',
	'dataProvider'=>$model->searchSummary(),
	'filter'=>$model,
	'columns'=>array(	
				array(
	 				    'name'=>'id_imdb',
					    'value'=>'$data->nzb->myMovieDiscNzb->myMovieNzb->imdb',
	
				),
				array(
	 				    'name'=>'title',
					    'value'=>'$data->nzb->myMovieDiscNzb->myMovieNzb->original_title',
	
				),
				array(
	 				    'name'=>'genre',
					    'value'=>'$data->nzb->myMovieDiscNzb->name',

				),
				array(
	 				    'name'=>'year',
					    'value'=>'$data->nzb->myMovieDiscNzb->myMovieNzb->production_year',
	
				),
				array(
	 				    'name'=>'genre',
					    'value'=>'$data->nzb->myMovieDiscNzb->myMovieNzb->genre',
	
				),
				array(
	 				    'name'=>'nzb_status',
					    'value'=>'$data->nzbState->description',
	
				),
				date_sent,
				date_downloading,
				date_downloaded
			),
	));	
?>
