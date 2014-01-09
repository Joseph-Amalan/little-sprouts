<?php //$this->template->add_js('includes/admin_area/scripts/jquery-min.js'); ?>

<script type="text/javascript">

    // <![CDATA[
    $(document).ready(function() {
        jQuery('#school').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#preclasses > option").remove(); //first of all clear select items
            var school_id = $('#school').val();
            // alert(school_id);// here we are taking country id of the selected one.
            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/getclass_list/" + school_id);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/getclass_list/" + school_id, //here we are calling our user controller and get_cities method with the country_id

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
                url: "<?php echo base_url(); ?>" + "admin_area/data_entry/getstudent_list/" + school_id + '/' + preclass_id, //here we are calling our user controller and get_cities method with the country_id
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
    });
    // ]]>
</script>
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
    <h3>Assessment Data Entry Portal</h3>
</div>
<?php
$attributes = array('id' => 'data_entry_form', 'name' => 'data_entry_form', 'class' => 'forms');
echo form_open('staff/data_entry/data_entry_form_submit', $attributes);
?>

<div class="hastable">
    <table id="sort-table"> 
        <tr><th colspan="4" >&nbsp;</th>
            <th width="7%" >&nbsp;</th>
            <th width="12%" >First Name</th>
            <th width="13%" >Last Name</th>
            <th colspan="2" nowrap>Test Administrator (Y/N)?</th>
            <td rowspan ="5">
        <li class="buttons">
            <button type="submit" class="ui-state-default ui-corner-all">Search</button>	
        </li>
        </td></tr>
        <tr>


            <th colspan="4" >&nbsp;</th>
            <th width="7%" nowrap>Teacher #1</th>
            <th width="12%" ><input name="text73" type="text" class="input-medium" value="Becca" ></th>
            <th width="13%" ><input name="text72" type="text" class="input-medium" value="Norcross" ></th>
            <th width="2%" >&nbsp;</th>
            <th width="15%" ><input type="radio" id="userIpStatus" name="userIpStatus" value="Block" class="radiobtn"  align="center"> </input></th>
        </tr>
        <tr>
            <th nowrap>Select School </th>
            <th > <?php $schools['#'] = 'Please Select School'; ?>
                <?php echo form_dropdown('school_id', $schools, '#', 'id="school"'); ?></th> 

            <th  nowrap>Show Status</th>
            <th > <?php $status1['#'] = 'Please Select Status'; ?>
                <?php echo form_dropdown('status_id', $status1, '#', 'id="status"'); ?></th> 
            <th nowrap>Teacher #2</th>
            <th ><input name="text74" type="text" class="input-medium" value="Jane" ></th>
            <th ><input name="text76" type="text" class="input-medium" value="Smith" ></th>
            <th >&nbsp;</th>
            <th ><input type="radio" id="userIpStatus" name="userIpStatus" value="Block" class="radiobtn"  align="center"></th>
        </tr>

        <tr>
            <th  nowrap>Select Class </th>
            <th > <?php $preclasses['#'] = 'Please Select Class'; ?>
                <?php echo form_dropdown('preclass_id', $preclasses, '#', 'id="preclasses"'); ?></th>
            <th colspan="2" >&nbsp;</th>
            <th nowrap>Teacher #3</th>
            <th ><input name="text75" type="text" class="input-medium" ></th>
            <th ><input name="text77" type="text" class="input-medium" ></th>
            <th >&nbsp;</th>
            <th ><input type="radio" id="userIpStatus" name="userIpStatus" value="Block" class="radiobtn"  align="center"></th>
        </tr>



        <tr>
            <th nowrap >Student Name </th>

<!--              <th > <?php $students1['#'] = 'Please Select Student'; ?>
            <?php echo form_dropdown('student_id', $students1, '#', 'id="students1"'); ?></th>-->
            <th  colspan="9" > </th>

        </tr>





    </table>


</div>
<?php echo form_close(); ?>
<?php
$attributes = array('id' => 'data_entry_edit_form', 'name' => 'data_entry_edit_form', 'class' => 'forms');
echo form_open('staff/data_entry/data_entry_form_submit', $attributes);
?>
<div class="hastable" id="studentcontent" style="display:none;" >
    <table id="sort-table">


        <tr>

            <input name="student_get_id" type="hidden" id="student_get_id" class="input-medium" value="">
            <td colspan="2"><input name="student_name" type="text" id="student_name" class="input-medium" value=""></td>
            <th >Test Date</th>
            <th >TOPEL-PKSS</th>
            <th >TOPEL-DVSS</th>
            <th >TOPEL-PASS</th>
            <th >TOPEL-ELIndex</th>
            <th >Not Tested Reason</th>
            <th >Administrator</th>
            <th >Notes:</th>

        </tr>
        <tr>
            <th  >Date of Birth</th>
            <th ><input name="student_dob" type="text" id="student_dob" class="input-medium" value=""></th>
            <th ><input name="test_date_first" type="text" id="test_date_first" class="input-medium" value=""></th>
            <th ><input name="topel_pkss" type="text" id="topel_pkss" class="input-medium" value=""></th>
            <th ><input name="topel_dvss" type="text" id="topel_dvss" class="input-medium" value=""></th>
            <th ><input name="topel_pass" type="text" id="topel_pass" class="input-medium" value=""></th>
            <th ><input name="topel_elindex" type="text" id="topel_elindex" class="input-medium" value=""></th>
            <th ><input name="not_tested_reason_first" type="text" id="not_tested_reason_first" class="input-medium" value=""></th>
            <th ><input name="administrator" type="text" id="administrator" class="input-medium" value=""></th>
            <th ><input name="notes_first" type="text" id="notes_first" class="input-medium" value=""></th>






        </tr>
        <tr>
            <th  >Enrollment Status</th>
            <th ><input name="student_enroll_status" type="text" id="student_enroll_status" class="input-medium" value=""></th>
            <th >Test Date</th>
            <th >PALS-Upper</th>
            <th >PALS-Lower</th>
            <th >PALS-LetterSounds</th>
            <th ></th>
            <th >Not Tested Reason</th>
            <th >Administrator</th>
            <th >Notes:</th>






        </tr>
        <tr>
            <th  >Status Date</th>
            <th ><input name="status_date" type="text" id="status_date" class="input-medium" value=""></th>
            <th ><input name="test_date_second" type="text" id="test_date_second" class="input-medium" value=""></th>
            <th ><input name="pals_upper" type="text" id="pals_upper" class="input-medium" value=""></th>
            <th ><input name="pals_lower" type="text" id="pals_lower" class="input-medium" value=""></th>
            <th ><input name="pals_letter_sounds" type="text" id="pals_letter_sounds" class="input-medium" value=""></th>
            <th ><input name="topel_elindex_second" type="text" id="topel_elindex_second" class="input-medium" value=""></th>
            <th ><input name="not_tested_reason_second" type="text" id="not_tested_reason_second" class="input-medium" value=""></th>
            <th ><input name="administrator_second" type="text" id="administrator_second" class="input-medium" value=""></th>
            <th ><input name="notes_second" type="text" id="notes_second" class="input-medium" value=""></th>
        </tr>

         <tr>
            <th  colspan="10" align="rigth">
                <button type="submit" value="Submit" class="ui-state-default ui-corner-all"  name="editstudentForm" >Submit</button>
         <button type="reset" value="Reset" class="ui-state-default ui-corner-all" onclick="hidebox1('studentcontent');" >Reset</button></th>
            
        </tr>
    </table>
   
</div>
<?php echo form_close(); ?>
<div class="hastable">
    <table id="sort-table">

        <?php
        //print_r($search_student_data);
        if (!empty($search_student_data)) {
            $i = 1;
            foreach ($search_student_data as $items) {
                ?>

                <input name="stud_id"  id="row_id_<?php echo $i; ?>" type="hidden" class="input-medium" value="<?php echo $items->child_id; ?>">
                <tr id="row_id_<?php echo $i; ?>"  onclick="hidebox('studentcontent');" >

                    <th> <input name="student_name" type="text" class="input-medium" value="<?php echo ucfirst($items->first_name) . " " . ucfirst($items->last_name); ?>"></th>
                    <th ><input name="student_dob" type="text" class="input-medium" value="<?php echo $items->date_of_birth; ?>"></th>
                    <th ><input name="student_test_date_first" type="text" class="input-medium" value="<?php echo $items->test_date_first; ?>"></th>
                    <th ><input name="student_topel_pkss" type="text" class="input-medium" value="<?php echo $items->topel_pkss; ?>"></th>
                    <th ><input name="student_topel_dvss" type="text" class="input-medium" value="<?php echo $items->topel_dvss; ?>"></th>
                    <th ><input name="student_topel_pass" type="text" class="input-medium" value="<?php echo $items->topel_pass; ?>"></th>
                    <th ><input name="student_topel_index" type="text" class="input-medium" value="<?php echo $items->topel_elindex; ?>"></th>
                    <th ><input name="student_enrollment_status" type="text" class="input-medium" value="<?php echo $items->enrollment_status; ?>"></th>
                    <th ><input name="student_adminstrator" type="text" class="input-medium" value="<?php echo $items->administrator; ?>"></th>
                    <th ><input name="student_notes_first" type="text" class="input-medium" value="<?php echo $items->notes_first; ?>"></th>

                </tr>         

                <?php
                $i++;
            }
        } else {
            $i = 1;
            foreach ($get_all_student_data as $items) {
                ?>
                <input name="stud_id" id="row_id_<?php echo $i; ?>" type="hidden" class="input-medium" value="<?php echo $items->child_id; ?>">
                <tr id="row_id_<?php echo $i; ?>" onclick="hidebox('studentcontent');">
                    <th> <input name="student_name" type="text" class="input-medium" value="<?php echo ucfirst($items->first_name) . " " . ucfirst($items->last_name); ?>"></th>
                    <th ><input name="student_dob" type="text" class="input-medium" value="<?php echo $items->date_of_birth; ?>"></th>
                    <th ><input name="student_test_date_first" type="text" class="input-medium" value="<?php echo $items->test_date_first; ?>"></th>
                    <th ><input name="student_topel_pkss" type="text" class="input-medium" value="<?php echo $items->topel_pkss; ?>"></th>
                    <th ><input name="student_topel_dvss" type="text" class="input-medium" value="<?php echo $items->topel_dvss; ?>"></th>
                    <th ><input name="student_topel_pass" type="text" class="input-medium" value="<?php echo $items->topel_pass; ?>"></th>
                    <th ><input name="student_topel_index" type="text" class="input-medium" value="<?php echo $items->topel_elindex; ?>"></th>
                    <th ><input name="student_enrollment_status" type="text" class="input-medium" value="<?php echo $items->enrollment_status; ?>"></th>
                    <th ><input name="student_adminstrator" type="text" class="input-medium" value="<?php echo $items->administrator; ?>"></th>
                    <th ><input name="student_notes_first" type="text" class="input-medium" value="<?php echo $items->notes_first; ?>"></th>






                </tr>
                <?php
                $i++;
            }
        }
        ?>

    </table>


</div>


<div class="clearfix"></div>
<script type="text/javascript">
    function hidebox(id) {
        var e = document.getElementById(id);
        e.style.display = 'block';
        //e.style.display = 'none';
        /* else
         e.style.display = 'block';*/
    }
function hidebox1(id) {
        var e = document.getElementById(id);
        e.style.display = 'none';
        //e.style.display = 'none';
        /* else
         e.style.display = 'block';*/
    }
    $(function() {
        $("tr[id^='row_id']").click(function() {
            var inputval = $(this).attr("id"); //alert(inputval);
            var get_student_id = $('#' + inputval).val();
            //alert(get_student_id);

            //alert('<?php echo base_url(); ?>' + "staff/data_entry/get_student_id_list/" + get_student_id);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/get_student_id_list/" + get_student_id,
                success: function(html) {

                    if (html) {
                        var htmlSplit = html.split(';');
                        var student_get_id = htmlSplit[1];
                        jQuery('#student_get_id').val(student_get_id);
                        var student_name = htmlSplit[2] + ' ' + htmlSplit[3];
                        jQuery('#student_name').val(student_name);
                        var student_dob = htmlSplit[6];
                        jQuery('#student_dob').val(student_dob);
                        var status_date = htmlSplit[9];
                        jQuery('#status_date').val(status_date);
                        var student_enroll_status = htmlSplit[10];
                        jQuery('#student_enroll_status').val(student_enroll_status);
                        
                      
                      
                      
           
                        
                        var test_date_first = htmlSplit[12];
                        jQuery('#test_date_first').val(test_date_first);
                         var topel_pkss = htmlSplit[13];
                        jQuery('#topel_pkss').val(topel_pkss);
                         var topel_dvss = htmlSplit[14];
                        jQuery('#topel_dvss').val(topel_dvss);
                         var topel_pass = htmlSplit[15];
                        jQuery('#topel_pass').val(topel_pass);
                         var topel_elindex = htmlSplit[16];
                        jQuery('#topel_elindex').val(topel_elindex);
                         var not_tested_reason_first = htmlSplit[17];
                        jQuery('#not_tested_reason_first').val(not_tested_reason_first);
                         var administrator = htmlSplit[18];
                        jQuery('#administrator').val(administrator);
                         var notes_first = htmlSplit[19];
                        jQuery('#notes_first').val(notes_first);
                   
                         var test_date_second = htmlSplit[20];
                        jQuery('#test_date_second').val(test_date_second);
                         var pals_upper = htmlSplit[21];
                        jQuery('#pals_upper').val(pals_upper);
                         var pals_lower = htmlSplit[22];
                        jQuery('#pals_lower').val(pals_lower);
                         var pals_letter_sounds = htmlSplit[23];
                        jQuery('#pals_letter_sounds').val(pals_letter_sounds);
                         var topel_elindex_second = htmlSplit[24];
                        jQuery('#topel_elindex_second').val(topel_elindex_second);
                         var not_tested_reason_second = htmlSplit[25];
                        jQuery('#not_tested_reason_second').val(not_tested_reason_second);
                         var administrator_second = htmlSplit[26];
                        jQuery('#administrator_second').val(administrator_second);
                         var notes_second = htmlSplit[27];
                        jQuery('#notes_second').val(notes_second);
                        
                        
                        //container.html(html);
                    }

                }
            });
        });
    })

/*$(document).ready(function(){

  
  $("#data_entry_edit_form").click( 
  
    function(){
    
        var test_date_first=$("#test_date_first").val();
        var topel_pkss=$("#topel_pkss").val();
        var topel_dvss=$("#topel_dvss").val();
        alert('<?php echo base_url(); ?>' + "admin_area/data_entry/data_entry_edit_form_submit/" );
     //alert('<?php echo base_url(); ?>" + "admin_area/data_entry/data_entry_edit_form_submit/" );
        $.ajax({
        type: "POST",       
        url: "<?php echo base_url(); ?>" + "admin_area/data_entry/data_entry_edit_form_submit",
        dataType: "json",
        data: "test_date_first="+test_date_first+"&topel_pkss="+topel_pkss+"&topel_dvss="+topel_dvss,
        cache:false,
        success: 
          function(data){
            $("#studentcontent").html(data.message).css({'background-color' : data.bg_color}).fadeIn('slow'); 
          }
        
        });

      return false;

    });
  

});*/
</script>




