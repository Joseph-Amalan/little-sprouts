<div class="title title-spacing">
        <h2>Export Data from Database</h2>        
</div>

<?php 

	if($this->session->flashdata('success_message')) : 
		echo '<div class="success">';
		echo $this->session->flashdata('success_message');
		echo '</div>';
	endif;

	if($this->session->flashdata('error_message')) : 
		echo '<div class="error">';
		echo $this->session->flashdata('error_message');
		echo '</div>';
	endif;	
?>  

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
        <div class="portlet-header ui-widget-header">Export Student Data</div>
        <div class="portlet-content">
                <?php		
                $attributes = array('id' => 'export_data','name' => 'export_data','class' => 'forms', 'enctype'=>'multipart/form-data'); 
                echo form_open('admin_area/export_data/index', $attributes); 
                ?> 
				<ul>
					<li>
						<div>
                                                   
					<ul>
						
								
                                                                <input type="text" tabindex="1" size="40"  name="export_data"  value="Student Details" readonly/>
<!--								<span class="red">Error message example ...</span>-->
						
						
						<li class="buttons">
							<button class="ui-state-default ui-corner-all" id="saveForm" name="saveForm"><span style='color:green;'>Export Student Data</span></button>
						</li>
					</ul>
				
                                   
						</div>
					</li>
					
				</ul>
                <?php echo form_close(); ?>
        </div>
</div>
<div class="clearfix"></div>
<?php
//print_r($detail);
/**/
?>
<?php
if(isset($detail)){
   /* header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");*/?>
<table border='1'>
<tr>
<td>ID</td>
<td>First Name</td>
<td>Last Name</td>
<td>Date of Birth</td>

<td>Class Name</td>
<td>School Name</td>
<td>Enrollment Status Date</td>
<td>Enrollment Status</td>

<td>Teacher1_Last Name</td>
<td>Teacher1_First Name</td>
<td>Teacher2_Last Name</td>
<td>Teacher2_First Name</td>

<td>Teacher3_Last Name</td>
<td>Teacher3_First Name</td>
<td>TOPEL_Test Date</td>
<td>TOPEL-PKSS</td>


<td>TOPEL-DVSS</td>
<td>TOPEL-PASS</td>
<td>TOPEL-EL Index</td>
<td>TOPEL_Not Tested Reason</td>


<td>TOPEL_Administrator</td>
<td>TOPEL_Notes</td>
<td>PALS-Test Date</td>
<td>PALS-Upper</td>

<td>PALS-Lower</td>
<td>PALS-Letter Sounds</td>
<td>PALS_Not Tested Reason</td>
<td>PALS_Administrator</td>

<td>PALS_Notes</td>
</tr>

<?
foreach($detail as $item) {
?>
<tr>
<td><?=$item['child_id']?></td>
<td><?=$item['first_name']?></td>
<td><?=$item['last_name']?></td>
<td><?=$item['date_of_birth']?></td>

<td><?=$item['primary_classroom']?></td>
<td><?=$item['school_name']?></td>
<td><?=$item['status_date']?></td>
<td><?=$item['enrollment_status']?></td>


<td><?=$item['administrator']?></td>
<td><?=$item['administrator']?></td>
<td><?=$item['administrator']?></td>
<td><?=$item['administrator']?></td>

<td><?=$item['administrator']?></td>
<td><?=$item['administrator']?></td>
<td><?=$item['test_date_first']?></td>
<td><?=$item['topel_pkss']?></td>

<td><?=$item['topel_dvss']?></td>
<td><?=$item['topel_pass']?></td>
<td><?=$item['topel_elindex']?></td>
<td><?=$item['not_tested_reason_first']?></td>

<td><?=$item['administrator']?></td>
<td><?=$item['notes_first']?></td>
<td><?=$item['test_date_second']?></td>
<td><?=$item['pals_upper']?></td>

<td><?=$item['pals_lower']?></td>
<td><?=$item['pals_letter_sounds']?></td>
<td><?=$item['not_tested_reason_second']?></td>
<td><?=$item['administrator_second']?></td>

<td><?=$item['notes_second']?></td>

</tr>
<? } ?>
<?php }?>
</table>


