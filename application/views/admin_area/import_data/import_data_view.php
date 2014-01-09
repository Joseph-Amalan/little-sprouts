<?php $this->admin_template->add_js('includes/admin_area/scripts/jquery.livequery.min.js'); ?>
<div class="title title-spacing">
    <h2>Import Data into Database</h2>        
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
    <div class="portlet-header ui-widget-header">Import Data</div>
    <div class="portlet-content">
        <?php
        $attributes = array('id' => 'import_data', 'name' => 'import_data', 'class' => 'forms', 'enctype' => 'multipart/form-data');
        echo form_open('admin_area/import_data/import_data_db', $attributes);
        ?> 
        <ul>
            <li>
                <div id="loading" style="display:none;">
                    <img id="loading-image" src="<?php echo base_url(); ?>includes/admin_area/images/ajax-loader.gif" alt="Loading..." /> Processing
                </div>
                <div id="result_list">
                    <table width="30%"><tr>

                            <th>Add Single Record &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="addstudent" name="addstudent" value="addsingle" class="radiobtn"  align="center" onclick="hidebox('addsingle');"></th>
                            <th>Merge File &nbsp;&nbsp;&nbsp;<input type="radio" id="addstudent" name="addstudent" value="mergefile" class="radiobtn"  align="center" onclick="hidebox('mergefile');"> </th>

                        </tr></table>

                    <ul id="studentcontent"style="display:none;">
                        <li>Instance List<select name="selectinstance_name"  id="selectinstance_name" >
                                <option value="0" selected="selected">Select Instance</option>
                                <?php                                
                                foreach ($instances as $instance) {
                                    
                                        ?>
                                        <option value="<?php echo $instance->instance_id; ?>"><?php echo $instance->instance_name; ?></option>
                                    <?php
                                } ?>
                            </select>
                             <?php echo form_error('selectinstance_name'); ?>
                        </li>
                        <li>
                            <label class="desc">
                                Upload File:
                            </label>
                            <div>
                                <input type="file" tabindex="1" size="40" class="field text full" name="import_data_file"  />
                                <input type="hidden" tabindex="1" size="40" class="field text full" name="import_data_e"  />
 <br><label><b> Please Browse Only .xlsx|.xls file.</b></label> 
                                                            <br>
                                                            <label> <b>File Name should not have space.</b></label> 
                            </div>
                        </li>
                        <li class="buttons">
                            <button type="submit" value="Submit" class="ui-state-default ui-corner-all" id="saveForm" onclick="chk();">Submit</button>
                        </li>

                    </ul>
                    <ul id="studentcontent_add"style="display:none;">

                        <li>Instance List<select name="selectinstancename"  id="selectinstancename"  >
                                <option value="0" selected="selected">Select Instance</option>
                                <?php                                
                                foreach ($instances as $instance) {
                                    
                                        ?>
                                        <option value="<?php echo $instance->instance_id; ?>"><?php echo $instance->instance_name; ?></option>
                                    <?php
                                } ?>
                            </select>
                        </li>
                        <li>  <label class="desc">
                                <input type="hidden"  id="instancehiddenid" name="instancehiddenid" >
                                 <a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" id="passstudentdata"
                                   title="Add Student" >Add Student
<!--								<span class="ui-icon ui-icon-edit"></span>							-->
							</a>
                            </label>

                        </li>


                    </ul>

                </div>

            </li>

        </ul>
<?php echo form_close(); ?>
    </div>
</div> 
<div class="clearfix"></div>
<!--<i class="note">* Just a simple note here ...</i>-->
<script language="javascript" type="text/javascript">

                        function chk()
                        {
                            $('#loading').show();
                        }



$('#passstudentdata').click(function() {
   // assign the value to a variable, so you can test to see if it is working
    var selectVal = $('#selectinstancename').val();//alert(selectVal);
    if((selectVal) =='0'){
        
        alert('Please Select Instance List'); 
        tb_remove();
    }else
        {
    jQuery("input[id^='instancehiddenid']").val(selectVal);
    var hrefValue = '<?php echo base_url();?>admin_area/import_data/create_profile?id='+selectVal+ '&keepThis=true&TB_iframe=true&height=510&width=480';
    $('#passstudentdata').attr('href',hrefValue)
    }
    
});


/*$('#selectinstancename').change(function() {
   // assign the value to a variable, so you can test to see if it is working
    var selectVal = $('#selectinstancename').val();
    //alert(selectVal);
    jQuery("input[id^='instancehiddenid']").val(selectVal);
    var hrefValue = '<?php echo base_url();?>admin_area/import_data/create_profile?id='+selectVal+ '&keepThis=true&TB_iframe=true&height=510&width=480';
    $('#passstudentdata').attr('href',hrefValue)
    
    
});*/

            </script>
<style type="text/css">
    #loading {
        /*width: 100%;
        height: 100%;*/
        color: #FF0000;
        display: block;
        left: 0;   
        margin-left: 455px;
        margin-top: 308px;
        opacity: 0.7;
        position: fixed;
        text-align: center;
        top: 0;
        z-index: 99
    }

    #loading-image {
        margin-left: -35px;
        margin-top: -6px;
        position: absolute;
        width: 40%;
        z-index: 100;
    }


</style>

<div class="hastable">
    <table id="sort-table">
        <th colspan="2" align="center"> Upload Files List</th>  
        <tr><td>S.NO</td>
            <td>File Name</td></tr>
        <?php
       $files = scandir( "/home/knsclients/littlesprouts/uploads/" );
        $i = 1;
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $file; ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>  
    </table>
</div>
<script type="text/javascript">
    function hidebox(id) {
        if ((id) == 'mergefile') {
            studentcontent_add.style.display = 'none';
            studentcontent.style.display = 'block';

        } else {
            studentcontent_add.style.display = 'block';
            studentcontent.style.display = 'none';
        }
    }
</script>