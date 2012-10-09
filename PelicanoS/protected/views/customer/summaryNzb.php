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
					    'value'=>'$data->nzb->myMovieMovie->imdb',
	
				),
				array(
	 				    'name'=>'title',
					    'value'=>'$data->nzb->myMovieMovie->original_title',
	
				),
				array(
	 				    'name'=>'year',
					    'value'=>'$data->nzb->myMovieMovie->production_year',
	
				),
				array(
	 				    'name'=>'genre',
					    'value'=>'$data->nzb->myMovieMovie->genre',
	
				),
				array(
	 				    'name'=>'movie_status',
					    'value'=>'$data->movieState->description',
	
				),
				date_sent,
				date_downloading,
				date_downloaded
			),
	));	
?>
