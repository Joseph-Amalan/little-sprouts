<?php //$this->admin_template->add_js('includes/admin_area/scripts/jquery-min.js'); ?>
<?php //$this->admin_template->add_js('includes/admin_area/scripts/jquery.livequery.min.js'); ?>
<script type="text/javascript">

    // <![CDATA[
    /*$(document).ready(function() {
        jQuery('#school').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#preclasses > option").remove(); //first of all clear select items
            var school_id = $('#school').val();
            // alert(school_id);// here we are taking country id of the selected one.
            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/getclass_list/" + school_id);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "admin_area/export_data/getclass_list/" + school_id, //here we are calling our user controller and get_cities method with the country_id

                success: function(preclasses) //we're calling the response json array 'cities'
                {
                    jQuery.each(preclasses, function(id, preclass) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {

                        var opt = $('<option />'); // here we're creating a new select option with for each city
                        opt.val(id);
                        opt.text(preclass);
                        jQuery('#preclasses').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                }

            });


        });
        jQuery('#preclasses').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#students1 > option").remove(); //first of all clear select items
            var school_id = $('#school').val();
            var preclass_id = $('#preclasses').val();

            // alert("<?php echo base_url(); ?>" + "admin_area/data_entry/getstudent_list/" + school_id + '/' +  preclass_id);
            jQuery.ajax({
                type: "POST",
                //url: "<?php echo base_url(); ?>" + "admin_area/data_entry/getstudent_list/" + 'school_id=' + school_id + 'preclasses_id=' +  preclass_id, //here we are calling our user controller and get_cities method with the country_id
                url: "<?php echo base_url(); ?>" + "admin_area/export_data/getstudent_list/" + school_id + '/' + preclass_id, //here we are calling our user controller and get_cities method with the country_id
                //data: login_data,
                success: function(students1) //we're calling the response json array 'cities'
                {
                    jQuery.each(students1, function(id, students) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {
                        var opt = $('<option />'); // here we're creating a new select option with for each city
                        opt.val(id);
                        opt.text(students);
                        jQuery('#students1').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                }

            });


        });
    });*/
    // ]]>
</script>
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
               echo form_open('admin_area/export_data/export_data_form_submit', $attributes); 
                ?> 
				
            
            <div class="hastable">
<!--    <table id="sort-table"> 
        <tr>        -->
                       
<!--            <th nowrap>Select School </th>
             <th > <?php $schools['#'] = 'Please Select School'; ?>
                <?php echo form_dropdown('school_id', $schools, '#', 'id="school"'); ?>
                <?php /* if (!empty($search_student_data)) {foreach ($search_student_data as $item):?>
                  <option value="<?php echo $item->school_name;?>"  <?php if($this->session->userdata('school_id') == $item->school_name){ echo 'selected';}?> ><?php echo $item->school_name;?></option>
                  <?php endforeach;} */ ?>
            </th> 
            <th  nowrap>Select Class </th>
            <th > <?php $preclasses['#'] = 'Please Select Class'; ?>
                <?php echo form_dropdown('preclass_id', $preclasses, '#', 'id="preclasses"'); ?>

                -->
                 <li>Instance List
            <select name="selectinstance_name"  id="selectinstance_name" >
                                <option value="0" selected="selected">Select File</option>
                                <?php                                
                                foreach ($instances as $instance) {
                                    
                                        ?>
                                        <option value="<?php echo $instance->instance_id; ?>"><?php echo $instance->instance_name; ?></option>
                                    <?php
                                } ?>
                            </select>
                             <?php echo form_error('selectinstance_name'); ?>
            </li>
<!--            <th  nowrap>Show Status</th>
            <th > <?php $status1['#'] = 'Please Select Status'; ?>
                <?php echo form_dropdown('status_id', $status1, '#', 'id="status"'); ?>
-->

          <li class="buttons">
               <button class="ui-state-default ui-corner-all" id="saveForm" name="saveForm">Export</button></li>
          
            
<!--                <li class="buttons">
							<button class="ui-state-default ui-corner-all" id="saveForm" name="saveForm"><span style='color:green;'>Export Student Data</span></button>
						</li>-->

<!--            </td>-->

        </tr>

    </table>


</div>
            
<!--            <ul>
					<li>
						<div>
                                                    
                                                    
                                                    
                                                    
                                                   
					<ul>
						
                                             
								
                                                                <input type="text" tabindex="1" size="40"  name="export_data"  value="Student Details" readonly/>
								<span class="red">Error message example ...</span>
						
						
						<li class="buttons">
							<button class="ui-state-default ui-corner-all" id="saveForm" name="saveForm"><span style='color:green;'>Export Student Data</span></button>
						</li>
					</ul>
				
                                   
						</div>
					</li>
					
				</ul>-->
                <?php echo form_close(); ?>
        </div>
</div>

<div class="clearfix"></div>
<?php
//print_r($detail);
/**/
?>



