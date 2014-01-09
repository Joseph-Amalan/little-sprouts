<?php $this->template->add_css('includes/styles/tabs.css'); ?>
<?php $this->session->set_userdata('userRoleId',2);?>

<div class="left">
	<div class="main-internal">	
		<h2><span>Landlord</span> Sign Up</h2>
		<!--Already have account! <a href="<?php //echo base_url();?>login">Login Here</a> | Forgot Password? <a href="<?php //echo base_url();?>forgot_password">click here</a> <br/><br/>-->
				
		<div id="wrapper">  
			<div id="tabContainer">
				<div class="tabs">
					<ul>
					 <?php /* <li id="tabHeader_1" <?php if($page==1){ echo 'class="tabActiveHeader"';}?> ><a href="<?php echo base_url();?>landlord/create_account"><h3>Create account</h3></a></li> 
					  <li id="tabHeader_2" <?php if($page==2){ echo 'class="tabActiveHeader"';}?> ><?php if($this->session->userdata('confirm_lease') == "active"){ echo '<a href="'.base_url().'landlord/create_account/confirm_lease"><h3>Confirm lease</h3></a>'; }else { echo '<h3>Confirm lease</h3>';} ?></li> */ ?>
					 <li id="tabHeader_1" <?php if($page==1){ echo 'class="tabActiveHeader"';}?> ><h3>Create account</h3></li>
					  <li id="tabHeader_2" <?php if($page==2){ echo 'class="tabActiveHeader"';}?> ><h3>Confirm Lease</h3></li> 
					  <li id="tabHeader_3" <?php if($page==3){ echo 'class="tabActiveHeader"';}?> ><h3>Deposit Information</h3></li>
					  <li id="tabHeader_4" <?php if($page==4){ echo 'class="tabActiveHeader"';}?>><h3>Done</h3></li>
					</ul>
				</div>
				<div class="bg"></div> 
				<div class="tabscontent">                            
					<?php switch($page) { 
						
						case '1': 
						default: 
					?>  
				   Already have an account! <a href="<?php echo base_url()."landlord/confirm_tenant/invitation/".$user_key."/".$renter_email . '/' . $date . '/' . $time; ?>">
				   Login Here to confirm tenant request</a> | Forgot Password? <a href="<?php echo base_url();?>forgot_password">click here</a> <br/><br/>
					<?php 
						$attributes = array('id' => 'landlordSignUp1','name' => 'landlordSignUp1','class' => 'forms'); 
						echo form_open('landlord/create_account', $attributes); 
						
						foreach($landlord_data as $item) {					
					 ?>
					<div class="tabpage" id="tabpage_1">
										
						<div class="field tooltip" title="Please enter your first name.">
							<label for=""> First Name: <span class="required">*</span></label>
							<input name="landlordUFirstName" type="text" value="<?php echo ucfirst($item->landlord_first_name); ?>" />
							<?php echo form_error('landlordUFirstName'); ?>
						</div>
						<div class="field tooltip" title="Please enter your Middle name.">
							<label for=""> MI </label>
							<input name="landlordUMiddleName" type="text" value="<?php echo set_value('landlordUMiddleName') ? set_value('landlordUMiddleName') : $this->session->userdata('landlordUMiddleName'); ?>" />
							<?php echo form_error('landlordUMiddleName'); ?>
						</div>
						<div class="field tooltip" title="Please enter your last name.">
							<label for=""> Last Name: <span class="required">*</span></label>	
							<input name="landlordULastName" type="text" value="<?php echo ucfirst($item->landlord_last_name); ?>" />
							<?php echo form_error('landlordULastName'); ?>
						</div>
						<div class="field tooltip" title="Please enter your Suffix (Sr., Jr., III).">
							<label for=""> Suffix (Jr, II, III) </label>	
							<input name="landlordUSuffix" type="text" value="<?php echo set_value('landlordUSuffix') ? set_value('landlordUSuffix') : $this->session->userdata('landlordUSuffix'); ?>" />
							<?php echo form_error('landlordUSuffix'); ?>
						</div>                                    
						<div class="field tooltip" title="Please enter your Preferred name.">
							<label for=""> Preferred name (what you'd like us to call you if we need to get in touch) <span class="required">*</span></label>	
							<input name="landlordUPreferredName" type="text" value="<?php echo set_value('landlordUPreferredName') ? set_value('landlordUPreferredName') : $this->session->userdata('landlordUPreferredName'); ?>" />
							<?php echo form_error('landlordUPreferredName'); ?>
						</div>
						<div class="field tooltip" title="Please enter Landlord/Manager first name.">
							<label for=""> Property management company name (if applicable): <span class="required">*</span></label>
							<input name="landlordUPropertyName" type="text" value="<?php echo $item->landlord_organization; ?>" />
							<?php echo form_error('landlordUPropertyName'); ?>
						</div>
						
						<div class="field tooltip" title="Please enter your email address.">
							<label for="">Email address: <span class="required">*</span></label>	
							<input id="landlordUEmail" name="landlordUEmail" type="text" value="<?php echo $item->landlord_email ? $item->landlord_email : $this->session->userdata('landlordUEmail'); ?>" />	
							<?php echo form_error('landlordUEmail'); ?>				
						</div>                                    
						<div class="field tooltip" title="Please re-enter your same Email Address as above.">
							<label for="">Email address: (confirm)  <span class="required">*</span></label>	
							<input id="landlordUConfEmail" name="landlordUConfEmail" id="textbox_id" type="text" value="<?php echo set_value('landlordUConfEmail') ? set_value('landlordUConfEmail') : $this->session->userdata('landlordUConfEmail'); ?>" />
							<?php echo form_error('landlordUConfEmail'); ?>
						</div>        
						<div class="field tooltip" title="Please enter your email address.">
							<label for="">Username: <span class="required">*</span></label>	
							<input id="landlordUusername" name="landlordUusername" type="text" value="<?php echo set_value('landlordUusername') ? set_value('landlordUusername') : $this->session->userdata('landlordUusername'); ?>" />	
							<?php echo form_error('landlordUusername'); ?>				
						</div> 
						<div class="field tooltip" title="Please enter your Password.">
							<label for="">Create password <span class="required">*</span></label>					
							<input id="landlordPassword" name="landlordPassword" type="password" type="text" value="<?php echo set_value('landlordPassword'); ?>" />
							<?php echo form_error('landlordPassword'); ?>
						</div>                                    
						<div class="field tooltip" title="Please re-enter your same Password as above.">
							<label for="">Confirm password <span class="required">*</span></label>	
							<input id="landlordConfPassword" name="landlordConfPassword" type="password" value="<?php echo set_value('landlordConfPassword'); ?>" />
							<?php echo form_error('landlordConfPassword'); ?>
						</div>	
						<div class="field">						
							<input type="submit" class="buttons" name="commit" value="continue" />
						</div>            
					</div>
					<?php } echo form_close(); ?>
					
					<?php 
						break; 
						case '2': 
						// Display 2nd Page Form 
					 ?> 
					
					<?php 
					
					if($landlord_data) {
					foreach($landlord_data as $item) {	
					
					$attributes = array('id' => 'landlordSignUp2','name' => 'landlordSignUp2','class' => 'forms'); 
					echo form_open('landlord/create_account/confirm_lease', $attributes); 				
					?>
					<div class="tabpage" id="tabpage_2">                                      
						<h3>Lease review.</h3>
						<p>Please take a look at the information your tenant has submitted. Once you've verified
							that it is accurate and complete, press Verified to acknowledge all information is
							correct If you see any areas that need to be corrected, select the edit link to make
							the changes. Once you've completed your changes, select the Return button to
							return to this page.</p>
							
						<table class="preview">
							<tr><td colspan="12"><div class="bg"></div></td></tr>
							<tr><td colspan="12"><span>About your tenant</span></td></tr>
							<tr> 
								<td width="32%"><?php echo $item->renter_first_name .' '. $item->renter_middle_name . ' '.$item->renter_last_name; ?> </td> 
								<td width="20%">Social Security Number </td>
								<td width="20%">Birth date</td> 
								<td width="25%">Mobile: 
									<?php $mobile_no = explode('-', $item->renter_mobile_no); echo '(' . $mobile_no[0] . ') ' . $mobile_no[1] . '-' . $mobile_no[2];  ?>
								</td> 
							</tr>						
							<tr> 
								<td width="32%">Prefers: <?php echo $item->renter_preferred_name; ?></td> 
								<td width="20%">not viewable</td>
								<td width="20%">not viewable</td> 
								<td width="25%">Home: 
									<?php $home_no = explode('-', $item->renter_home_ph_no); echo '(' . $home_no[0] . ') ' . $home_no[1] . '-' . $home_no[2];  ?>
								</td> 							
								<td></td>
							</tr> 
							<tr> 
								<td width="32%">&nbsp;</td> 
								<td width="20%">&nbsp;</td>
								<td width="20%">&nbsp;</td> 
								<td width="25%">Work:
									<?php $work_no = explode('-', $item->renter_work_ph_no); echo '(' . $work_no[0] . ') ' . $work_no[1] . '-' . $work_no[2];  ?>
								</td> 
							</tr> 
							
							<tr><td colspan="12"><div class="bg"></div></td></tr>						
							<tr><td colspan="12"><span>Lease Info</span></td></tr>  
							
							<tr> 
								<td width="35%">Address: <?php echo $item->renter_address_line_one .' '. $item->renter_address_line_two; ?></td> 
								<td width="25%">Lease Start: <?php $lsd = explode('-', $item->lease_start_date); echo  $lsd[1] . '/' . $lsd[2] . '/' . $lsd[0]; ?></td>
								<td width="20%">Lease Payment: <?php echo '$'. $item->monthly_lease_amount;?></td> 
							</tr> 
							<tr> 
								<td width="32%"> &nbsp;<?php echo $item->renter_city .', '. $item->state_name .' '. $item->renter_zip_code; ?></td> 
								<td width="20%">Lease End: <?php $led = explode('-', $item->lease_end_date); echo  $led[1] . '/' . $led[2] . '/' . $led[0];?></td>
								<td width="20%">Paid monthly on the day <?php echo $item->rent_due_date;?> of each month</td> 
							</tr>  
							
							<tr><td colspan="12"><div class="bg"></div></td></tr>	
																	
							<tr><td colspan="12"><span>Landlord Info</span></td></tr>
							<tr> 
								<td width="32%"><?php echo $item->landlord_organization; ?></td> 
								<td width="20%">Address: <?php echo $item->landlord_off_address_line_one .' '. $item->landlord_off_address_line_two . '.'; ?></td>
								<td width="20%">&nbsp;</td> 
								<td width="20%">&nbsp;</td> 
								<td>&nbsp;</td> 
							</tr> 
							<tr> 
								<td width="32%"><?php echo $item->landlord_first_name . ' ' . $item->landlord_last_name; ?></td> 
								<td width="20%"><?php echo $item->landlord_off_city . ', '. $item->landlord_off_state_name .' '. $item->landlord_off_zipcode; ?></td>
								<td>&nbsp;</td> 
							</tr>  
							<tr> 
								<td width="32%" colspan="3"><a href="mailto:<?php echo $item->landlord_email; ?>"><?php echo $item->landlord_email; ?></a></td> 
							</tr> 						 
							<tr> 
								<td width="32%" colspan="3"><?php echo $item->landlord_phone_no; ?></td> 
							</tr> 
						</table>
					   
					   <br/>  
						
						<input type="hidden" class="buttons" name="confrim_lease" value="continue" />
						<?php echo form_error('confrim_lease_hidden_btn'); ?>
							 
						<div class="field">						
							<a class="buttons" href="<?php echo base_url()?>landlord/create_account">back</a> | 
							<input type="submit" class="buttons" name="commit" value="VERIFIED" />
													
							<a class="thickbox reject_btn" title="Please give reason for rejection" href="<?php echo base_url();?>landlord/lease_agreement/rejected/<?php echo $item->association_id;?>/<?php echo $item->user_email; ?>/<?php echo $this->session->userdata('landlordUusername'); ?>?keepThis=true&TB_iframe=true&height=330&width=480">REJECT</a>
						</div>                                                    
					</div>
					 
					<?php echo form_close(); } } else { ?>
					<div style="color:red"> Rejected Renter Invitation. </div>
					<?php }
					
						break; 
						case '3': 
						// Display 3rd Page Form 
					 ?> 
					
					<?php 
					$attributes = array('id' => 'landlordSignUp3','name' => 'landlordSignUp3','class' => 'forms', 'autocomplete' => "off"); 
					echo form_open('landlord/create_account/deposit_info', $attributes); 
					 ?>
					<div class="tabpage" id="tabpage_3">

						 <h3>Where would you like the deposits sent?</h3>
						 <p>Each month when your tenant's rent is due Inspire will automatically deposit their<br/>
							rent payment from their checking or savings account into your account using the <br/>
							automated clearing house system (ACH). ACH is a very secure system used by <br/>
							millions of users ever day, including major utility companies, banks, and investment <br/>
							companies. Inspire uses ACH to transfer your rent payment directly from your<br/>
							tenant's checking or savings account into your account securely and on-time.</p><br/>
							
						<p>The information you need includes your bank's information, the ABA routing code, <br/>
							and your account number. You can find this information on your check</p>
						<br/>
															
						<div class="field tooltip" title="Please enter your Bank name.">
							<label for="">Bank name <span class="required">*</span></label>	
							<input name="landlordBankName" type="text" value="<?php echo set_value('landlordBankName') ? set_value('landlordBankName') : $this->session->userdata('landlordBankName'); ?>" />
							<?php echo form_error('landlordBankName'); ?>
						</div>
						<div class="field tooltip" title="Please enter ABA Routing Number.">
							<label for="">ABA Routing Number <span class="required">*</span></label>
							<input name="landlordRoutingNumber" type="text" value="<?php echo set_value('landlordRoutingNumber') ? set_value('landlordRoutingNumber') : $this->session->userdata('landlordRoutingNumber'); ?>" />
							<?php echo form_error('landlordRoutingNumber'); ?>
						</div>                                     
						<div class="field tooltip" title="Please enter ABA Routing Number.">
							<label for="">Confirm ABA Routing Number <span class="required">*</span>  (We want to make sure we got it right. Please input the information once more.)</label>
							<input name="landlordConfRoutingNumber" type="text" value="<?php echo set_value('landlordConfRoutingNumber') ? set_value('landlordConfRoutingNumber') : $this->session->userdata('landlordConfRoutingNumber'); ?>" />
							<?php echo form_error('landlordConfRoutingNumber'); ?>
						</div>                                     
						<div class="field tooltip" title="Please enter Account Number.">
							<label for="">Account Number <span class="required">*</span></label>
							<input name="landlordrAccountNumber" type="text" value="<?php echo set_value('landlordrAccountNumber') ? set_value('landlordrAccountNumber') : $this->session->userdata('landlordrAccountNumber'); ?>" />
							<?php echo form_error('landlordrAccountNumber'); ?>
						</div>                                     
						<div class="field tooltip" title="Please enter Account Number.">
							<label for="">Confirm Account Number <span class="required">*</span>  (We want to make sure we got it right. Please input the information once more.) </label>
							<input name="landlordConfAccountNumber" type="text" value="<?php echo set_value('landlordConfAccountNumber') ? set_value('landlordConfAccountNumber') : $this->session->userdata('landlordConfAccountNumber'); ?>" />
							<?php echo form_error('landlordConfAccountNumber'); ?>
						</div>					
						<div class="field tooltip">
							<label for="" style="float:left; width:150px;"> Account Type  <span class="required">*</span></label>  
							
							<input type="radio" name="landlordAccountType" value="savings" <?php echo set_radio('landlordAccountType', 'savings', TRUE); ?> style="float:left; width:20px;" /> 
							<label for="" style="float:left; width:100px; margin:3px 0px 13px 0px; font-weight:13px; color:#444;">Savings Account</label>                                                
							
							<input type="radio" name="landlordAccountType" value="checking" <?php echo set_radio('landlordAccountType', 'checking'); ?> style="float:left; width:20px;" />						
							<label for="" style="float:left; width:114px; margin:3px 0px 0px 0px; font-weight:13px; color:#444;">Checking Account</label>                                                
							<?php echo form_error('landlordAccountType'); ?>
						</div>		<br/><br/>
						
						<p>By checking the box below, user agrees and authorizes Inspire Credit, Integras Financial,<br/>
							and its partners to deposit and transfer funds in accordance with the <a href="<?php echo base_url()?>">Inspire Credit</a> 
							<a href="<?php echo base_url()?>/terms_of_use">Terms <br/> of Agreement</a> and <a href="#">NACHA guidelines</a>	
							to include the deposit of scheduled rents. 
							<br/> Additionally, Landlord/Property manager authorizes Inspire Credit and Integras Financial to <br/>
							report all payment history to any partcipating credit bureau on behalf of the landlord or <br/> property management company.

						</p><br/>                                    
						<div class="field">
							<input class="checkbox left" name="landlordTos" type="checkbox" value="1" /> 
							<b>I agree to the Inspire Credit ACH and Reporting Terms of Agreement (Deposit only)</b>
							<?php echo form_error('landlordTos'); ?>	
						</div>
											
						<div class="field">						
							<a class="buttons" href="<?php echo base_url()?>landlord/create_account/confirm_lease">back</a> | 
							<input type="submit" class="buttons" name="commit" value="Continue" />
						</div>            
					</div>
					<?php echo form_close(); ?>
					
					<?php 
						break; 
						case '4': 
						// Display 6th Page Form 
					 ?> 
								
					<div class="tabpage" id="tabpage_4">
						<?php if($this->session->userdata('signup_msg') == 'success'){ ?>
					
							<h3>Congratulations!</h3>
							<p><b>You will begin receiving monthly rental payments from your tenant through Inspire and enjoying the benefits of </b></p>
							<ul>
								<li>On-time payments, every time</li>
								<li>Complete payments</li>
								<li>Payments deposited directly into your account</li>
								<li>Faster availability of funds</li>
								<li>Reporting of tenant's payment behavior to credit bureau on your behalf</li>
								<li>Email notification of payments for your records</li>
								<li>Online history of payments</li>
							</ul>
							<p>
								A confirmation will be sent to your tenant to let them know you have verified their lease information.
							</p>
							<p>If you have any question about Inspire,please check out our Frequently Asked Questions or Contact us. <br/>
								We're here to serve you!
							</p>
							
							<?php /******DESTROY SESSION IF SUCCESSFULL, ITS VERY IMPORTANT ******/?>
							<?php $this->session->sess_destroy();?>
							<?php /******HURRY!!! SESSION DESTROYED ******/?>
						
							<?php } elseif($this->session->userdata('signup_msg') == 'error'){ ?>
							
							<h3>Oops, <?php echo $this->session->userdata('landlordUPreferredName'); ?>!</h3>
							<p class="error">Some error occurred while creating an Account, Please try again.</p>
						
						<?php } ?>
								 
						<br/><br/><br/>
						<div class="field"><br/><br/>
							<ul class="hot_topics">
								<li><strong>Hot Topics</strong></li>
								<li>FREE Report: 10 ways to build your credit</li>
								<li>Budget building the easy way</li>
								<li>Making a difference in the community around you</li>
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
