<?php  $this->template->add_js('includes/scripts/jquery-min.js'); ?>
<?php $this->template->add_js('includes/scripts/jquery.livequery.min.js'); ?>


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
                url: "<?php echo base_url(); ?>" + "staff/data_entry/getstudent_list/" + school_id + '/' + preclass_id, //here we are calling our user controller and get_cities method with the country_id
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
//echo form_open('admin_area/data_entry/data_entry_get_all_student', $attributes);
?>

<div class="hastable">
    <table id="sort-table"> 
        <tr>
            <th nowrap>Select School </th>
            <th > <?php $schools['#'] = 'Please Select School'; ?>
                <?php echo form_dropdown('school_id', $schools, '#', 'id="school"'); ?>
                <?php /* if (!empty($search_student_data)) {foreach ($search_student_data as $item):?>
                  <option value="<?php echo $item->school_name;?>"  <?php if($this->session->userdata('school_id') == $item->school_name){ echo 'selected';}?> ><?php echo $item->school_name;?></option>
                  <?php endforeach;} */ ?>
            </th> 
            <th  nowrap>Select Class </th>
            <th > <?php $preclasses['#'] = 'Please Select Class'; ?>
                <?php echo form_dropdown('preclass_id', $preclasses, '#', 'id="preclasses"'); ?>

            <th  nowrap>Show Status</th>
            <th > <?php $status1['#'] = 'Please Select Status'; ?>
                <?php echo form_dropdown('status_id', $status1, '#', 'id="status"'); ?>

 <th  nowrap>Instance List</th>
            <th > <select name="selectinstancename"  id="selectinstancename"  >
                    <option value="0" selected="selected">Select Instance</option>
                    <?php
                    foreach ($instances as $instance) {
                        ?>
                        <option value="<?php echo $instance->instance_id; ?>"><?php echo $instance->instance_name; ?></option>
                        <?php }
                    ?>
                </select></th>
            <td name="submitform" id="submitform "> 
                <button type="submit" class="ui-state-default ui-corner-all" >Search</button>	

            </td>

        </tr>

    </table>


</div>
<?php echo form_close(); ?>
<div class="hastable">
    <table id="sort-table">       
        <tr>
            <th width="7%" >&nbsp;</th>
            <th nowrap>First Name</th>
            <th nowrap >Last Name</th>
            <th nowrap>Test Administrator (Y/N)?</th>

        </tr>
        <tr>

            <th nowrap>Teacher #1</th>
            <th ><input name="teachername1_first" id="teachername1_first" type="text" class="input-medium" value="" ></th>
            <th ><input name="teachername1_last" id="teachername1_last" type="text" class="input-medium" value="" ></th>           
            <th ><input type="radio" id="userIpStatus_first" name="userIpStatus" value="first" class="radiobtn"  align="center" ></th>
        </tr>
        <tr>

            <th nowrap>Teacher #2</th>
            <th ><input name="teachername2_first" id="teachername2_first" type="text" class="input-medium" value="" ></th>
            <th ><input name="teachername2_last" id="teachername2_last" type="text" class="input-medium" value="" ></th>            
            <th ><input type="radio" id="userIpStatus_second" name="userIpStatus" value="second" class="radiobtn"  align="center" ></th>
        </tr>
        <tr>

            <th nowrap>Teacher #3</th>
            <th ><input name="teachername3_first" id="teachername3_first" type="text" class="input-medium" value="" ></th>
            <th ><input name="teachername3_last" id="teachername3_last" type="text" class="input-medium" value="" ></th>            
            <th ><input type="radio" id="userIpStatus_third" name="userIpStatus" value="third" class="radiobtn"  align="center" ></th>
        </tr>
		<tr>

            <th nowrap>Coach (EC) Name</th>
            <th ><input name="coachername_first" id="coachername_first" type="text" class="input-medium" value="" ></th>
            <th ><input name="coachername_last" id="coachername_last" type="text" class="input-medium" value="" ></th>            
            <th ><input type="radio" id="userIpStatus_fourth" name="userIpStatus" value="fourth" class="radiobtn"  align="center" ></th>
        </tr>
        <tr>

            <th nowrap>Director (ED) Name</th>
            <th ><input name="directorname_first" id="directorname_first" type="text" class="input-medium" value="" ></th>
            <th ><input name="directorname_last" id="directorname_last" type="text" class="input-medium" value="" ></th>            
            <th ><input type="radio" id="userIpStatus_fifth" name="userIpStatus" value="fifth" class="radiobtn"  align="center" ></th>
        </tr>

    </table>
</div>

<?php echo form_close(); ?>

<div class="hastable" >
    <?php
    $attributes = array('id' => 'data_entry_edit_form', 'name' => 'data_entry_edit_form', 'class' => 'forms');
    echo form_open('staff/data_entry/data_entry_form_submit', $attributes);
    ?>
    <table id='sort-table1'>

    </table>

    <?php echo form_close(); ?>
</div>


<div class="clearfix"></div>
<script type="text/javascript">
    function hidebox(id) {
        var e = document.getElementById(id);
        e.style.display = 'block';

    }
    function hidebox1(id) {
        var e = document.getElementById(id);
        e.style.display = 'none';

    }
   

    /*$(function() {
        $("tr[id^='row_id']").click(function() {
            var inputval = $(this).attr("id"); //alert(inputval);
            var get_student_id = $('#' + inputval).val();
            //alert(get_student_id);

            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/get_student_id_list/" + get_student_id);

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

*/


    $(function() {
        $("td[id^='submitform']").click(function() {

            var get_school_id = document.getElementById('school').value;
            var get_class_id = document.getElementById('preclasses').value;
            var get_status_id = document.getElementById('status').value;
			 var get_instance_id = document.getElementById('selectinstancename').value;
            
            if((get_school_id) == "#"){
                alert('Please Select School');
               // error++;
            }
            else if((get_class_id) == "#"){
                alert('Please Select Class');
               // error++;
            }
           else if((get_status_id) == "#"){
                alert('Please Select Status');
               // error++;
            }
			else if ((get_instance_id) == "0") {
                alert('Please Select Instance');
                // error++;
            }

            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/data_entry_get_all_student/" + "get_school_id="+get_school_id +"&get_class_id="+get_class_id);



            var dataString = 'get_school_id=' + get_school_id + '&get_class_id=' + get_class_id + '&get_status_id=' + get_status_id+ '&get_instance_id=' + get_instance_id;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/data_entry_get_all_student/",
                data: dataString,
                cache: false,
                //dataType: 'json',  
                success: function(html) {
                         if (html) {
                        $("#sort-table1").empty();
                        make_item_rows(html);
                    } 
                }


            });
            
        });

        /*$("#sort-table1 td input[id^='input_']").livequery('click',function(){
         var inputIndex = '#'+$(this).attr('id');
         var inputValue = $(inputIndex).val();
         // alert(inputValue);
         
         });*/
    });

    function make_item_rows(result_array) {


        var string_buffer = "";
        string_buffer += "<tr ><td colspan='19' align='right'>Student Details</td><td><button id ='editstudentForm' name='editstudentForm' type='submit' value='Submit' >Submit</button></td></tr>";
		string_buffer += "<tr><td>Student ID</td><td>Student Name</td><td>DOB</td><td>Enrollment Status</td><td>Status Date</td><td>TOPEL Test Date</td><td>Print Knowledge</td><td>Definitional Vocabulary</td><td>Phonological Awareness</td><td>Early Literacy Index</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td><td>PALS Test Date</td><td>Upper Case</td><td>Lower Case</td><td>Letter Sounds</td><td>Not Tested Reason</td><td>Administrator</td><td> Notes</td></tr>";


        /*string_buffer += "<tr><td>Student ID</td><td>Student Name</td><td>DOB</td><td>Test Date</td><td>TOPEL-PKSS</td><td>TOPEL-DVSS</td><td>TOPEL-PASS</td><td>TOPEL-ELIndex</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td><td>Status Date</td><td>Status Test Date</td><td>PALS-Upper</td><td>PALS-Lower</td><td>PALS-LetterSounds</td><td>Not Tested Reason</td><td>Administrator</td><td>Status Notes</td></tr>";*/

        var parseArray = jQuery.parseJSON(result_array);

        var Column = 0;
        $.each(parseArray, function(index, value) {
            string_buffer += "<tr id ='items' name='items'>";
            string_buffer += "<td><input type='text' name='input_child_id_" + index + "' id='input_child_id_" + index + "' value='" + value.child_id + "' readonly/></td>";
            string_buffer += "<td><input type='text' name='input_student_name_" + index + "' id='input_student_name_" + index + "' value='" + value.first_name + '  ' + value.last_name + "' readonly/></td>";
            string_buffer += "<td><input type='text' placeholder='yyyy-mm-dd' name='input_student_dob_" + index + "' id='input_student_dob_" + index + "' value='" + value.date_of_birth + "' readonly/></td>";
            string_buffer += "<td><input type='text' name='input_enrollment_status_" + index + "' id='input_enrollment_status_" + index + "' value='" + value.enrollment_status + "' readonly/></td>";
            string_buffer += "<td><input type='text' placeholder='yyyy-mm-dd' name='input_status_date_" + index + "' id='input_status_date_" + index + "' value='" + value.status_date + "' readonly/></td>";


            string_buffer += "<td><input type='text' placeholder='yyyy-mm-dd' name='input_test_date_first_" + index + "' id='input_test_date_first_" + index + "' value='" + value.test_date_first + "' /></td>";
            string_buffer += "<td><input type='text' name='input_topel_pkss_" + index + "' id='input_topel_pkss_" + index + "' value='" + value.topel_pkss + "' /></td>";
            string_buffer += "<td><input type='text' name='input_topel_dvss_" + index + "' id='input_topel_dvss_" + index + "' value='" + value.topel_dvss + "' /></td>";
            string_buffer += "<td><input type='text' name='input_topel_pass_" + index + "' id='input_topel_pass_" + index + "' value='" + value.topel_pass + "' /></td>";
            string_buffer += "<td><input type='text' name='input_topel_elindex_" + index + "' id='input_topel_elindex_" + index + "' value='" + value.topel_elindex + "' /></td>";
			
			
			 if (value.not_tested_reason_first == "Not Enrolled")
            {

                var selectEnrollVal = "selected";

            }
            else
            {
                selectEnrollVal = "";
            }

            if (value.not_tested_reason_first == "Disability")
            {
                var selectDisVal = "selected";

            }
            else
            {
                selectDisVal = "";
            }
            if (value.not_tested_reason_first == "Student Refused")
            {
                var selectSRefVal = "selected";

            } else
            {
                selectSRefVal = "";
            }
            if (value.not_tested_reason_first == "Parent Refusal")
            {
                var selectPRefVal = "selected";
            } else
            {
                selectPRefVal = "";
            }

            if (value.not_tested_reason_first == "Untestable")
            {
                var selectUntestVal = "selected";

            }
            else
            {
                selectUntestVal = "";
            }



            if (value.not_tested_reason_second == "Not Enrolled")
            {

                var selectEnrollVals = "selected";

            }
            else
            {
                selectEnrollVals = "";
            }

            if (value.not_tested_reason_second == "Disability")
            {
                var selectDisVals = "selected";

            }
            else
            {
                selectDisVals = "";
            }
            if (value.not_tested_reason_second == "Student Refused")
            {
                var selectSRefVals = "selected";

            } else
            {
                selectSRefVals = "";
            }
            if (value.not_tested_reason_second == "Parent Refusal")
            {
                var selectPRefVals = "selected";
            } else
            {
                selectPRefVals = "";
            }

            if (value.not_tested_reason_second == "Untestable")
            {
                var selectUntestVals = "selected";

            }
            else
            {
                selectUntestVals = "";
            }
            
			
            string_buffer += "<td><select name='input_not_tested_reason_first_" + index + "' id='input_not_tested_reason_first_" + index + "' ><option value='0'>select Tested reason</option> <option value='Not Enrolled'  " + selectEnrollVal + ">  Not Enrolled</option><option value='Disability'  " + selectDisVal + ">Disability</option><option value='Student Refused'  " + selectSRefVal + ">Student Refused</option><option value='Parent Refusal'  " + selectPRefVal + ">Parent Refusal</option><option value='Untestable'  " + selectUntestVal + ">Untestable</option></select></td>";

            //string_buffer += "<td><input type='text' name='input_not_tested_reason_first_" + index + "' id='input_not_tested_reason_first_" + index + "' value='" + value.not_tested_reason_first + "' /></td>";
            string_buffer += "<td><input type='text' name='input_administrator_" + index + "' id='input_administrator_" + index + "' value='" + value.administrator + "' /></td>";
            string_buffer += "<td><input type='text' name='input_notes_first_" + index + "' id='input_notes_first_" + index + "' value='" + value.notes_first + "' /></td>";
//            string_buffer += "<td><input type='text' name='input_status_date_" + index + "' id='input_status_date_" + index + "' value='" + value.status_date + "' /></td>";
            string_buffer += "<td><input type='text' placeholder='yyyy-mm-dd' name='input_test_date_second_" + index + "' id='input_test_date_second_" + index + "' value='" + value.test_date_second + "' /></td>";
            string_buffer += "<td><input type='text' name='input_pals_upper_" + index + "' id='input_pals_upper_" + index + "' value='" + value.pals_upper + "' /></td>";
            string_buffer += "<td><input type='text' name='input_pals_lower_" + index + "' id='input_pals_lower_" + index + "' value='" + value.pals_lower + "' /></td>";
            string_buffer += "<td><input type='text' name='input_pals_letter_sounds_" + index + "' id='input_pals_letter_sounds_" + index + "' value='" + value.pals_letter_sounds + "' /></td>";
            string_buffer += "<td><select name='input_not_tested_reason_second_" + index + "' id='input_not_tested_reason_second_" + index + "' ><option value='0'>select Tested reason</option> <option value='Not Enrolled'  " + selectEnrollVals + ">  Not Enrolled</option><option value='Disability'  " + selectDisVals + ">Disability</option><option value='Student Refused'  " + selectSRefVals + ">Student Refused</option><option value='Parent Refusal'  " + selectPRefVals + ">Parent Refusal</option><option value='Untestable'  " + selectUntestVals + ">Untestable</option></select></td>";
            //string_buffer += "<td><input type='text' name='input_not_tested_reason_second_" + index + "' id='input_not_tested_reason_second_" + index + "' value='" + value.not_tested_reason_second + "' /></td>";
            string_buffer += "<td><input type='text' name='input_administrator_second_" + index + "' id='input_administrator_second_" + index + "' value='" + value.administrator_second + "' /></td>";
            string_buffer += "<td><input type='text' name='input_notes_second_" + index + "' id='input_notes_second_" + index + "' value='" + value.notes_second + "' /></td>";


            string_buffer += "</tr>";
            


            $(string_buffer).appendTo('#sort-table1');
            Column = index;
            string_buffer = "";

            //reset buffer after writing          
        });
        $('#sort-table1').append("<tr ><td ><button id ='editstudentForm_one' name='editstudentForm_one' type='submit' value='Submit' >Submit</button></td><td colspan='19' align='right'></td></tr>");
       
        $('#sort-table1').append("<input type='hidden' value='" + Column + "' id='recordcount' name='recordcount' />");
		$('#sort-table1').append("<input type='hidden'  id='teachernamefirst' name='teachernamefirst' />");
        $('#sort-table1').append("<input type='hidden'  id='teachernamesecond' name='teachernamesecond' />");
        $('#sort-table1').append("<input type='hidden'  id='teachernamethird' name='teachernamethird' />");
        $('#sort-table1').append("<input type='hidden'  id='coacher_name' name='coacher_name' />");
        $('#sort-table1').append("<input type='hidden'  id='director_name' name='director_name' />");
        //string_buffer
    }




    $(function() {
        $("#editstudentForm").livequery('click', function() {
            
        
            var dataString = $("#data_entry_edit_form").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/data_entry_form_submit/",
                data: dataString,
                 //dataType: 'json',

                success: function(html) {
            
                    alert('Successfully Updated');
                }

            });

            return false;  //stop the actual form post !important!
        });
    });
     $(function() {
        $("#editstudentForm_one").livequery('click', function() {
            var dataString = $("#data_entry_edit_form").serializeArray();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/data_entry_form_submit/",
                data: dataString,
                // dataType: 'json',

                success: function(html) {
                    alert('Successfully Updated');
                }

            });

            return false;  //stop the actual form post !important!
        });
    });

    /*$("input:radio[name=userIpStatus]").click(function() {
     var value = $(this).val();
     });*/
    $(function() {
        $("input:radio[name='userIpStatus']").livequery('click', function() {
           

            var inputIndex = '#' + $(this).attr('id');
            var inputValue = $(inputIndex).val();
            //alert(inputValue);

            if ((inputValue) == 'first') {
                var teachername_first = jQuery("#teachername1_first").val() + ' ' + jQuery("#teachername1_last").val();

                jQuery("input[id^='input_administrator_']").val(teachername_first);
                jQuery("input[id^='teachernamefirst']").val(teachername_first);

            } else if ((inputValue) == 'second') {
                var teachername_second = jQuery("#teachername2_first").val() + ' ' + jQuery("#teachername2_last").val();

                jQuery("input[id^='input_administrator_']").val(teachername_second);
                jQuery("input[id^='teachernamesecond']").val(teachername_second);
            }
            else if ((inputValue) == 'third') {
                var teachername_third = jQuery("#teachername3_first").val() + ' ' + jQuery("#teachername3_last").val();

                jQuery("input[id^='input_administrator_']").val(teachername_third);
                jQuery("input[id^='teachernamethird']").val(teachername_third);
            }
            else if ((inputValue) == 'fourth') {
                var coacherName = jQuery("#coachername_first").val() + ' ' + jQuery("#coachername_last").val();

                jQuery("input[id^='input_administrator_']").val(coacherName);
                jQuery("input[id^='coacher_name']").val(coacherName);
            }
            else if ((inputValue) == 'fifth') {
                var directorName = jQuery("#directorname_first").val() + ' ' + jQuery("#directorname_last").val();

                jQuery("input[id^='input_administrator_']").val(directorName);
                jQuery("input[id^='director_name']").val(directorName);
            }


            //var value = $(this).val();
            //var get_school_id = document.getElementById('school').value;
            //var dataString = $("#data_entry_edit_form").serializeArray();

            /*$.ajax({
             type: "POST",
             url: "<?php echo base_url(); ?>" + "admin_area/data_entry/data_entry_form_submit/",
             data: dataString,
             // dataType: 'json',
             
             success: function(html) {
             alert('successfully Updated');                    
             }
             
             });
             
             return false;  *///stop the actual form post !important!
        });
    });


</script>




