


<script type="text/javascript">
<!-- Setup the ligbulb after menu title-->
$(document).ready(function(){
	$(".home").removeClass("active");
	$(".websites").addClass("active");

});


</script>


<?php
/* @var $this WebsiteController */
/* @var $dataProvider CActiveDataProvider */

/*$this->breadcrumbs=array(
	'Websites',
);

$this->menu=array(
	array('label'=>'Create Website', 'url'=>array('create')),
	array('label'=>'Manage Website', 'url'=>array('admin')),
);*/
?>

<h1>Websites</h1>

<div class="grid_4">
                        	<div class="da-panel collapsible">
                            	<div class="da-panel-header">
                                	<span class="da-panel-title">
                                        <img src="images/icons/black/16/list.png" alt="" />
                                        Data Table with Numbered Pagination
                                    </span>
                                    
                                </div>
                                <div class="da-panel-content">
                                    <table id="da-ex-datatable-numberpaging" class="da-table">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Label</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach($websites->getData() as $website){
                                        	echo '<tr>';
                                        	echo '<td>'.$website->id_website.'</td>';
                                        	echo '<td>'.$website->label_website.'</td>';
                                        	echo '</tr>';
                                        	
                                        }
                                        ?>
                                      
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

	
	
	
	
	
	
	
	
