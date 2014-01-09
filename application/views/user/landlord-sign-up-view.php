<?php $this->template->add_css('includes/styles/acidTabs.css'); ?>
<?php $this->template->add_js('includes/scripts/acidTabs.js'); ?>

<?php $this->session->set_userdata('userRoleId',2);?>

<div class="left ">
	<div class="main-internal">	
	<h2><span>Landlord</span> Sign Up</h2>
	Already have account! <a href="<?php echo base_url();?>login">Login Here</a> | Forgot Password? <a href="<?php echo base_url();?>forgot_password">click here</a> <br/><br/>
        
	<?php 	
	if($this->session->flashdata('success_message')) : 
			echo '<div class="success">';
			echo $this->session->flashdata('success_message');
			echo '</div>';
	endif;

	if($this->session->flashdata('error_message')) : 
			echo '<div class="error">';
			echo $this->session->flashdata('error_message');
			echo '</div>';
	endif;	
	?>  
<div id="wrapper">
  
<div id="tabContainer">
  <div class="tabs" id="tabscon">
    <ul>
      <li id="tabHeader_1"><h3>Account Details</h3></li>
      <li id="tabHeader_2"><h3>Personal Details</h3></li>
      <li id="tabHeader_3"><h3>Office Details</h3></li>
      <li id="tabHeader_4"><h3>Official Contact Persons</h3></li>
      <li id="tabHeader_5"><h3>Lease Verification</h3></li>
      <li id="tabHeader_6"><h3>Submit</h3></li>	  
    </ul>
  </div>
  <div class="bg"></div>    
    
<?php 
    $attributes = array('id' => 'signUp','name' => 'signUp','class' => 'forms'); 
    echo form_open('landlord/sign_up', $attributes); 
  ?>		    
  <div class="tabscontent">
  	<div class="tabpage" id="tabpage_1">   	
      
       <div class="field tooltip" title="Please enter your email address.">
			<label for="">Email Address <span class="required">*</span></label>	
			<input id="userEmail" name="userEmail" type="text" value="<?php echo set_value('userEmail'); ?>" placeholder="e.g. abc@example.com"/>	
			<?php echo form_error('userEmail'); ?>				
		</div>	
		<div class="field tooltip" title="Please enter your Password.">
			<label for="">Password <span class="required">*</span></label>					
			<input id="userPassword" name="userPassword" type="password" type="text" value=""/>
			<?php echo form_error('userPassword'); ?>
		</div>	
		<div class="field tooltip" title="Please re-enter your same Password as above.">
			<label for="">Confirm Password  <span class="required">*</span></label>	
			<input id="userConfPassword" name="userConfPassword" type="password" value="" />
		 	<?php echo form_error('userConfPassword'); ?>
		</div>	
        <span class="field">		
			<input class="buttons nextbtn" name="commit" type="button" id="nexttab_2" value="Next">
			<input class="reset_buttons" name="commit" type="button" value="Reset" onclick="clear_form_elements('#tabpage_1')">
		</span>    
    </div>
    <div class="tabpage" id="tabpage_2">    
        <?php /* <div class="field tooltip" title="Please enter your first name.">
			<label for=""> First Name <span class="required">*</span></label>
			<input name="userFirstName" type="text" value="<?php echo set_value('userFirstName'); ?>" />
			<?php echo form_error('userFirstName'); ?>
		</div>
        <div class="field tooltip" title="Please enter your last name.">
			<label for=""> Last Name <span class="required">*</span></label>	
			<input name="userLastName" type="text" value="<?php echo set_value('userLastName'); ?>" />
			<?php echo form_error('userLastName'); ?>
		</div>
		<div class="field tooltip" title="Please enter your Suffix (Sr., Jr., III).">
			<label for=""> Suffix </label>	
			<input name="userSuffix" type="text" value="<?php echo set_value('userSuffix'); ?>" />
            <?php echo form_error('userSuffix'); ?>
		</div>	*/?>	
		<div class="field tooltip" title="Please enter your personal Phone no.">
			<label for="">Personal Phone <span class="required">*</span></label>
			<input name="userPersonalPhone" type="text" value="<?php echo set_value('userPersonalPhone'); ?>" placeholder="e.g. 222-222-2222" />
			<?php echo form_error('userPersonalPhone'); ?>
		</div>	         
		<div class="field tooltip" title="Please enter your Social Security number.">
			<label for="">SSN <span class="required">*</span></label>
			<input name="userSsn" type="text" value="<?php echo set_value('userSsn'); ?>" placeholder="e.g. 333-33-3333" />
			<?php echo form_error('userSsn'); ?>
		</div> 
		<span class="field">		
			<input class="buttons nextbtn" name="commit" type="button" id="nexttab_3" value="Next">
			<input class="reset_buttons" name="commit" type="button" value="Reset" onclick="clear_form_elements('#tabpage_2')">
		</span>		
    </div>
      
      <div class="tabpage" id="tabpage_3">
          
       <div class="field tooltip" title="Please enter Organization Name.">
			<label for="">Organization Name <span class="required">*</span></label>
			<input name="userOrgName" type="text" value="<?php echo set_value('userOrgName'); ?>" />
			<?php echo form_error('userOrgName'); ?>
		</div>
          
        <div class="field tooltip" title="Please enter your Office Phone.">
			<label for="">Office Phone <span class="required">*</span></label>
			<input name="userOfficePhone" type="text" value="<?php echo set_value('userOfficePhone'); ?>" placeholder="e.g. 222-222-2222" />
			<?php echo form_error('userOfficePhone'); ?>
		</div>
    
        <div class="field tooltip" title="Please enter Office Address.">
			<label for="">Office Address Line#1 <span class="required">*</span></label>
			<input name="userOfficeAddressL1" type="text" value="<?php echo set_value('userOfficeAddressL1'); ?>" placeholder="apartment, suite, unit, building, floor, etc."/>
			<?php echo form_error('userOfficeAddressL1'); ?>
		</div>
        <div class="field tooltip" title="Please enter your Address.">
			<label for="">Office Address Line#2 <span class="required">*</span></label>	
			<input name="userOfficeAddressL2" type="text" value="<?php echo set_value('userOfficeAddressL2'); ?>" placeholder=" street address, P.O. box, etc."/>
			<?php echo form_error('userOfficeAddressL2'); ?>
		</div>
		<div class="field tooltip" title="Please enter office City Name.">
			<label for="">Office City <span class="required">*</span></label>	
			<input name="userOfficeCity" type="text" value="<?php echo set_value('userOfficeCity'); ?>" />
            <?php echo form_error('userOfficeCity'); ?>
		</div>	
                
       <div class="field tooltip" title="Please select office State.">
			<label for="">Office State <span class="required">*</span></label>				
			<select name="userOfficeState" id="userState">
				<option value="">Select Your State</option>		
				<?php foreach ($states_list as $item):?>
						<option value="<?php echo $item->state_id ;?>" <?php echo set_select('userOfficeState', $item->state_id); ?> ><?php echo $item->state_name;?></option>	
				<?php endforeach;?>											
			</select>
			<?php echo form_error('userOfficeState'); ?>	
		</div>		                
		<div class="field tooltip" title="Please enter office Zip Code.">
			<label for="">Office Zip Code <span class="required">*</span></label>
			<input name="userOfficeZipCode" type="text" value="<?php echo set_value('userOfficeZipCode'); ?>" />
			<?php echo form_error('userOfficeZipCode'); ?>
		</div>
		<span class="field">		
			<input class="buttons nextbtn" name="commit" type="button" id="nexttab_4" value="Next">
			<input class="reset_buttons" name="commit" type="button" value="Reset" onclick="clear_form_elements('#tabpage_3')">
		</span>	
        </div>
      <div class="tabpage" id="tabpage_4">
          
         <div class="field tooltip" title="Please enter contact person first name.">
			<label for="">Contact Person One: First Name <span class="required">*</span></label>
			<input name="cPersonOneFirstName" type="text" value="<?php echo set_value('cPersonOneFirstName'); ?>" />
			<?php echo form_error('cPersonOneFirstName'); ?>
		</div>
        <div class="field tooltip" title="Please enter contact person last name.">
			<label for="">Contact Person One: Last Name <span class="required">*</span></label>	
			<input name="cPersonOneLastName" type="text" value="<?php echo set_value('cPersonOneLastName'); ?>" />
			<?php echo form_error('cPersonOneLastName'); ?>
		</div>
		<div class="field tooltip" title="Please enter contact person Suffix (Sr., Jr., III).">
			<label for="">Contact Person One: Suffix <span class="required">*</span></label>	
			<input name="cPersonOneSuffix" type="text" value="<?php echo set_value('cPersonOneSuffix'); ?>" />
            <?php echo form_error('cPersonOneSuffix'); ?>
		</div>          
        <div class="field tooltip" title="Please enter contact person email address.">
			<label for="">Contact Person One: Email Address <span class="required">*</span></label>	
			<input id="userEmail" name="cPersonOneEmail" type="text" value="<?php echo set_value('cPersonOneEmail'); ?>" placeholder="e.g. abc@example.com"/>	
			<?php echo form_error('cPersonOneEmail'); ?>				
		</div>          
       <div class="field tooltip" title="Please enter contact person designation.">
			<label for="">Contact Person One: Title <span class="required">*</span></label>	
			<input id="userEmail" name="cPersonOneDeg" type="text" value="<?php echo set_value('cPersonOneDeg'); ?>" />	
			<?php echo form_error('cPersonOneDeg'); ?>				
		</div>          
        <div class="field tooltip" title="Please enter contact person first name.">
			<label for="">Contact Person Two: First Name</label>
			<input name="cPersonTwoFirstName" type="text" value="<?php echo set_value('cPersonTwoFirstName'); ?>" />
			<?php echo form_error('cPersonTwoFirstName'); ?>
		</div>
		<div class="field tooltip" title="Please enter contact person last name.">
			<label for="">Contact Person Two: Last Name </label>	
			<input name="cPersonTwoLastName" type="text" value="<?php echo set_value('cPersonTwoLastName'); ?>" />
			<?php echo form_error('cPersonTwoLastName'); ?>
		</div>
		<div class="field tooltip" title="Please enter contact person Suffix (Sr., Jr., III).">
			<label for="">Contact Person Two: Suffix </label>	
			<input name="cPersonTwoSuffix" type="text" value="<?php echo set_value('cPersonTwoSuffix'); ?>" />
            <?php echo form_error('cPersonTwoSuffix'); ?>
		</div>                
        <div class="field tooltip" title="Please enter contact person email address.">
			<label for="">Contact Person Two: Email Address </label>	
			<input id="userEmail" name="cPersonTwoEmail" type="text" value="<?php echo set_value('cPersonTwoEmail'); ?>" placeholder="e.g. abc@example.com"/>	
			<?php echo form_error('cPersonTwoEmail'); ?>				
		</div>          
        <div class="field tooltip" title="Please enter contact person designation.">
			<label for="">Contact Person Two: Title </label>	
			<input id="userEmail" name="cPersonTwoDeg" type="text" value="<?php echo set_value('cPersonTwoDeg'); ?>" />	
			<?php echo form_error('cPersonTwoDeg'); ?>				
		</div>
        <span class="field">		
			<input class="buttons nextbtn" name="commit" type="button" id="nexttab_5" value="Next">
			<input class="reset_buttons" name="commit" type="button" value="Reset" onclick="clear_form_elements('#tabpage_4')">
		</span>
    </div>
      
      <div class="tabpage" id="tabpage_5">     
        <div class="field smallselect tooltip" title="Please select your Lease Start date.">
			<label for="">Lease Start date  <span class="required">*</span></label>									
			<input id="userLeaseStartDate-datepicke" name="userLeaseStartDate" type="text" value="<?php echo set_value('userLeaseStartDate'); ?>" placeholder="in mm/dd/yyyy format only" />
			<?php echo form_error('userLeaseStartDate'); ?>
                        
                        <script>
                            $(function() {
                                $( "#userLeaseStartDate-datepicke" ).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat:"mm/dd/yy", 
                                    //showOn: "button",
                                    //buttonImage: "<?php echo base_url();?>includes/images/calendar.png",
                                    //buttonImageOnly: true,	
                                    maxDate: "-1D",
                                    numberOfMonths: 3
                                });
                            });	
                        </script>
		</div>				
		<div class="field smallselect tooltip" title="Please select your Lease End Date.">
			<label for="">Lease End Date<span class="required">*</span></label>								
			<input id="userLeaseEndDate-datepicke" name="userLeaseEndDate" type="text" value="<?php echo set_value('userLeaseEndDate'); ?>" placeholder="in mm/dd/yyyy format only" />
			<?php echo form_error('userLeaseEndDate'); ?>
                        
                        <script>
                            $(function() {
                                $( "#userLeaseEndDate-datepicke" ).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat:"mm/dd/yy", 
                                    //showOn: "button",
                                    //buttonImage: "<?php echo base_url();?>includes/images/calendar.png",
                                    //buttonImageOnly: true,	
                                    minDate: "+1D",
                                    numberOfMonths: 3
                                });
                            });	
                        </script>
		</div>	
          
		<div class="field tooltip" title="Please enter monthly lease amount.">
			<label for="">Monthly Lease Amount <span class="required">*</span></label>	
			<input id="userMonthlyLeaseAmount " name="userMonthlyLeaseAmount" type="text" value=""/>	
			<?php echo form_error('userMonthlyLeaseAmount'); ?>
		</div>				
		<div class="field smallselect tooltip" title="Please select enter Rent Due Date.">
			<label for="">Rent Due Date<span class="required">*</span></label>					
			<input name="userRentDueDate" class="date_picker" id="userRentDueDate" type="text" value="<?php echo set_value('userRentDueDate'); ?>" placeholder="in mm-dd-yyyy format only" />
			<?php echo form_error('userRentDueDate'); ?>
		</div>	
		<span class="field">		
			<input class="buttons nextbtn" name="commit" type="button" id="nexttab_6" value="Next">
			<input class="reset_buttons" name="commit" type="button" value="Reset" onclick="clear_form_elements('#tabpage_5')">
		</span>
    </div> 
      
    <div class="tabpage" id="tabpage_6">     
        <div class="field">
            <div class="box">			
                    <p>You are almost done! Double check everything you typed in, and after agreeing to our Terms of Service, click the button to create your account and start using Inspire Credit! We hope you like it!</p>			
                    <input class="checkbox left" name="userTos" type="checkbox" value="1" /> <label for="">I agree with Inspire Credit  <?php echo anchor('terms_of_use', 'Terms of use') ?> </label>
            </div>
            <?php echo form_error('userTos'); ?>	
        </div>    

        <div class="field">
                <h3>We'll send you an email right now. Please click the link in the email to activate your account.</h3>
                <input class="buttons" name="commit" onclick="if (window.hiddenCommit) { window.hiddenCommit.setAttribute('value', this.value); }else { hiddenCommit = document.createElement('input');hiddenCommit.type = 'hidden';hiddenCommit.value = this.value;hiddenCommit.name = this.name;this.form.appendChild(hiddenCommit); }this.setAttribute('originalValue', this.value);this.disabled = true;this.value='Creating account...';result = (this.form.onsubmit ? (this.form.onsubmit() ? this.form.submit() : false) : this.form.submit());if (result == false) { this.value = this.getAttribute('originalValue');this.disabled = false; }return result;" type="submit" value="Create my account" />
        </div>        
    </div>
   </div>
    <?php echo form_close(); ?>	
    </div>
   </div>    
  </div>
</div>


<script>
$(document).ready(function(){
   $("#tabContainer").acidTabs();
 });
</script>
