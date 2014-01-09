<div class="title title-spacing">
    <h2>Create User account</h2>
    
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
        $attributes = array('id' => 'create_user_account', 'name' => 'create_user_account', 'class' => 'forms');
        echo form_open('admin_area/create_user_account', $attributes);
        ?> 
        <ul>
            <li>
                <div align="center">
                    
                    <label>User Name  <input type="text" class="" name="username" id="username" value="<?php echo set_value('username'); ?>" width="20"></label>
                     <?php echo form_error('username'); ?>
                    <br>
                    <label>Password  <input type="password" class="" name="password" id="password" value="<?php echo set_value('password'); ?>" ></label>
                     <?php echo form_error('password'); ?>
<!--                    <br>
                    <label>User Email <input type="text" class="" name="userEmail" id="userEmail" value="<?php echo set_value('userEmail'); ?>" placeholder="abc@example.com"></label>
                    <?php echo form_error('userEmail'); ?>
                    <br>-->
                    <label>Select Role&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="pagesize" name="userrole" id="userrole" onChange="hidebox('schoolcontent');">
                           <option value="" selected="selected"  >Select Role</option>
                            <option value="1" >User</option>
                              <option value="2" >Coach</option>
                                <option value="3" >Director</option>
                            <option value="4">Admin</option>
                        </select></label>
                     <?php echo form_error('userrole'); ?>
                     <label id="schoolcontent"style="display:none;">
                         Select School<select name="tar[]"   multiple="multiple" size="10" style="width: 20%;" id="select1" >
                        
                        
            <?php    foreach($schools as $schoollist){ ?>
            <option value="<?php echo $schoollist; ?>"><?php echo $schoollist; ?></option>
            <?php } ?>

            </select><p>You can select multiple schools by holding Control key and clicking on another school.</p>
                         
                     </label>
                    
                </div>
            </li>
            <li class="buttons">
                <button type="submit" class="ui-state-default ui-corner-all">Create User</button>	
            </li>
        </ul>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="clearfix"></div>
<!--<i class="note">* Just a simple note here ...</i>-->
<script type="text/javascript">
    function hidebox(id) {
       var e = document.getElementById(id);
       var rolevalue= document.getElementById('userrole').value;
        if((rolevalue) == '1')            
        e.style.display = 'block';
        //e.style.display = 'none';
         else
         e.style.display = 'none';
    }
    </script>
