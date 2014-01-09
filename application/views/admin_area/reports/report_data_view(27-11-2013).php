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

/*include("inc/jqgrid_dist.php");
    $g = new jqgrid();
    // set few params
    $grid["caption"] = "Student Grid";
    $grid["multiselect"] = true;
    //$grid["export"] = array("format"=>"xlsx", "filename"=>"my-file", "sheetname"=>"test");
    //$grid["export"]["range"] = "filtered";
    $g->set_options($grid);*/


/*if(isset($schoolsname)){
    $schoolName=$schoolsname;
   include("inc/jqgrid_dist.php");
    $g = new jqgrid();
    // set few params
    $grid["caption"] = "Student Grid";
    $grid["multiselect"] = true;
    //$grid["excelExport"]=true;
    //$grid["export"] = array("format"=>"xlsx", "filename"=>"my-file", "sheetname"=>"test");
    //$grid["export"]["range"] = "filtered";
    $g->set_options($grid); 
    
      $g->select_command = "select first_name,school_name from student_details where school_name='$schoolName'" ;      
    
    $out = $g->render("list2");
    
} 


else {*/
   include("inc/jqgrid_dist.php");
    $g = new jqgrid();
    // set few params
    $grid["caption"] = "Student Grid";
    $grid["multiselect"] = true;
    // $grid["excelExport"]=true;
    //$grid["search"] = false;
   // $grid["export"] = array("format"=>"xlsx", "filename"=>"my-file", "sheetname"=>"test");
   // $grid["export"]["range"] = "filtered";
   $g->set_options($grid);
   //$g->table = "student_details";
    $g->select_command = "select first_name,last_name,date_of_birth,primary_classroom,school_name,enrollment_status,administrator from student_details" ;
  
   //$g->select_command = "select first_name as First,last_name as Last from student_details" ;
    /*/*$g->select_command = "select first_name as First,last_name as Last,date_of_birth as DateofBirth,    
primary_classroom as ClassName,school_name as SchoolName,status_date as EnrollmentStatusDate,enrollment_status as EnrollmentStatus,
administrator as Teacher1_Name,administrator as Teacher2_Name,administrator as Teacher3_Name,test_date_first as TOPEL_TestDate,
topel_pkss as TOPEL_PKSS,topel_dvss as TOPEL_DVSS,topel_pass as TOPEL_PASS,topel_elindex as TOPEL_ELIndex,
not_tested_reason_first as TOPEL_NotTestedReason,administrator as TOPEL_Administrator,notes_first as TOPEL_Notes,
test_date_second as PALSTestDate,pals_upper as PALS_Upper,pals_lower as PALS_Lower,pals_letter_sounds as PALS_LetterSounds,
not_tested_reason_second as PALS_NotTestedReason, administrator_second as PALS_Administrator,notes_second as PALS_Notes from student_details" ;*/
     
    $out = $g->render("list1");
  
//}

//print_r($g->render("list1"));

//print_r($g);
?>  
<br/> 

<div class="title">
    <h3>Reports In Grid View</h3>
</div>
<?php
//$attributes = array('id' => 'grid_data_form', 'name' => 'grid_data_form', 'class' => 'forms');
//echo form_open('admin_area/report_data/getschool_list', $attributes);
?>
<!--<div class="hastable">
    <table id="sort-table"> 
        <tr>
            <th nowrap>Select School </th>
           <th><select name="school"   id="school" >
             <option value="0">Select School</option>           
                        
            <?php    foreach($schools as $schoollist){ ?>
            <option value="<?php echo $schoollist; ?>"><?php echo $schoollist; ?></option>
            <?php } ?>

            </select></th>
           <td name="submitform" id="submitform "> 
                <button type="submit" class="ui-state-default ui-corner-all" >Submit</button>	

            </td>
        </tr>
    </table>
</div>-->
<?php //echo form_close(); ?>


<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>includes/admin_area/scripts/js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>includes/admin_area/scripts/js/jqgrid/css/ui.jqgrid.css"></link>	
	
	<script src="<?php echo base_url();?>includes/admin_area/scripts/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>includes/admin_area/scripts/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>includes/admin_area/scripts/js/jqgrid/js/jquery.jqGrid.min.js"></script>	
	<script src="<?php echo base_url();?>includes/admin_area/scripts/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
	</head>

	<body>
	
</body>
</html>-->

    <div style="margin:10px">
	<?php echo $out;?>
	</div>
