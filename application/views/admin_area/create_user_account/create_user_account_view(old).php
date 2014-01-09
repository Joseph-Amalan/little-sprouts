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
                    <label>User Name  <input type="text" class="" name="username" id="username" value="" width="20"></label>
                    <br>
                    <label>Password  <input type="password" class="" name="password" id="password" value="" ></label>
                    <br>



                    <label>User Email <input type="text" class="" name="userEmail" id="userEmail" value="<?php echo set_value('userEmail'); ?>" placeholder="abc@example.com"></label>
                    <?php echo form_error('userEmail'); ?>
                    <br>
                    <label>Select Role       <select class="pagesize" name="userrole" id="userrole">
                            <option value="1" selected="selected">Teacher</option>
                            <option value="4">Admin</option>
                        </select></label>	
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
