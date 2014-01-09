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
                   <td>Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="yeardropdown" name="yeardropdown"></select> 
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


<script type="text/javascript">

/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/

//var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];

function populatedropdown(yearfield){
var today=new Date()
var yearfield=document.getElementById(yearfield);
var thisyear=today.getFullYear();
for (var y=0; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}

</script>
<!--<i class="note">* Just a simple note here ...</i>-->


<script type="text/javascript">

//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
window.onload=function(){
populatedropdown("yeardropdown")
}
</script>