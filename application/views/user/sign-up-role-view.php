<div class="left ">
<div class="left-internal">
    <h2><span>What</span> They Say</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed   do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris   nisi ut aliquip ex ea commodo consequat.</p>
    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum   dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non   proident, sunt in culpa qui off icia deserunt mollit anim id estlaborum.</p>
    <img src="includes/images/img_1.jpg" width="108" height="122" alt="picture" />
    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris   nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in   reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla   pariatur.</p>
 </div>
<div class="main-internal">
       <?php /*  <h2><span>Sign Up</span> Role</h2> 
		
		<div>
			<h3>All prices are in US dollars. We accept Visa, Mastercard and American Express. 
				All Credit card payments are processed by Paypal.</h3>
			<img src="<?php echo base_url();?>includes/images/horizontal_solution_PPeCheck.gif" height="80" width ="253" alt="" />
		</div>
	   */ ?>
		<h2>Become a <span>Inspire Credit</span> Premium Member</h2>
                
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
				
		<div class="picing-options">                    
			<div class="pricing-item fleft">
				<h2>If you are renting and want to build your credit </h2>            
				<a class="orange-button" href="<?php echo base_url();?>renter/sign_up/create_account">Start Here</a>
			</div>          
			<div class="pricing-item fright">
						<?php 	/* <h2>Are you Landlord <br/>..... Start here</h2><br/>
				<a class="orange-button" href="<?php echo base_url();?>landlord/sign_up">Landlord Click Here</a> */ ?>
			</div>
		</div>		
	</div>
</div>
