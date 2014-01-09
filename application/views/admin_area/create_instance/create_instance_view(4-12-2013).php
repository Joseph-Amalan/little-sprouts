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
                    
                    <label>Instance Name  <input type="text" class="" name="instancename" id="instancename" value="<?php echo set_value('username'); ?>" width="20"></label>
                     <?php echo form_error('instancename'); ?>
                    
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
<!--<i class="note">* Just a simple note here ...</i>-->

