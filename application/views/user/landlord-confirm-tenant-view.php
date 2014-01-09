<?php $this->template->add_css('includes/styles/tabs.css'); ?>
<?php $this->session->set_userdata('userRoleId',2);?>

<div class="left ">
	<div class="main-internal">	
		<h2><span>Landlord</span> Sign Up</h2>
		<!--Already have account! <a href="<?php //echo base_url();?>login">Login Here</a> | Forgot Password? <a href="<?php //echo base_url();?>forgot_password">click here</a> <br/><br/>-->
				
		<div id="wrapper">  
			<div id="tabContainer">
				<div class="tabs">
					<ul>
					  <li id="tabHeader_1" <?php if($page==1){ echo 'class="tabActiveHeader"';}?> ><h3>Your Account</h3></li>
					  <li id="tabHeader_2" <?php if($page==2){ echo 'class="tabActiveHeader"';}?> ><h3>Confirm Lease</h3></li>
					  <?php /*  <li id="tabHeader_3" <?php if($page==3){ echo 'class="tabActiveHeader"';}?> ><?php if($this->session->userdata('deposite_info') == "active"){ echo '<a href="'.base_url().'landlord/create_account/deposit_info"><h3>Deposit Information</h3></a>'; }else { echo '<h3>Deposit Information</h3>';} ?></li> */ ?>
					  <li id="tabHeader_3" <?php if($page==3){ echo 'class="tabActiveHeader"';}?>><h3>Done</h3></li>
					</ul>
				</div>
				<div class="bg"></div> 
				<div class="tabscontent">                            
					<?php switch($page) { 
						
						case '1': 
						default: 
					?>  
					  Don't have an account! <a href="<?php echo base_url()."landlord/create_account/invitation/".$user_key."/".$renter_email . '/' . $date . '/' . $time; ?>">Create Here to confirm tenant request</a> | Forgot Password? <a href="<?php echo base_url();?>forgot_password">click here</a> <br/><br/>
					<?php 
						$attributes = array('id' => 'landlordSignUp1','name' => 'landlordSignUp1','class' => 'forms'); 
						echo form_open('landlord/confirm_tenant', $attributes); 
						
						foreach($landlord_data as $item) {					
					 ?>
					<div class="tabpage" id="tabpage_1">
				   <?php 
					if($this->session->flashdata('error_message')) : 
						echo '<div class="error">';
						echo $this->session->flashdata('error_message');
						echo '</div>';
					endif;
				   ?>
										
					<div class="field tooltip" title="Please enter your email address.">
						<label for="">Username: <span class="required">*</span></label>	
						<input name="landlordUsername" type="text" value="<?php echo set_value('landlordUsername') ? set_value('landlordUsername') : $this->session->userdata('landlordUsername'); ?>" />	
						<?php echo form_error('landlordUsername'); ?>				
					</div>                                  
						  
					<div class="field tooltip" title="Please enter your Password.">
						<label for="">Password <span class="required">*</span></label>					
						<input id="landlordPassword" name="landlordPassword" type="password" type="text" value="<?php echo set_value('landlordPassword'); ?>" />
						<?php echo form_error('landlordPassword'); ?>
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
					echo form_open('landlord/confirm_tenant/confirm_lease', $attributes); 
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
								<?php /* <td><a href="#">Edit</a></td> */ ?>
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
								<td width="20%">Paid monthly on the <?php echo $item->rent_due_date;?> of each month</td> 
							</tr>  
							
							<tr><td colspan="12"><div class="bg"></div></td></tr>	
																	
							<tr><td colspan="12"><span>Landlord Info</span></td></tr>
							<tr> 
								<td width="32%"><?php echo $item->landlord_organization; ?></td> 
								<td width="20%">Address: <?php echo $item->landlord_off_address_line_one .' '. $item->landlord_off_address_line_two . '.'; ?></td>
								<td width="20%">&nbsp;</td> 
								<td width="20%">&nbsp;</td>  
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
							<a class="buttons" href="<?php echo base_url()?>landlord/confirm_tenant">back</a> | 
							<input type="submit" class="buttons" name="commit" value="VERIFIED" />	
							
							<a class="thickbox reject_btn" title="Please give reason for rejection" href="<?php echo base_url();?>landlord/lease_agreement/rejected/<?php echo $item->association_id;?>/<?php echo $item->user_email; ?>/<?php echo $this->session->userdata('landlordUsername'); ?>?keepThis=true&TB_iframe=true&height=330&width=480">REJECT</a>
						</div>                                                    
					</div>				 
					<?php echo form_close(); } } else { ?>
					<div style="color:red"> Rejected Renter Invitation. </div>
					<?php } ?>
					
					<?php 
						break; 
						case '3': 
						// Display 3th Page Form 
					 ?> 
								
					<div class="tabpage" id="tabpage_3">
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
							We're here to serve you!</p>
						
						<?php /******DESTROY SESSION IF SUCCESSFULL, ITS VERY IMPORTANT ******/?>
							<?php $this->session->sess_destroy();?>
						<?php /******HURRY!!! SESSION DESTROYED ******/?>
					
						<?php } elseif($this->session->userdata('signup_msg') == 'error'){ ?>
						
						<h3>Oops, <?php echo $this->session->userdata('landlordUsername'); ?>!</h3>
						<p class="error">Some error occurred while confirm lease agreement, Please try again.</p>
					
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
