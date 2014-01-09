<div class="left ">
	<div class="main-internal">    
		<h2><span>Forgot </span> Password</h2> <br/>		
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
				  
		<?php 	
		$attributes = array('id' => 'forgot_password','name' => 'forgot_password','class' => 'forms'); 
		echo form_open('forgot_password', $attributes); ?>
		
		<p>Enter your registered email to get password. </p><br/>

		<div class="field tooltip" title="Please enter your email.">
			<label for="email">Email <span class="required">*</span></label>
			<input name="email"  id="email" type="text" value="" />
			<?php echo form_error('email');  ?>
		</div>	
		<div class="field">		
			<input class="buttons" name="commit"  type="submit" value="Submit" />&nbsp;&nbsp;&nbsp;		
			Don't have account? <a href="<?php echo base_url();?>sign_up_role">sign-up here</a> 
		</div>
		<?php echo form_close(); ?>	
	</div>
</div>
