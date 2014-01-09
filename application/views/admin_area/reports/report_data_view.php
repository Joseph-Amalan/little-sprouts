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
<br/> 

<div class="title">
    <h3>Reports In Grid View</h3>
</div>
<?php
require_once("phpGrid.php");
$dg = new C_DataGrid("SELECT  first_name,last_name,  
primary_classroom,school_name,status_date,enrollment_status FROM student_details");
$dg->enable_advanced_search(true);
$dg->enable_export('EXCEL');
$dg -> display();  
?>


