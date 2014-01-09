<div class="left ">
	<div class="main-internal">		
		<h2><span>Log</span> In</h2>                 
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
		$attributes = array('id' => 'login','name' => 'login','class' => 'forms'); 
		echo form_open('login', $attributes); ?>
		
		<p>Enter your email and password to login to Inspire Credit. </p><br/>
		
		<?php /* <div class="field tooltip" title="Please enter your email.">
			<label for="">Email <span class="required">*</span></label>
			<input name="email"  id="email" type="text" value="" />
			<?php echo form_error('email'); ?>
		</div>	*/ ?>
		
		<div class="field tooltip" title="Please enter your email.">
			<label for="">Username <span class="required">*</span></label>
			<input name="username" id="username" type="text" value="" />
			<?php echo form_error('username'); ?>
		</div>
		<div class="field tooltip" title="Please enter your Password.">
			<label for="">Password <span class="required">*</span></label>
			<input name="password" id="password" type="password" value="" />
			<?php echo form_error('password'); ?>
		</div>
		<div class="field">		
			<input class="buttons" name="commit"  type="submit" value="Login" />&nbsp;&nbsp;&nbsp;		
			<a href="<?php echo base_url();?>forgot_password">forgot password</a> | Don't have account? <a href="<?php echo base_url();?>sign_up_role">sign-up here</a> 
		</div>
		<?php echo form_close(); ?>
	</div>
</div>