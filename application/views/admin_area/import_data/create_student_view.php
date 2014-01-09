<?php $this->admin_template->add_css('includes/admin_area/styles/tabs.css'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="<?php echo base_url(); ?>includes/admin_area/styles/style.css" rel="stylesheet" media="all" />
    </head>

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

                <?php
                $postinstance_id = $instance_id;
                if($_GET){
                $instance_id = $_GET['id']; 
                }if($postinstance_id){
             
                    $instance_id = $postinstance_id;
                }

                $attributes = array('id' => 'create_student', 'name' => 'create_student', 'class' => 'forms');
                echo form_open('admin_area/import_data/create_profile/', $attributes);
                ?>	



                <h1>Student Details</h1>		
                <div class="view_content_box">
                    <input type="hidden"  id="instancehiddenid" name="instancehiddenid" value="<?php echo $instance_id; ?>">
                        <div class="field tooltip" title="Please Enter Child Id.">
                            <label for="email" class="desc"> Child ID <span class="required">* </span></label>			
                            <input type="text" maxlength="255" name="studentId"  value="<?php echo set_value('studentId'); ?>">
                                <?php echo form_error('studentId'); ?>
                        </div>
                        <div class="field tooltip" title="Please Enter First Name.">
                            <label for="email" class="desc"> First Name <span class="required">* </span></label>			
                            <input type="text" maxlength="255" name="studentFirstName"  value="<?php echo set_value('studentFirstName'); ?>">
                                <?php echo form_error('studentFirstName'); ?>
                        </div>
                        <div class="field tooltip" title="Please Enter Last Name.">	
                            <label for="email" class="desc">Last Name </label>
                            <input type="text" maxlength="255" name="studentLastName" value="<?php echo set_value('studentLastName'); ?>">
                                <?php echo form_error('studentLastName'); ?>
                        </div>
                        <div class="field tooltip" title="Please Select Gender.">	
                            <label for="email" class="desc">Gender <span class="required">* </span></label>
                            <input type="text" maxlength="255" name="childGender" value="<?php echo set_value('childGender'); ?>" >
                                <?php echo form_error('childGender'); ?>
                        </div>
                        <div class="field tooltip" title="Please Enter Voucher Number.">	
                            <label for="" class="desc">Voucher number <span class="required">* </span></label>
                            <input type="text" maxlength="255" name="voucherNumber" value="<?php echo set_value('voucherNumber'); ?>" >
                                <?php echo form_error('voucherNumber'); ?>
                        </div>
                        
                        <div class="field tooltip" title="Please Select DataOfBirth.">
						 <label for="" class="desc"> Date of Birth <span class="required">* </span></label>						
						<div><input id="childdob" name="childdob" type="text" value="<?php echo set_value('childdob'); ?>" placeholder="in mm/dd/yyyy" /></div>
						<?php echo form_error('childdob'); ?>
						 <script>
	
							/*$(function() { 
								$( "#childdob-datepicke" ).datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat:"mm/dd/yy", 
									//showOn: "button",
									//buttonImage: "<?php echo base_url();?>includes/images/calendar.png",
									//buttonImageOnly: true,	
									minDate: "-100Y", maxDate: "-13Y",
									numberOfMonths: 1
								});
							});	*/
						</script>
					</div>				
                        
<!--                        <div class="field tooltip" title="Please Select DataOfBirth.">
                            <label for="" class="desc"> Date of Birth <span class="required">* </span></label>
                            <input name="childdob" type="text"  value=""  />
                            <?php echo form_error('childdob'); ?>
                        </div>		-->
                        <div class="field tooltip" title="Please Select  School.">
                            <label for="" class="desc"> School Name <span class="required">* </span></label>
                            <input name="childschoolname" type="text"  value="<?php echo set_value('childschoolname'); ?>"  />
                            <?php echo form_error('childschoolname'); ?>
                        </div>
                        <div class="field tooltip" title="Please Enter School Code.">
                            <label for="" class="desc"> School Code  <span class="required">* </span></label>
                            <input name="childschoolcode" type="text"  value="<?php echo set_value('childschoolcode'); ?>"  />
                            <?php echo form_error('childschoolcode'); ?>
                        </div>		
                        <div class="field tooltip" title="Please Select Status Date.">	
                            <label for="email" class="desc">Status Date <span class="required">* </span></label>
                            <input type="text" maxlength="255" name="statusdate"  value="<?php echo set_value('statusdate'); ?>" >
                                <?php echo form_error('statusdate'); ?>
                        </div>
                        <div class="field tooltip" title="Please Select Enrollment Status.">
                            <label for="" class="desc"> Enrollment Status <span class="required">* </span></label>
                            <input name="enrollmentstatus" type="text"  value="<?php echo set_value('enrollmentstatus'); ?>"  />
                            <?php echo form_error('enrollmentstatus'); ?>
                        </div>	
                        <div class="field tooltip" title="Please Select Class.">
                            <label for="" class="desc"> Primary Classroom <span class="required">* </span></label>
                            <input name="childclassname" type="text"  value="<?php echo set_value('childclassname'); ?>"  />
                            <?php echo form_error('childclassname'); ?>
                        </div>	
						<div class="field tooltip" title="Please Enter Class Room Id.">
                            <label for="" class="desc"> ClassRoom ID <span class="required">* </span></label>
                            <input name="childclassid" type="text"  value="<?php echo set_value('childclassid'); ?>"  />
                            <?php echo form_error('childclassid'); ?>
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
                            this.value = 'Inserting...';
                            result = (this.form.onsubmit ? (this.form.onsubmit() ? this.form.submit() : false) : this.form.submit());
                            if (result == false) {
                                this.value = this.getAttribute('originalValue');
                                this.disabled = false;
                            }
                            return result;" type="submit" value="Create Student" /><br/>
                </div>
<?php echo form_close(); ?>			
                <br/><br/><br/>	

            </div>           
        </div>		
    </div>
    <div class="clearfix"></div>		
</body>
</html>

