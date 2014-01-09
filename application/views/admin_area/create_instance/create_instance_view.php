<div class="title title-spacing">
    <h2>Create Instance</h2>
    
</div>

<?php
if ($this->session->flashdata('success_message')) :
    echo '<div class="success">';
    echo $this->session->flashdata('success_message');
    echo '</div>';
endif;

if ($this->session->flashdata('error_message')) :
    echo '<div class="error">';
    echo $this->session->flashdata('error_message');
    echo '</div>';
endif;
?>  

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Create User</div>
    <div class="portlet-content">
        <?php
        $attributes = array('id' => 'create_instance', 'name' => 'create_instance', 'class' => 'forms');
        echo form_open('admin_area/create_instance', $attributes);
        ?> 
        <ul>
            <li>
                <div align="center">
                    <table class="gridtable"><tr>
                   <td>Instance Name  <input type="text" class="" name="instancename" id="instancename" value="<?php echo set_value('instancename'); ?>" width="20">
                     <?php echo form_error('instancename'); ?></td>
                        </tr>
                        
                     <tr>
                   <td>Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="yeardropdown" id="yeardropdown">
                                 <option value=""> Select Year </option>	
                                <?php
                                $get_year = date('Y');
                                $start = date('Y') - 10;
                                $end = date('Y') + 20;
                            // populate the select options with years 
                                for ($yr = $start; $yr <= $end; $yr++) {
                                    if ($yr == $get_year) {
                                        echo '<option value="' . $yr . '" selected="selected">' . $yr . '</option>';
                                    } else {
                                        echo ' <option value="' . $yr . '" > ' . $yr . ' </option> ';
                                    }
                                }
                                ?>	                    
                                </select> 
                     <?php echo form_error('yeardropdown'); ?></td></tr>
                     
                      <tr>
                   <td>Academic Year  <input type="text" class="" name="academic_year" id="academic_year" value="<?php echo set_value('academic_year'); ?>" width="20">
                     <?php echo form_error('academic_year'); ?></td> </tr>
                      
                     <tr>
                   <td>Term &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="" name="term" id="term" value="<?php echo set_value('term'); ?>" width="20">
                     <?php echo form_error('term'); ?></td></tr></table>
                    
                </div>
            </li>
            <li class="buttons">
                <button type="submit" class="ui-state-default ui-corner-all">Create Instance</button>	
            </li>
        </ul>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="clearfix"></div>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">


table.gridtable td {
	/*border-width: 1px;*/
	padding: 8px;
	/*border-style: solid;
	border-color: #666666;
	background-color: #ffffff;*/
}
</style>
<!-- Table goes in the document BODY -->


