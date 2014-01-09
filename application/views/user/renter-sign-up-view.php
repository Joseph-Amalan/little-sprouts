<?php $this->template->add_css('includes/styles/tabs.css'); ?>
<?php $this->session->set_userdata('userRoleId',1);?>



<div class="left ">
	<div class="main-internal">	
	<h2><span>Renter</span> Sign Up</h2>
	Already have account! <a href="<?php echo base_url();?>login">Login Here</a> | Forgot Password? <a href="<?php echo base_url();?>forgot_password">click here</a> <br/><br/>
        	
	<div id="wrapper">  
		<div id="tabContainer">
			<div class="tabs">
				<ul>
				  <?php /* <li id="tabHeader_1" <?php if($page==1){ echo 'class="tabActiveHeader"';}?> ><a href="<?php echo base_url();?>renter/sign_up/create_account"><h3>Create your account</h3></a></li>
				  <li id="tabHeader_2" <?php if($page==2){ echo 'class="tabActiveHeader"';}?> ><?php if($this->session->userdata('about_you') == "active"){ echo '<a href="'.base_url().'renter/sign_up/about_you"><h3>About You</h3></a>'; }else { echo '<h3>About You</h3>';} ?></li>
				  <li id="tabHeader_3" <?php if($page==3){ echo 'class="tabActiveHeader"';}?> ><?php if($this->session->userdata('lease_info') == "active"){ echo '<a href="'.base_url().'renter/sign_up/lease_info"><h3>Lease Info</h3></a>'; }else { echo '<h3>Lease Info</h3>';} ?></li>
				  <li id="tabHeader_4" <?php if($page==4){ echo 'class="tabActiveHeader"';}?> ><?php if($this->session->userdata('payment_info') == "active"){ echo '<a href="'.base_url().'renter/sign_up/payment_info"><h3>Payment Info</h3></a>'; }else { echo '<h3>Payment Info</h3>';} ?></li>
				  <li id="tabHeader_5" <?php if($page==5){ echo 'class="tabActiveHeader"';}?> ><?php if($this->session->userdata('review') == "active"){ echo '<a href="'.base_url().'renter/sign_up/review"><h3>Review</h3></a>'; }else { echo '<h3>Review</h3>';} ?></li>
				  <li id="tabHeader_6" <?php if($page==6){ echo 'class="tabActiveHeader"';}?>><h3>Done</h3></li>
				*/ ?>
				  <li id="tabHeader_1" <?php if($page==1){ echo 'class="tabActiveHeader"';}?> ><h3>Create your account</h3></li>
				  <li id="tabHeader_2" <?php if($page==2){ echo 'class="tabActiveHeader"';}?> ><h3>About You</h3></li>
				  <li id="tabHeader_3" <?php if($page==3){ echo 'class="tabActiveHeader"';}?> ><h3>Lease Info</h3></li>
				  <li id="tabHeader_4" <?php if($page==4){ echo 'class="tabActiveHeader"';}?> ><h3>Payment Info</h3></li>
				  <li id="tabHeader_5" <?php if($page==5){ echo 'class="tabActiveHeader"';}?> ><h3>Review</h3></li>
				  <li id="tabHeader_6" <?php if($page==6){ echo 'class="tabActiveHeader"';}?>><h3>Done</h3></li>
								
				</ul>
			</div>
			<div class="bg"></div> 
			<div class="tabscontent">                            
				<?php switch($page) { 
					
					case '1': 
					default: 
				?>                            
				<?php 
					$attributes = array('id' => 'renterSignUp1','name' => 'renterSignUp1','class' => 'forms'); 
					echo form_open('renter/sign_up/create_account', $attributes); 
				 ?>
				<div class="tabpage" id="tabpage_1">
                                    
					<div class="field tooltip" title="Please enter your first name.">
						<label for=""> First Name: <span class="required">*</span></label>
						<input name="userFirstName" type="text" value="<?php echo set_value('userFirstName') ? set_value('userFirstName') : $this->session->userdata('userFirstName'); ?>" />
						<?php echo form_error('userFirstName'); ?>
					</div>
					<div class="field tooltip" title="Please enter your Middle name.">
						<label for=""> MI </label>
						<input name="userMiddleName" type="text" value="<?php echo set_value('userMiddleName') ? set_value('userMiddleName') : $this->session->userdata('userMiddleName'); ?>" />
						<?php echo form_error('userMiddleName'); ?>
					</div>
					<div class="field tooltip" title="Please enter your last name.">
						<label for=""> Last Name: <span class="required">*</span></label>	
						<input name="userLastName" type="text" value="<?php echo set_value('userLastName') ? set_value('userLastName') : $this->session->userdata('userLastName'); ?>" />
						<?php echo form_error('userLastName'); ?>
					</div>
					<div class="field tooltip" title="Please enter your Suffix (Sr., Jr., III).">
						<label for=""> Suffix (Jr, II, III) </label>	
						<input name="userSuffix" type="text" value="<?php echo set_value('userSuffix') ? set_value('userSuffix') : $this->session->userdata('userSuffix'); ?>" />
						<?php echo form_error('userSuffix'); ?>
					</div>                                    
					<div class="field tooltip" title="Please enter your Preferred name.">
						<label for=""> Preferred name (what you'd like us to call you if we need to get in touch) <span class="required">*</span></label>	
						<input name="userPreferredName" type="text" value="<?php echo set_value('userPreferredName') ? set_value('userPreferredName') : $this->session->userdata('userPreferredName'); ?>" />
						<?php echo form_error('userPreferredName'); ?>
					</div>                                    
				    <div class="field tooltip" title="Please enter your email address.">
						<label for="">Email address: <span class="required">*</span></label>	
						<input name="userEmail" type="text" value="<?php echo set_value('userEmail') ? set_value('userEmail') : $this->session->userdata('userEmail'); ?>" />	
						<?php echo form_error('userEmail'); ?>				
					</div>                                    
					<div class="field tooltip" title="Please re-enter your same Email Address as above.">
						<label for="">Email address: (confirm)  <span class="required">*</span></label>	
						<input name="userConfEmail" type="text" id="textbox_id" value="<?php echo set_value('userConfEmail') ? set_value('userConfEmail') : $this->session->userdata('userConfEmail'); ?>" />
						<?php echo form_error('userConfEmail'); ?>
					</div>    
					<div class="field tooltip" title="Please enter your email address.">
						<label for="">Username: <span class="required">*</span></label>	
						<input id="username" name="username" type="text" value="<?php echo set_value('username') ? set_value('username') : $this->session->userdata('username'); ?>" />	
						<?php echo form_error('username'); ?>				
					</div>   					
					<div class="field tooltip" title="Please enter your Password.">
						<label for="">Create password <span class="required">*</span></label>					
						<input id="userPassword" name="userPassword" type="password" type="text" value="<?php echo set_value('userPassword') ? set_value('userPassword') : $this->session->userdata('userPassword'); ?>" />
						<?php echo form_error('userPassword'); ?>
					</div>                                    
					<div class="field tooltip" title="Please re-enter your same Password as above.">
						<label for="">Confirm password <span class="required">*</span></label>	
						<input id="userConfPassword" name="userConfPassword" type="password" value="<?php echo set_value('userConfPassword') ? set_value('userConfPassword') : $this->session->userdata('userConfPassword'); ?>" />
						<?php echo form_error('userConfPassword'); ?>
					</div>	
					<div class="field">						
						<input type="submit" class="buttons" name="commit" value="continue" />
                        <?php if(($this->session->userdata('done') != "active") && ($this->session->userdata('reviewbtn'))) {?> 
							<input type="submit" class="buttons" name="commit" value="submit review" /> 
						<?php } ?>
					</div>            
				</div>
				<?php echo form_close(); ?>
				
				<?php 
					break; 
					case '2': 
					// Display 2nd Page Form 
				 ?> 
				
				<?php 
				$attributes = array('id' => 'renterSignUp2','name' => 'renterSignUp2','class' => 'forms'); 
				echo form_open('renter/sign_up/about_you', $attributes); 
				 ?>

				<div class="tabpage" id="tabpage_2">  
					 <h3>Welcome <?php echo $this->session->userdata('userPreferredName'); ?>!</h3>
					 <p>Congratulations on taking the first step toward building your credit.</p>
					 <p> The next few pages will guide you through setting up your Inspire Credit account so<br/>
						your payment will reach your landlord on-time...every time and so we can accurately<br/>
						report your payments to the credit bureau.</p>
					 <p>First, please tell us a little bit about you.</p><br/>
							
					<div class="field tooltip" title="Please enter your Mobile No.">
						<label for=""> Mobile Phone <span class="required">*</span></label>
						<input name="userMobileNo" type="text" class="mobilephone" value="<?php echo set_value('userMobileNo') ? set_value('userMobileNo') : $this->session->userdata('userMobileNo'); ?>" placeholder="XXX-XXX-XXXX" />
						<?php echo form_error('userMobileNo'); ?>
					</div>	
                                        
                    <div class="field tooltip" title="Please enter your Home Phone.">
						<label for=""> Home Phone <span class="required">*</span></label>
						<input name="userHomePhone" type="text" class="homephone" value="<?php echo set_value('userHomePhone') ? set_value('userHomePhone') : $this->session->userdata('userHomePhone'); ?>" placeholder="XXX-XXX-XXXX" />
						<?php echo form_error('userHomePhone'); ?>
					</div>
                                        
                   <div class="field tooltip" title="Please enter your Work Phone.">
						<label for=""> Work Phone <span class="required">*</span></label>
						<input name="userWorkPhone" type="text" class="workphone" value="<?php echo set_value('userWorkPhone') ? set_value('userWorkPhone') : $this->session->userdata('userWorkPhone'); ?>" placeholder="XXX-XXX-XXXX" />
						<?php echo form_error('userWorkPhone'); ?>
					</div>
					<div class="field tooltip" title="Please enter your Social Security number.">
						<label for=""> Social Security Number <span class="required">*</span></label>
						<input name="userSsn" type="text" class="ssn" value="<?php echo set_value('userSsn') ? set_value('userSsn') : $this->session->userdata('userSsn'); ?>" placeholder="XXX-XX-XXXX" />
						<?php echo form_error('userSsn'); ?>
					</div>	
					<div class="field tooltip" title="Please enter your date of birth.">
						<label for=""> Birthdate <span class="required">*</span></label>						
						<div><input id="userDob-datepicke" name="userDob" type="text" value="<?php echo set_value('userDob') ? set_value('userDob') : $this->session->userdata('userDob'); ?>" placeholder="in mm/dd/yyyy" /></div>
						<?php echo form_error('userDob'); ?>
						 <script>
	
							$(function() { 
								$( "#userDob-datepicke" ).datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat:"mm/dd/yy", 
									//showOn: "button",
									//buttonImage: "<?php echo base_url();?>includes/images/calendar.png",
									//buttonImageOnly: true,	
									minDate: "-100Y", maxDate: "-13Y",
									numberOfMonths: 1
								});
							});	
						</script>
					</div>					     
                    <div class="field">						
						<a class="buttons" href="<?php echo base_url()?>renter/sign_up/create_account">back</a> | 
						<input type="submit" class="buttons" name="commit" value="continue" />
                         <?php if(($this->session->userdata('done') != "active") && ($this->session->userdata('reviewbtn'))) {?> 
						<input type="submit" class="buttons" name="commit" value="submit review" /> 
						<?php } ?>
					</div>            
				</div>
				<?php echo form_close(); ?>
				
				<?php 
					break; 
					case '3': 
					// Display 3rd Page Form 
				 ?> 
				
				<?php 
				$attributes = array('id' => 'renterSignUp3','name' => 'signUp3','class' => 'forms'); 
				echo form_open('renter/sign_up/lease_info', $attributes); 
				 ?>

				<div class="tabpage" id="tabpage_3">
                                    
					 <h3>Thanks for the information about you, <?php echo $this->session->userdata('userPreferredName'); ?>.</h3>
					 <p>Now we’ll need to gather some information about your lease. It’s often handy to have <br/>
						the lease contract in front of you since your landlord will have to verify the <br/>
						information as being correct.</p>
					 
					 <h2>Rental property information:</h2>
					<div class="field tooltip" title="Please enter Street address.">
						<label for="">Street Address <span class="required">*</span></label>
						<input name="userAddressL1" type="text" value="<?php echo set_value('userAddressL1') ? set_value('userAddressL1') : $this->session->userdata('userAddressL1'); ?>" placeholder="Street address" />
						<?php echo form_error('userAddressL1'); ?>
					</div>
					<div class="field tooltip" title="Please enter your Apartment/unit/suite number.">
						<label for="">Apt/Ste/Unit </label>	
						<input name="userAddressL2" type="text" value="<?php echo set_value('userAddressL2') ? set_value('userAddressL2') : $this->session->userdata('userAddressL2'); ?>" placeholder="Apt/ste/unit" />
						<?php echo form_error('userAddressL2'); ?>
					</div>
					<div class="field tooltip" title="Please enter your City Name.">
						<label for=""> City <span class="required">*</span></label>	
						<input name="userCity" type="text" value="<?php echo set_value('userCity') ? set_value('userCity') : $this->session->userdata('userCity'); ?>" />
						<?php echo form_error('userCity'); ?>
					</div>                
					<div class="field tooltip" title="Please select your State.">
						<label for="">State <span class="required">*</span></label>				
						<select name="userState" id="userState">
							<option value="">Select Your State</option>		
							<?php foreach ($states_list as $item):?>
									<option value="<?php echo $item->state_id ;?>" <?php echo set_select('userState', $item->state_id); ?> <?php if($this->session->userdata('userState') == $item->state_id){ echo 'selected';}?> ><?php echo $item->state_name;?></option>	
							<?php endforeach;?>											
						</select>
						<?php echo form_error('userState'); ?>	
					</div>		                
					<div class="field tooltip" title="Please enter your Zip Code.">
						<label for=""> Zip <span class="required">*</span></label>
						<input name="userZipCode" type="text" value="<?php echo set_value('userZipCode') ? set_value('userZipCode') : $this->session->userdata('userZipCode'); ?>" />
						<?php echo form_error('userZipCode'); ?>
					</div>	
                                     
					<div class="bg"></div>  					
					<h2>Lease information:</h2>
									
					<div class="field smallselect tooltip" title="Please select your Lease Start date.">
						<label for="">Lease Start date  <span class="required">*</span></label>			
						
						<div><input id="userLeaseStartDate-datepicke" name="userLeaseStartDate" class="date_picker" type="text" value="<?php echo set_value('userLeaseStartDate') ? set_value('userLeaseStartDate') : $this->session->userdata('userLeaseStartDate'); ?>" placeholder="MM/DD/YYYY" /></div>
						<?php echo form_error('userLeaseStartDate'); ?>
						 <script>
							$(function() {
								$( "#userLeaseStartDate-datepicke").datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat:"mm/dd/yy", 
									//showOn: "button",
									//buttonImage: "<?php echo base_url();?>includes/images/calendar.png",
									//buttonImageOnly: true,	
									maxDate: "-1D",
									numberOfMonths: 1
								});
							});	
						</script>
					</div>				
					<div class="field smallselect tooltip" title="Please select your Lease End Date.">
						<label for="">Lease End Date<span class="required">*</span></label>								
						<input id="userLeaseEndDate-datepicke" name="userLeaseEndDate" class="date_picker" id="userLeaseEndDate" type="text" value="<?php echo set_value('userLeaseEndDate') ? set_value('userLeaseEndDate') : $this->session->userdata('userLeaseEndDate'); ?>" placeholder="MM/DD/YYYY" />
						<?php echo form_error('userLeaseEndDate'); ?>
						 <script>
							$(function() {
								$("#userLeaseEndDate-datepicke").datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat:"mm/dd/yy", 
									//showOn: "button",
									//buttonImage: "<?php echo base_url();?>includes/images/calendar.png",
									//buttonImageOnly: true,	
									minDate: "+1D",
									numberOfMonths: 1
								});
							});	
						</script>
					</div>				
					<div class="field tooltip" title="Please enter monthly lease amount.">
						<label for="">Monthly Lease Amount <span class="required">*</span></label>	
						<input id="userMonthlyLeaseAmount " name="userMonthlyLeaseAmount" type="text" value="<?php echo set_value('userMonthlyLeaseAmount') ? set_value('userMonthlyLeaseAmount') : $this->session->userdata('userMonthlyLeaseAmount'); ?>"/>	
						<?php echo form_error('userMonthlyLeaseAmount'); ?>
					</div>				
					<div class="field smallselect tooltip" title="Please select enter Rent Due Date.">
						<label for="">Rent Due Date<span class="required">*</span></label>					
						<!--<input name="userRentDueDate" class="date_picker" id="userRentDueDate" type="text" value="<?php //echo set_value('userRentDueDate') ? set_value('userRentDueDate') : $this->session->userdata('userRentDueDate'); ?>" placeholder="in mm-dd-yyyy format only" />-->
                                                
						<select name="userRentDueDate" id="userState">
							<option value="">Select Your Rent Due Date</option>		
							<?php for( $i = 1; $i < 31 ; $i++) { ?>
								<option value="<?php echo $i ;?>" <?php echo set_select('userRentDueDate', $i); ?> <?php if($this->session->userdata('userRentDueDate') == $i){ echo 'selected';}?> ><?php echo $i;?></option>	
							<?php }?>											
						</select> Which day of the month is the rent due?
								  This is the date that Inspire
								  will deliver your funds to your landlord.
						<?php echo form_error('userRentDueDate'); ?>
					</div>	
                                        
					<div class="bg"></div> 
					
					<h2>Landlord/property manager information:</h2>						
					<div class="field tooltip" title="Please enter Landlord/Manager first name.">
						<label for=""> First Name (Landlord/Manager)<span class="required">*</span></label>
						<input name="landlordFirstName" type="text" value="<?php echo set_value('landlordFirstName') ? set_value('landlordFirstName') : $this->session->userdata('landlordFirstName'); ?>" />
						<?php echo form_error('landlordFirstName'); ?>
					</div>
					
					<div class="field tooltip" title="Please enter Landlord/Manager last name.">
						<label for=""> Last Name (Landlord/Manager)<span class="required">*</span></label>	
						<input name="landlordLasttName" type="text" value="<?php echo set_value('landlordLasttName') ? set_value('landlordLasttName') : $this->session->userdata('landlordLasttName'); ?>" />
						<?php echo form_error('landlordLasttName'); ?>
					</div>
                    <div class="field tooltip" title="Please enter Landlord/Manager phone.">
						<label for="">Phone (Landlord/Manager)<span class="required">*</span></label>					
						<input name="landlordPhone" type="text" class="landlordPhone" type="text" value="<?php echo set_value('landlordPhone') ? set_value('landlordPhone') : $this->session->userdata('landlordPhone'); ?>" placeholder="xxx-xxx-xxxx" />
						<?php echo form_error('landlordPhone'); ?>
					</div>	                    
                    <div class="field tooltip" title="Please enter Landlord/Manager email address.">
						<label for=""> Email Landlord/Manager<span class="required">*</span></label>	
						<input id="landlordEmail" name="landlordEmail" type="text" value="<?php echo set_value('landlordEmail') ? set_value('landlordEmail') : $this->session->userdata('landlordEmail'); ?>"/>	
						<?php echo form_error('landlordEmail'); ?>				
					</div>							                    
                    <div class="field tooltip" title="Please enter Landlord/Manager email address.">
						<label for=""> Email (Confirm) Landlord/Manager <span class="required">*</span></label>	
						<input name="landlordConfEmail" id="textbox_id" type="text" value="<?php echo set_value('landlordConfEmail') ? set_value('landlordConfEmail') : $this->session->userdata('landlordConfEmail'); ?>"/>	
						<?php echo form_error('landlordConfEmail'); ?>				
					</div>

					<div class="field tooltip" title="Please enter Landlord/Manager first name.">
						<label for=""> Management Company Name<span class="required">*</span></label>
						<input name="landlordPropertyName" type="text" value="<?php echo set_value('landlordPropertyName') ? set_value('landlordPropertyName') : $this->session->userdata('landlordPropertyName'); ?>" />
						<?php echo form_error('landlordPropertyName'); ?>
					</div>
					
					<div class="bg"></div> 
					
					<h2>Landlord/property manager billing adress:</h2>	
					This is where you mail your rent check <br/><br/>
					
					<div class="field tooltip" title="Please enter Street address.">
						<label for="">Street Address <span class="required">*</span></label>
						<input name="landlordAddressL1" type="text" value="<?php echo set_value('landlordAddressL1') ? set_value('landlordAddressL1') : $this->session->userdata('landlordAddressL1'); ?>" placeholder="Street address" />
						<?php echo form_error('landlordAddressL1'); ?>
					</div>
					<div class="field tooltip" title="Please enter your Apartment/unit/suite number.">
						<label for="">Apt/Ste/Unit </label>	
						<input name="landlordAddressL2" type="text" value="<?php echo set_value('landlordAddressL2') ? set_value('landlordAddressL2') : $this->session->userdata('landlordAddressL2'); ?>" placeholder="Apt/ste/unit" />
						<?php echo form_error('landlordAddressL2'); ?>
					</div>
					<div class="field tooltip" title="Please enter your City Name.">
						<label for=""> City <span class="required">*</span></label>	
						<input name="landlordCity" type="text" value="<?php echo set_value('landlordCity') ? set_value('landlordCity') : $this->session->userdata('landlordCity'); ?>" />
						<?php echo form_error('landlordCity'); ?>
					</div>                
					<div class="field tooltip" title="Please select your State.">
						<label for="">State <span class="required">*</span></label>				
						<select name="landlordState" id="landlordState">
							<option value="">Select Your State</option>		
							<?php foreach ($states_list as $item):?>
									<option value="<?php echo $item->state_id ;?>" <?php echo set_select('landlordState', $item->state_id); ?> <?php if($this->session->userdata('landlordState') == $item->state_id){ echo 'selected';}?> ><?php echo $item->state_name;?></option>	
							<?php endforeach;?>											
						</select>
						<?php echo form_error('landlordState'); ?>	
					</div>		                
					<div class="field tooltip" title="Please enter your Zip Code.">
						<label for=""> Zip <span class="required">*</span></label>
						<input name="landlordZipCode" type="text" value="<?php echo set_value('landlordZipCode') ? set_value('landlordZipCode') : $this->session->userdata('landlordZipCode'); ?>" />
						<?php echo form_error('landlordZipCode'); ?>
					</div>	
						
					<div class="field">						
						<a class="buttons" href="<?php echo base_url()?>renter/sign_up/about_you">back</a> | 
						<input type="submit" class="buttons" name="commit" value="continue" />
                     <?php if(($this->session->userdata('done') != "active") && ($this->session->userdata('reviewbtn'))) {?> 
					<input type="submit" class="buttons" name="commit" value="submit review" /> <?php } ?>
					</div>            
				</div>
				<?php echo form_close(); ?>				
				<?php 
					break; 
					case '4': 
					// Display 4th Page Form 
				 ?> 
				
				<?php 
				$attributes = array('id' => 'renterSignUp4','name' => 'signUp4','class' => 'forms', 'autocomplete' => "off"); 
				echo form_open('renter/sign_up/payment_info', $attributes); 
				 ?>
				<div class="tabpage" id="tabpage_4">

					 <h3>We’re almost there, <?php echo $this->session->userdata('userPreferredName'); ?></h3>
					 <p>Each month when your rent is due <b>Inspire</b> will automatically withdraw your rent
						payment from your checking or savings account using the automated clearing house
						system (ACH). ACH is a very secure system used by millions of users everyday,
						including major utility companies, banks, and investment companies. Inspire uses ACH
						to transfer your rent payment directly from your checking or savings account into
						your landlord’s account securely and on-time.</p>
					 <p>The information you need includes your bank’s information, the ABA routing code,<br/>
						and your account number. You can find this information on your check.</p><br/><br/>
                                     					
					<div class="field tooltip" title="Please enter your Bank name.">
						<label for="">Bank name <span class="required">*</span></label>	
						<input name="userBankName" type="text" value="<?php echo set_value('userBankName') ? set_value('userBankName') : $this->session->userdata('userBankName'); ?>" />
						<?php echo form_error('userBankName'); ?>
					</div>
                    <div class="field tooltip" title="Please enter ABA Routing Number.">
						<label for="">ABA Routing Number <span class="required">*</span></label>
						<input name="userRoutingNumber" type="text" value="<?php echo set_value('userRoutingNumber') ? set_value('userRoutingNumber') : $this->session->userdata('userRoutingNumber'); ?>" />
						<?php echo form_error('userRoutingNumber'); ?>
					</div>                                     
                    <div class="field tooltip" title="Please enter ABA Routing Number.">
						<label for="">Confirm ABA Routing Number <span class="required">*</span>  (We want to make sure we got it right. Please input the information once more.) </label>
						<input name="userConfRoutingNumber" type="text" value="<?php echo set_value('userConfRoutingNumber') ? set_value('userConfRoutingNumber') : $this->session->userdata('userConfRoutingNumber'); ?>" />
						<?php echo form_error('userConfRoutingNumber'); ?>
					</div>                                     
					<div class="field tooltip" title="Please enter Account Number.">
						<label for="">Account Number <span class="required">*</span></label>
						<input name="userAccountNumber" type="text" value="<?php echo set_value('userAccountNumber') ? set_value('userAccountNumber') : $this->session->userdata('userAccountNumber'); ?>" />
						<?php echo form_error('userAccountNumber'); ?>
					</div>                                     
                    <div class="field tooltip" title="Please enter Account Number.">
						<label for="">Confirm Account Number <span class="required">*</span>  (We want to make sure we got it right. Please input the information once more.)</label>
						<input name="userConfAccountNumber" type="text" value="<?php echo set_value('userConfAccountNumber') ? set_value('userConfAccountNumber') : $this->session->userdata('userConfAccountNumber'); ?>" />
						<?php echo form_error('userConfAccountNumber'); ?>
					</div>					
					<div class="field tooltip">
						<label for="" style="float:left; width:150px;"> Account Type  <span class="required">*</span></label>  
						
						<input type="radio" name="userAccountType" value="savings" <?php echo set_radio('userAccountType', 'savings', TRUE); ?> style="float:left; width:20px;" /> 
						<label for="" style="float:left; width:100px; margin:3px 0px 13px 0px; font-weight:13px; color:#444;">Savings Account</label>                                                
						
						<input type="radio" name="userAccountType" value="checking" <?php echo set_radio('userAccountType', 'checking'); ?> style="float:left; width:20px;" />						
						<label for="" style="float:left; width:114px; margin:3px 0px 0px 0px; font-weight:13px; color:#444;">Checking Account</label>                                                
                        <?php echo form_error('userAccountType'); ?>
					</div>		<br/><br/>
					
					<p>By checking the box below, User agrees and authorizes Inspire Credit, Integras Financial.<br/>
						and its partners to withdraw and transfer funds in accordance with the
						<a href="<?php echo base_url()?>">Inspire Credit</a> <br/> <?php echo anchor('terms_of_use', 'Terms of Agreement') ?> and <a href="#">NACHA guidelines</a>
						to include the payment of scheduled rents <br/>and the payment of Inspire Credit service fees, if selected below.

					</p><br/>
                                    
					<div class="field">
						<input class="checkbox left" name="userTos" type="checkbox" value="1" /> 
						<b>I agree to the Inspire Credit ACH Terms of Agreement </b>
						<?php echo form_error('userTos'); ?>	
					</div>

					<h2>Inspire Credit Fees</h2>	
					<p>Choose your payment options below</p>
					
					<div class="field">
						<div class="box inspire_fees"> 
							<input type="radio" name="serviceFees" value="$59.50" <?php echo set_radio('serviceFees', '$59.50'); ?> class="checkbox left" /> 
							$59.50 for one full year - Get 2 months FREE!
								<br/><br/>
							
							<input type="radio" name="serviceFees" value="$5.95" <?php echo set_radio('serviceFees', '$5.95'); ?> class="checkbox left"  />
							$5.95 monthly
							
						</div>
						<div class="box inspire_fees">
							<input type="radio" name="service" value="1" <?php echo set_radio('service', '1'); ?> class="checkbox left"  />
							Withdraw the funds from my checking/savings account
								<br/><br/>
							
							<input type="radio" name="service" value="2" <?php echo set_radio('service', '2'); ?> class="checkbox left"  />
							MasterCard/Visa								
						</div>
					</div>
					<div class="field">
						<?php echo form_error('serviceFees'); ?>	
						<?php echo form_error('service'); ?>	
					</div>
					<div class="field tooltip" title="Discount code.">
							<label for="">Discount code</label>
							<input name="discountCode" type="text" value="<?php echo set_value('discountCode') ? set_value('discountCode') : $this->session->userdata('discountCode'); ?>" />
					</div> 
					<div class="field tooltip" title="Discount code.">
						<label for="" style="color:red">Important: You will NOT be billed until your landlord verifies your lease information 	</label>
					</div> <br/>
					<input type="hidden" class="" name="reviewbtn" value="reviewbtn" />
										
                    <div class="field">						
						<a class="buttons" href="<?php echo base_url()?>renter/sign_up/lease_info">back</a> | 
						<input type="submit" class="buttons" name="commit" value="review" />
                        <!-- <?php //if($this->session->userdata('done') != "active" ){?> <input type="submit" class="buttons" name="commit" value="review" /> <?php //} ?>-->
					</div>            
				</div>
				<?php echo form_close(); ?>
				
				<?php 
					break; 
					case '5': 
					// Display 5th Page Form 
				 ?> 
				
				<?php 
				$attributes = array('id' => 'renterSignUp5','name' => 'signUp5','class' => 'forms'); 
				echo form_open('renter/sign_up/review', $attributes); 
				 ?>
			  
				<div class="tabpage" id="tabpage_5">  
                                    
					<h3>Let’s review.</h3>
					 <p>Please take a look at the information you have completed. Once you’ve verified that it
						is accurate and complete, press Submit to begin your journey to building your credit
						by paying your rent on-time. If you see any areas that need to be corrected, select the
						edit link to make the changes. Once you’ve completed your changes, select the
						Review tab along the top to come back to this page.</p>
					
					 <table class="preview">
						<tr><td colspan="12"><div class="bg"></div></td></tr>
						<tr><td colspan="12"><span>About You</span></td></tr>
						<tr> 
							<td width="20%"><?php echo ucfirst($this->session->userdata('userFirstName'))." ". ucfirst($this->session->userdata('userMiddleName'))." ". ucfirst($this->session->userdata('userLastName')); ?></td> 
							<td width="20%">Social Security Number</td>
							<td width="20%">Birth Date</td> 
							<td width="20%">Mobile: <?php $mobile_no = explode('-', $this->session->userdata('userMobileNo')); echo '(' . $mobile_no[0] . ') ' . $mobile_no[1] . '-' . $mobile_no[2];  ?></td> 
							<td width="15%">&nbsp;</td> 
						</tr>
						<tr> 
							<td width="15%">Prefers: <?php echo $this->session->userdata('userPreferredName'); ?></td> 
							<td width="21%"><?php echo $this->session->userdata('userSsn');?></td>
							<td width="21%"><?php echo $this->session->userdata('userDob');?></td> 
							<td width="23%">Home: <?php $home_no = explode('-', $this->session->userdata('userHomePhone')); echo '(' . $home_no[0] . ') ' . $home_no[1] . '-' . $home_no[2];  ?></td> 
							<td width="15%"><a href="<?php echo base_url();?>renter/sign_up/create_account">Edit</a></td> 
						</tr>	
						<tr> 
							<td width="15%">&nbsp;</td> 
							<td width="21%">&nbsp;</td>
							<td width="21%">&nbsp;</td> 
							<td width="23%">Work: <?php $work_no = explode('-', $this->session->userdata('userWorkPhone')); echo '(' . $work_no[0] . ') ' . $work_no[1] . '-' . $work_no[2];  ?></td> 
							<td width="15%">&nbsp;</td> 
						</tr>			
						
						<tr><td colspan="12"><div class="bg"></div></td></tr>						
					    <tr><td colspan="12"><span>Lease Info</span></td></tr> 

						<tr> 
							<td width="20%">Address: <?php echo $this->session->userdata('userAddressL1') . ' ' . $this->session->userdata('userAddressL2'); ?></td> 
							<td width="20%">Lease Start:
							<?php echo $this->session->userdata('userLeaseStartDate'); ?></td>
							<td width="20%">Lease Payment: <?php echo '$'. $this->session->userdata('userMonthlyLeaseAmount');?></td> 
							<td width="20%">&nbsp;</td> 
							<td width="15%">&nbsp;</td> 
						</tr>	
						<tr> 
							<td width="20%"><?php echo $this->session->userdata('userCity') . ',' . $userState . ' ' . $this->session->userdata('userZipCode'); ?></td> 
							<td width="20%">Lease End: 
							<?php echo $this->session->userdata('userLeaseEndDate'); ?></td>
							<td width="20%">Paid monthly on the day <?php echo $this->session->userdata('userRentDueDate');?> of each month	</td> 
							<td width="20%">&nbsp;</td> 
							<td width="15%">&nbsp;</td> 
						</tr>  
												
						
					    <tr><td colspan="12"><span>Landlord Info</span></td></tr>
						<tr> 
							<td width="28%"><?php echo ucfirst($this->session->userdata('landlordPropertyName')); ?></td> 
							<td width="28%">Address: <?php echo $this->session->userdata('landlordAddressL1')." ". $this->session->userdata('landlordAddressL2'); ?></td>
							<td width="5%">&nbsp;</td>							
							<td width="5%">&nbsp;</td> 
						</tr>
						<tr> 
							<td width="20%"><?php echo ucfirst($this->session->userdata('landlordFirstName')) .' ' . ucfirst($this->session->userdata('landlordLasttName')); ?></td> 
							<td width="20%"><?php echo $this->session->userdata('landlordCity').', '. $landlordState  . ' ' . $this->session->userdata('landlordZipCode'); ?></td>
							<td width="20%">&nbsp;</td>			
							<td width="20%">&nbsp;</td> 							
							<td width="15%"><a href="<?php echo base_url();?>renter/sign_up/lease_info">Edit</a></td> 
						</tr>						
						<tr> 
							<td width="28%"><?php echo $this->session->userdata('landlordEmail'); ?></td> 
							<td width="28%">&nbsp;</td>
							<td width="5%">&nbsp;</td>							
							<td width="5%">&nbsp;</td> 
						</tr>												
						<tr> 
							<td width="28%"><?php echo $this->session->userdata('landlordPhone'); ?></td> 
							<td width="28%">&nbsp;</td>
							<td width="5%">&nbsp;</td>							
							<td width="5%">&nbsp;</td> 
						</tr>
						                                 
						
						<tr><td colspan="12"><div class="bg"></div></td></tr>						
						<tr><td colspan="12"><span>Payments</span></td></tr>                                       
						
						<tr> 
							<td><?php echo $this->session->userdata('userBankName'); ?> <br/>
							ABA Routing: <?php echo $this->session->userdata('userRoutingNumber');?><br/>
							Acct Number: <?php echo $this->session->userdata('userAccountNumber');?><br/>
							Account Type: <?php echo $this->session->userdata('userAccountType');?>	<br/>
							ACH Authorized: <?php if($this->session->userdata('service') == 1) { echo "Yes"; } else { echo "No"; } ?>							
							</td>        
							 <td> 
								Inspire Credit billing<br/>
								One-time ACH withdrawal<br/>
								Annual subscription - 2 months FREE!	
								Amount: <?php echo $this->session->userdata('serviceFees'); ?>					
							 </td>
							 <td width="15%">&nbsp;</td><td width="15%">&nbsp;</td>
							 <td><a href="<?php echo base_url();?>renter/sign_up/payment_info">Edit</a></td>
						</tr> 						
					</table><br/>
					
					<input type="hidden" class="buttons" name="review_hidden" value="continue" />
					<?php echo form_error('review_hidden'); ?>
									
                    <div class="field">						
						<a class="buttons" href="<?php echo base_url()?>renter/sign_up/payment_info">back</a> | 
						<input type="submit" class="buttons" name="commit" value="Submit" />
					</div>         
                                                  
				</div>
				<?php echo form_close(); ?>
				
				<?php 
					break; 
					case '6': 
					// Display 6th Page Form 
				 ?> 
				
				<div class="tabpage" id="tabpage_6">
					
					<?php
					/*
						echo "session values --><pre> ";
						print_r($this->session->all_userdata());
						echo "</pre>"; 
					 * 
					 */                                       
					?>
					   
				   <?php if($this->session->userdata('signup_msg') == 'success'){ ?>
				
					<h3>Congratulations, <?php echo $this->session->userdata('userPreferredName'); ?>!</h3>
					<p>You have successfully submitted your information to begin to build your credit.</p>
					<p>A request will be sent to your landlord / property manager at the email address you provided.
						They will need to verify the lease information as well as tell us where they would like the rent sent. You can assist us by
						letting your landlord or property manager know to expect an email from us.</p>
					<p>Once your landlord verifies the information, you’ll receive a confirmation email.</p>
					
					<?php /******DESTROY SESSION IF SUCCESSFULL, ITS VERY IMPORTANT ******/?>
						<?php $this->session->sess_destroy();?>
					<?php /******HURRY!!! SESSION DESTROYED ******/?>
					
					<?php } elseif($this->session->userdata('signup_msg') == 'error'){ ?>
					
						<h3>Oops, <?php echo $this->session->userdata('userPreferredName'); ?>!</h3>
						<p class="error">Some error occurred while creating an Account, Please try again.</p>
					
					<?php } ?>									
							 
					<br/><br/><br/>
					<div class="field"><br/><br/>
						<ul class="hot_topics">
							<li><strong>Hot Topics</strong></li>
							<li><a href="#">FREE Report: 10 ways to build your credit</a></li>
							<li><a href="#">Budget building the easy way</a></li>
							<li><a href="#">Making a difference in the community around you</a></li>
						</ul>    
					</div>                                           
			    </div>                            
				   <?php break; ?> 
				  <?php } ?>   
			</div>			
		</div>
   </div>    
  </div>
</div>
