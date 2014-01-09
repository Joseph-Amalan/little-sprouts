<?php $this->template->add_js('includes/scripts/jquery-min.js'); ?>
<?php $this->template->add_js('includes/scripts/jquery.livequery.min.js'); ?>


<script type="text/javascript">

    // <![CDATA[
    $(document).ready(function() {

        jQuery('#selectinstancename').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#school > option").remove(); //first of all clear select items
            var instance_id = $('#selectinstancename').val();
            // alert(instance_id);// here we are taking country id of the selected one.
            // alert('<?php echo base_url(); ?>' + "admin_area/data_entry/get_instance_school_list/" + instance_id);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/get_instance_school_list/" + instance_id, //here we are calling our user controller and get_cities method with the country_id

                success: function(preschools) //we're calling the response json array 'cities'
                {
                    jQuery.each(preschools, function(id, schools) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {

                        var opt = $('<option />'); // here we're creating a new select option with for each city
                        opt.val(id);
                        opt.text(schools);
                        jQuery('#school').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                    jQuery('#school').prepend('<option value="" selected>Select</option>');
                }

            });


        });
        jQuery('#school').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#preclasses > option").remove(); //first of all clear select items
            var instance_id = $('#selectinstancename').val();
            var school_id = $('#school').val();
            // alert(school_id);// here we are taking country id of the selected one.
            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/getclass_list/" + school_id);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/getclass_list/" + instance_id + '/' + school_id, //here we are calling our user controller and get_cities method with the country_id

                success: function(preclasses) //we're calling the response json array 'cities'
                {
                    jQuery.each(preclasses, function(id, preclass) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {

                        var opt = $('<option />'); // here we're creating a new select option with for each city
                        opt.val(id);
                        opt.text(preclass);
                        jQuery('#preclasses').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                    jQuery('#preclasses').prepend('<option value="" selected>Select</option>');
                }

            });


        });
        jQuery('#preclasses').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#status > option").remove(); //first of all clear select items
            var instance_id = $('#selectinstancename').val();
            var school_id = $('#school').val();
            var preclass_id = $('#preclasses').val();
            // alert(school_id);// here we are taking country id of the selected one.
            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/getstatus_list/" + instance_id + '/' + school_id + '/' + preclass_id);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "staff/data_entry/getstatus_list/" + instance_id + '/' + school_id + '/' + preclass_id, //here we are calling our user controller and get_cities method with the country_id

                success: function(status1) //we're calling the response json array 'cities'
                {
                    jQuery.each(status1, function(id, status) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {

                        var opt = $('<option/>'); // here we're creating a new select option with for each city                      
                        opt.val(id);
                        opt.text(status);
                        //jQuery('#status').append(opt1);
                        jQuery('#status').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                    jQuery('#status').prepend('<option value="" selected>Select</option>');
                }

            });


        });
        jQuery('#status').change(function() { //any select change on the dropdown with id country trigger this code
            jQuery("#students1 > option").remove(); //first of all clear select items
            var instance_id = $('#selectinstancename').val();
            var school_id = $('#school').val();
            var preclass_id = $('#preclasses').val();
            var status_id = $('#status').val(); //alert(status_id);

            // alert("<?php echo base_url(); ?>" + "admin_area/data_entry/getstudent_list/" + school_id + '/' +  preclass_id);
            jQuery.ajax({
                type: "POST",
                //url: "<?php echo base_url(); ?>" + "admin_area/data_entry/getstudent_list/" + 'school_id=' + school_id + 'preclasses_id=' +  preclass_id, //here we are calling our user controller and get_cities method with the country_id
                url: "<?php echo base_url(); ?>" + "staff/data_entry/getstudent_list/" + instance_id + '/' + school_id + '/' + preclass_id + '/' + status_id, //here we are calling our user controller and get_cities method with the country_id
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

<div class="title"><br>
    <h3> Assessment Data Entry Portal</h3><br>
</div>
<?php
$attributes = array('id' => 'data_entry_form', 'name' => 'data_entry_form', 'class' => 'forms');
//echo form_open('admin_area/data_entry/data_entry_get_all_student', $attributes);
?>

<div class="hastable">
    <table id="sort-table"> 
        <tr> <th  nowrap>Instance List</th>
            <th > <select name="selectinstancename"  id="selectinstancename"  >
                    <option value="0" selected="selected">Select Instance</option>
                    <?php
                    // print_r($instances);
                    foreach ($instances as $instance) {
                        ?>
                        <option value="<?php echo $instance->instance_id; ?>"><?php echo $instance->instance_name; ?></option>
                    <?php }
                    ?>
                </select></th>
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
            <th > <?php $status['#'] = 'Please Select Status'; ?>
                <?php echo form_dropdown('status_id', $status, '#', 'id="status"'); ?>

<!--            <th  nowrap>Instance List</th>
            <th > <select name="selectinstancename"  id="selectinstancename"  >
                    <option value="0" selected="selected">Select Instance</option>
                <?php
                foreach ($instances as $instance) {
                    ?>
                                <option value="<?php echo $instance->instance_id; ?>"><?php echo $instance->instance_name; ?></option>
                <?php }
                ?>
                </select></th>-->
            <td name="submitform" id="submitform "> 
                <button type="submit" class="ui-state-default ui-corner-all" >Search</button>	

            </td>

        </tr>

    </table>


</div>
<?php echo form_close(); ?>
<div class="hastable">
    <?php
    $attributes = array('id' => 'data_entry_edit_form_main', 'name' => 'data_entry_edit_form_main', 'class' => 'forms');
    echo form_open('admin_area/data_entry/data_entry_form_submit', $attributes);
    ?>
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
        <input name="hidden_admin" id="hidden_admin" type="hidden" class="input-medium" value="" >
        <input name="hidden_radio_values" id="hidden_radio_values" type="hidden" class="input-medium" value="" >
    </table>
    <?php echo form_close(); ?>
</div>



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



    $(function() {
        $("td[id^='submitform']").click(function() {

            var get_school_id = document.getElementById('school').value;
            var get_class_id = document.getElementById('preclasses').value;
            var get_status_id = document.getElementById('status').value;
            var get_instance_id = document.getElementById('selectinstancename').value;

            if ((get_school_id) == "#") {
                alert('Please Select School');
                // error++;
            }
            else if ((get_class_id) == "#") {
                alert('Please Select Class');
                // error++;
            }
            else if ((get_status_id) == "#") {
                alert('Please Select Status');
                // error++;
            }
            else if ((get_instance_id) == "0") {
                alert('Please Select Instance');
                // error++;
            }
            //alert('<?php echo base_url(); ?>' + "admin_area/data_entry/data_entry_get_all_student/" + "get_school_id="+get_school_id +"&get_class_id="+get_class_id);



            var dataString = 'get_school_id=' + get_school_id + '&get_class_id=' + get_class_id + '&get_status_id=' + get_status_id + '&get_instance_id=' + get_instance_id;
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


    });




    function make_item_rows(result_array) {


        var string_buffer = "";
        string_buffer += "<tr ><td colspan='21' align='right'>Student Details</td><td><button id ='editstudentForm' name='editstudentForm' type='submit' value='Submit' >Submit</button></td></tr>";
        //string_buffer += "<tr><td>Student ID</td><td>Student Name</td><td>DOB</td><td>Test Date</td><td>TOPEL-PKSS</td><td>TOPEL-DVSS</td><td>TOPEL-PASS</td><td>TOPEL-ELIndex</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td><td>Status Date</td><td>Status Test Date</td><td>PALS-Upper</td><td>PALS-Lower</td><td>PALS-LetterSounds</td><td>Not Tested Reason</td><td>Administrator</td><td>Status Notes</td></tr>";
        //string_buffer += "<tr><td>Student ID</td><td>Student Name</td><td>DOB</td><td>Enrollment Status</td><td>Status Date</td><td>TOPEL Test Date</td><td>Print Knowledge</td><td>Definitional Vocabulary</td><td>Phonological Awareness</td><td>Early Literacy Index</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td><td>PALS Test Date</td><td>Upper Case</td><td>Lower Case</td><td>Letter Sounds</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td></tr>";
        string_buffer += "<tr><td>Student ID</td><td>Student Name</td><td>DOB</td><td>Enrollment Status</td><td>Status Date</td><td>TOPEL Test Date</td><td>Chronological Age (YY-MM)</td><td>Print Knowledge</td><td>Definitional Vocabulary</td><td>Phonological Awareness</td><td>Early Literacy Index</td><td>Early Literacy index Percentile</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td><td>PALS Test Date</td><td>Upper Case</td><td>Lower Case</td><td>Letter Sounds</td><td>Not Tested Reason</td><td>Administrator</td><td>Notes</td></tr>";

        var parseArray = jQuery.parseJSON(result_array);

        $('#teachername1_first').val(parseArray[0].teacher1_firstname);
        $('#teachername1_last').val(parseArray[0].teacher1_lastname);
        $('#teachername2_first').val(parseArray[0].teacher2_firstname);
        $('#teachername2_last').val(parseArray[0].teacher2_lastname);
        $('#teachername3_first').val(parseArray[0].teacher3_firstname);
        $('#teachername3_last').val(parseArray[0].teacher3_lastname);
        $('#coachername_first').val(parseArray[0].coacher_firstname);
        $('#coachername_last').val(parseArray[0].coacher_lastname);
        $('#directorname_first').val(parseArray[0].director_firstname);
        $('#directorname_last').val(parseArray[0].director_lastname);

        $('#hidden_admin').val(parseArray[0].administrator);



        if ((jQuery("#hidden_admin").val()) == (jQuery("#teachername1_first").val() + ' ' + jQuery("#teachername1_last").val()))
        {
            $(':radio[value=first]').prop('checked', true);
        }
        else if ((jQuery("#hidden_admin").val()) == (jQuery("#teachername2_first").val() + ' ' + jQuery("#teachername2_last").val()))
        {
            $(':radio[value=second]').prop('checked', true);
        }
        else if ((jQuery("#hidden_admin").val()) == (jQuery("#teachername3_first").val() + ' ' + jQuery("#teachername3_last").val()))
        {
            $(':radio[value=third]').prop('checked', true);
        }
        else if ((jQuery("#hidden_admin").val()) == (jQuery("#coachername_first").val() + ' ' + jQuery("#coachername_last").val()))
        {
            $(':radio[value=fourth]').prop('checked', true);
        }
        else if ((jQuery("#hidden_admin").val()) == (jQuery("#directorname_first").val() + ' ' + jQuery("#directorname_last").val()))
        {
            $(':radio[value=fifth]').prop('checked', true);
        }
        else
        {
            $("#userIpStatus_first,#userIpStatus_second,#userIpStatus_third,#userIpStatus_fourth,#userIpStatus_fifth").attr("checked", false);

        }

        var Column = 0;
        $.each(parseArray, function(index, value) {

            string_buffer += "<tr id ='items' name='items'>";
            string_buffer += "<td><input type='text' name='input_child_id_" + index + "' id='input_child_id_" + index + "' value='" + value.child_id + "' readonly/></td>";
            string_buffer += "<td><input type='text' name='input_student_name_" + index + "' id='input_student_name_" + index + "' value='" + value.first_name + '  ' + value.last_name + "' readonly/></td>";
            string_buffer += "<td><input type='text' placeholder='in yyyy-mm-dd' name='input_student_dob_" + index + "' id='input_student_dob_" + index + "' value='" + value.date_of_birth + "' readonly /></td>";
            string_buffer += "<td><input type='text' name='input_enrollment_status_" + index + "' id='input_enrollment_status_" + index + "' value='" + value.enrollment_status + "' readonly/></td>";
            string_buffer += "<td><input type='text' placeholder='in yyyy-mm-dd' name='input_status_date_" + index + "' id='input_status_date_" + index + "' value='" + value.status_date + "' readonly/></td>";


            string_buffer += "<td><input type='text' placeholder='yyyy-mm-dd' name='input_test_date_first_" + index + "' id='input_test_date_first_" + index + "' value='" + value.test_date_first + "' /></td>";
            string_buffer += "<td><input type='text' placeholder='yy-mm' name='input_chronological_age_" + index + "' id='input_chronological_age_" + index + "' value='" + value.chronological_age + "' readonly/></td>";

            string_buffer += "<td><input type='text' name='input_topel_pkss_" + index + "' id='input_topel_pkss_" + index + "' value='" + value.topel_pkss + "' /></td>";
            string_buffer += "<td><input type='text' name='input_topel_dvss_" + index + "' id='input_topel_dvss_" + index + "' value='" + value.topel_dvss + "' /></td>";
            string_buffer += "<td><input type='text' name='input_topel_pass_" + index + "' id='input_topel_pass_" + index + "' value='" + value.topel_pass + "' /></td>";




            string_buffer += "<td><input type='text' name='input_topel_elindex_" + index + "' id='input_topel_elindex_" + index + "' value='" + value.topel_elindex + "' readonly/></td>";
            string_buffer += "<td><input type='text' name='input_topel_elindex_percentile_" + index + "' id='input_topel_elindex_percentile_" + index + "' value='" + value.topel_elindex_percentile + "' readonly/></td>";


            // alert(value.not_tested_reason_first);
            if (value.not_tested_reason_first == "Not Enrolled")
            {

                var selectEnrollVal = "selected";

            }
            else
            {
                selectEnrollVal = "";
            }

            /* if (value.not_tested_reason_first == "Disability")
             {
             var selectDisVal = "selected";
             
             }
             else
             {
             selectDisVal = "";
             }*/
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

            /*  if (value.not_tested_reason_second == "Disability")
             {
             var selectDisVals = "selected";
             
             }
             else
             {
             selectDisVals = "";
             }*/
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
            string_buffer += "<td><select name='input_not_tested_reason_first_" + index + "' id='input_not_tested_reason_first_" + index + "' ><option value='0'>Select Reason</option> <option value='Not Enrolled'  " + selectEnrollVal + ">  Not Enrolled</option><option value='Student Refused'  " + selectSRefVal + ">Student Refused</option><option value='Parent Refusal'  " + selectPRefVal + ">Parent Refusal</option><option value='Untestable'  " + selectUntestVal + ">Untestable</option></select></td>";

            //string_buffer += "<td><input type='text' name='input_not_tested_reason_first_" + index + "' id='input_not_tested_reason_first_" + index + "' value='" + value.not_tested_reason_first + "' /></td>";
            string_buffer += "<td><input type='text' name='input_administrator_" + index + "' id='input_administrator_" + index + "' value='" + value.administrator + "' /></td>";
            string_buffer += "<td><input type='text' name='input_notes_first_" + index + "' id='input_notes_first_" + index + "' value='" + value.notes_first + "' /></td>";
//            string_buffer += "<td><input type='text' name='input_status_date_" + index + "' id='input_status_date_" + index + "' value='" + value.status_date + "' /></td>";
            string_buffer += "<td><input type='text' placeholder='yyyy-mm-dd' name='input_test_date_second_" + index + "' id='input_test_date_second_" + index + "' value='" + value.test_date_second + "' /></td>";
            string_buffer += "<td><input type='text' name='input_pals_upper_" + index + "' id='input_pals_upper_" + index + "' value='" + value.pals_upper + "' /></td>";
            string_buffer += "<td><input type='text' name='input_pals_lower_" + index + "' id='input_pals_lower_" + index + "' value='" + value.pals_lower + "' /></td>";
            string_buffer += "<td><input type='text' name='input_pals_letter_sounds_" + index + "' id='input_pals_letter_sounds_" + index + "' value='" + value.pals_letter_sounds + "' /></td>";
            string_buffer += "<td><select name='input_not_tested_reason_second_" + index + "' id='input_not_tested_reason_second_" + index + "' ><option value='0'>Select Reason</option> <option value='Not Enrolled'  " + selectEnrollVals + ">  Not Enrolled</option><option value='Student Refused'  " + selectSRefVals + ">Student Refused</option><option value='Parent Refusal'  " + selectPRefVals + ">Parent Refusal</option><option value='Untestable'  " + selectUntestVals + ">Untestable</option></select></td>";
            //string_buffer += "<td><input type='text' name='input_not_tested_reason_second_" + index + "' id='input_not_tested_reason_second_" + index + "' value='" + value.not_tested_reason_second + "' /></td>";
            string_buffer += "<td><input type='text' name='input_administrator_second_" + index + "' id='input_administrator_second_" + index + "' value='" + value.administrator_second + "' /></td>";
            string_buffer += "<td><input type='text' name='input_notes_second_" + index + "' id='input_notes_second_" + index + "' value='" + value.notes_second + "' /></td>";


            string_buffer += "</tr>";



            $(string_buffer).appendTo('#sort-table1');
            Column = index;
            string_buffer = "";

            //reset buffer after writing          
        });
        $('#sort-table1').append("<tr ><td ><button id ='editstudentForm_one' name='editstudentForm_one' type='submit' value='Submit' >Submit</button></td><td colspan='21' align='right'></td></tr>");

        $('#sort-table1').append("<input type='hidden' value='" + Column + "' id='recordcount' name='recordcount' />");


        /*  $('#sort-table1').append("<input type='hidden'  id='teachernamefirst' name='teachernamefirst' />");
         $('#sort-table1').append("<input type='hidden'  id='teachernamesecond' name='teachernamesecond' />");
         $('#sort-table1').append("<input type='hidden'  id='teachernamethird' name='teachernamethird' />");
         $('#sort-table1').append("<input type='hidden'  id='coacher_name' name='coacher_name' />");
         $('#sort-table1').append("<input type='hidden'  id='director_name' name='director_name' />");*/


        //string_buffer
    }
    $(function() {
        $('input[id^=input_topel_pkss_],input[id^=input_topel_dvss_],input[id^=input_topel_pass_]').livequery('change', function() {
            var Sum = 0;
            var CurrentIndex = $(this).attr('id');
            var CurrentArray = CurrentIndex.split('_');
            var CurrentID = CurrentArray[3];
            Sum = parseInt($('#input_topel_pkss_' + CurrentID).val()) + parseInt($('#input_topel_dvss_' + CurrentID).val()) + parseInt($('#input_topel_pass_' + CurrentID).val());
            //alert(Sum);

            if (((Sum) >= 160) && ((Sum) <= 406)) {
                var dataStrings = 'sumval=' + Sum;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "staff/data_entry/data_entry_get_Early_Literacy_Index/",
                    data: dataStrings,
                    cache: false,
                    //dataType: 'json',  
                    success: function(html) {
                        var htmlsplit = html.split(':');

                        $('#input_topel_elindex_' + CurrentID).val(htmlsplit[0]);
                        $('#input_topel_elindex_percentile_' + CurrentID).val(htmlsplit[1]);

                    }


                });
            }
            else
            {
                //alert('No data');
                $('#input_topel_elindex_' + CurrentID).val("");
                $('#input_topel_elindex_percentile_' + CurrentID).val("");

            }

        });
    });
    $(function() {
        $('input[id^=input_test_date_second_]').livequery('change', function() {

            var test_date = 0;
            var CurrentIndex_date = $(this).attr('id');
            var CurrentArray_date = CurrentIndex_date.split('_');
            var CurrentID_date = CurrentArray_date[4];
            test_date = $('#input_test_date_second_' + CurrentID_date).val();


            if (!test_date.match(/^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/))
            {

                alert("Please Enter a date in this format yyyy-mm-dd");
                $('#input_test_date_second_' + CurrentID_date).val("");
            }


        });
    });
    $(function() {
        $('input[id^=input_test_date_first_]').livequery('change', function() {

            var start_date = 0;
            var end_date = 0;
            var CurrentIndex_date = $(this).attr('id');
            var CurrentArray_date = CurrentIndex_date.split('_');
            var CurrentID_date = CurrentArray_date[4];
            start_date = $('#input_test_date_first_' + CurrentID_date).val();
            end_date = $('#input_student_dob_' + CurrentID_date).val();

            if (start_date.match(/^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/))
            {

                var dataStrings = 'startdate=' + start_date + '&enddate=' + end_date;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "staff/data_entry/getchronological_age/",
                    data: dataStrings,
                    cache: false,
                    //dataType: 'json',  
                    success: function(html) {
                        var htmlsplit = html.split(':');

                        $('#input_chronological_age_' + CurrentID_date).val(htmlsplit[0]);
                    }

                });
            } else
            {
                alert("Please Enter a date in this format yyyy-mm-dd");
                $('#input_chronological_age_' + CurrentID_date).val("");
                $('#input_test_date_first_' + CurrentID_date).val("");
            }

        });
    });

    $(function() {
        $("#editstudentForm").livequery('click', function() {
            var txtLength = ((jQuery("input[id^='teachername1_first']").val().length) || (jQuery("input[id^='teachername2_first']").val().length) || (jQuery("input[id^='teachername3_first']").val().length) || (jQuery("input[id^='coachername_first']").val().length) || (jQuery("input[id^='directorname_first']").val().length));

            if (txtLength <= 0)
            {
                alert("Please Enter Teacher Names for this Class");
                return false;
            }

            /*if ($('input[name=userIpStatus]:checked').length <= 0)
             {
             alert("Please Click Teacher name related Radion Button");
             return false;
             } */

            var dataString = $("#data_entry_edit_form_main,#data_entry_edit_form").serializeArray();


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
            var txtLength = ((jQuery("input[id^='teachername1_first']").val().length) || (jQuery("input[id^='teachername2_first']").val().length) || (jQuery("input[id^='teachername3_first']").val().length) || (jQuery("input[id^='coachername_first']").val().length) || (jQuery("input[id^='directorname_first']").val().length));

            if (txtLength <= 0)
            {
                alert("Please Enter Teacher Names for this Class");
                return false;
            }

            /* if ($('input[name=userIpStatus]:checked').length <= 0)
             {
             alert("Please Click Teacher name related Radion Button");
             return false;
             }   */

            var dataString = $("#data_entry_edit_form_main,#data_entry_edit_form").serializeArray();

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
            var UserIPStatus = $("input:radio[name='userIpStatus']:checked").val();
            jQuery("input[id^='hidden_radio_values']").val(UserIPStatus);
            //alert(UserIPStatus); 
            var confirmacao = confirm("Selecting an administrator will replace the administrator for all students on this page. Are you sure you want to continue?");
            if (confirmacao) {
                // console.log("OK");


                var inputIndex = '#' + $(this).attr('id');
                var inputValue = $(inputIndex).val();
                //alert(inputValue);

                if ((inputValue) == 'first') {
                    var teachername_first = jQuery("#teachername1_first").val() + ' ' + jQuery("#teachername1_last").val();

                    jQuery("input[id^='input_administrator_']").val(teachername_first);
                    /* jQuery("input[id^='teachernamefirst']").val(teachername_first);
                     jQuery("input[id^='teachernamesecond']").val("");
                     jQuery("input[id^='teachernamethird']").val("");
                     jQuery("input[id^='coacher_name']").val("");
                     jQuery("input[id^='director_name']").val("");*/

                } else if ((inputValue) == 'second') {
                    var teachername_second = jQuery("#teachername2_first").val() + ' ' + jQuery("#teachername2_last").val();

                    jQuery("input[id^='input_administrator_']").val(teachername_second);
                    /* jQuery("input[id^='teachernamesecond']").val(teachername_second);
                     jQuery("input[id^='teachernamefirst']").val("");
                     jQuery("input[id^='teachernamethird']").val("");
                     jQuery("input[id^='coacher_name']").val("");
                     jQuery("input[id^='director_name']").val("");*/
                }
                else if ((inputValue) == 'third') {
                    var teachername_third = jQuery("#teachername3_first").val() + ' ' + jQuery("#teachername3_last").val();

                    jQuery("input[id^='input_administrator_']").val(teachername_third);
                    /* jQuery("input[id^='teachernamethird']").val(teachername_third);
                     jQuery("input[id^='teachernamesecond']").val("");
                     jQuery("input[id^='teachernamefirst']").val("");
                     jQuery("input[id^='coacher_name']").val("");
                     jQuery("input[id^='director_name']").val("");*/
                }
                else if ((inputValue) == 'fourth') {
                    var coacherName = jQuery("#coachername_first").val() + ' ' + jQuery("#coachername_last").val();

                    jQuery("input[id^='input_administrator_']").val(coacherName);
                    /* jQuery("input[id^='coacher_name']").val(coacherName);
                     jQuery("input[id^='teachernamefirst']").val("");
                     jQuery("input[id^='teachernamesecond']").val("");
                     jQuery("input[id^='teachernamethird']").val("");
                     jQuery("input[id^='director_name']").val("");*/

                }
                else if ((inputValue) == 'fifth') {
                    var directorName = jQuery("#directorname_first").val() + ' ' + jQuery("#directorname_last").val();

                    jQuery("input[id^='input_administrator_']").val(directorName);
                    /*jQuery("input[id^='director_name']").val(directorName);
                     jQuery("input[id^='teachernamefirst']").val("");
                     jQuery("input[id^='teachernamesecond']").val("");
                     jQuery("input[id^='teachernamethird']").val("");
                     jQuery("input[id^='coacher_name']").val("");*/
                }
                //return true;
            } else {
               var hiddenradioval = jQuery("#hidden_radio_values").val();
                $("input[name=userIpStatus][value=" + $(hiddenradioval).val() + "]").attr('checked', false);
                return false;
            }



        });
    });

</script>




