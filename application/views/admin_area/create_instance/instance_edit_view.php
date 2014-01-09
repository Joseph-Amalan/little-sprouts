<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="<?php echo base_url(); ?>includes/admin_area/styles/style.css" rel="stylesheet" media="all" />
        <script type="text/javascript" src="<?php echo base_url(); ?>includes/admin_area/scripts/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>includes/admin_area/scripts/custom.js"></script>

    </head>
    <body>
        <div id="page-wrapper">
            <div id="main-wrapper">
                <div id="main-content" class="view_user_profile">				
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

                    <?php $attributes = array('id' => 'admin_login', 'name' => 'admin_login', 'class' => 'forms');
                    echo form_open('admin_area/list_instance/edit_instance/' . $instance_id . '/' . $instance_name, $attributes);
                    ?>	

<?php foreach ($instance_data as $item) { ?>

                        <div class="field">
                            <?php /* <span class="ad_user_photo">
                              <img height="60" width="60" alt="" src="<?php echo base_url();?>includes/images/user_photo.png">
                              </span> */ ?>
                            <div class="ad_user_name">
    <?php echo ucfirst($item->instance_name); ?>				
                            </div>

                        </div>

                        <h1>Instance Details</h1>		
                        <div class="view_content_box">				
                            <div class="field">
                                <label for="email" class="desc"> Instance Name: <span class="required">* </span></label>			
                                <input type="text" maxlength="255" name="instancename"  value="<?php echo $item->instance_name; ?>">
    <?php echo form_error('instancename'); ?>
                            </div>


                            <?php ?>


                            <div class="field">	
                                <label for="email" class="desc">Year: <span class="required">* </span></label>				
                                <select name="yeardropdown" id="yeardropdown">
                                 <option value=""> Select Year </option>	
                                <?php
                                $get_year = $item->year;
                                $start = date('Y') - 10;
                                $end = date('Y') + 20;
                            // populate the select options with years 
                                for ($yr = $start; $yr <= $end; $yr++) {
                                    if ($yr == $get_year) {
                                        echo '<option value="' . $yr . '" selected="selected">' . $yr . '</option>';
                                    } else {
                                        echo ' <option value="' . $yr . '" > ' . $yr . ' </option> ';
                                    }
                                }
                                ?>	                    
                                </select>
                                    <?php echo form_error('yeardropdown'); ?>	
                            </div>



                            <div class="field">	
                                <label for="email" class="desc">Academic Year: <span class="required">* </span></label>
                                <input type="text" maxlength="255" name="academicyear" value="<?php echo $item->academic_year; ?>" >
    <?php echo form_error('academicyear'); ?>
                            </div>
                            <div class="field">	
                                <label for="" class="desc">Term: <span class="required">* </span></label>
                                <input type="text" maxlength="255" name="instanceterm" value="<?php echo $item->term; ?>" >
    <?php echo form_error('instanceterm'); ?>
                            </div>
                        </div>
                        <div class="buttons ipbtn">	    
                            <input class="ui-state-default ui-corner-all" name="commit" onclick="if (window.hiddenCommit) {
                                        window.hiddenCommit.setAttribute('value', this.value);
                                    } else {
                                        hiddenCommit = document.createElement('input');
                                        hiddenCommit.type = 'hidden';
                                        hiddenCommit.value = this.value;
                                        hiddenCommit.name = this.name;
                                        this.form.appendChild(hiddenCommit);
                                    }
                                    this.setAttribute('originalValue', this.value);
                                    this.disabled = true;
                                    this.value = 'Updating...';
                                    result = (this.form.onsubmit ? (this.form.onsubmit() ? this.form.submit() : false) : this.form.submit());
                                    if (result == false) {
                                        this.value = this.getAttribute('originalValue');
                                        this.disabled = false;
                                    }
                                    return result;" type="submit" value="Update Instance" /><br/>
                        </div>
                            <?php echo form_close(); ?>			
                        <br/><br/><br/>	
                    <?php } ?>	
                </div>           
            </div>		
        </div>
        <div class="clearfix"></div>		
    </body>
</html>

