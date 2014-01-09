<div class="left ">
	<div class="main-internal">
		<h2><span>Reset</span> Password</h2> <br/>                
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
			
		$attributes = array('id' => 'reset_password','name' => 'reset_password','class' => 'forms'); 
		echo form_open('reset_password', $attributes); ?>
		
		<p>Reset your password to login to Inspire Credit. </p><br/>	

		<div class="field tooltip" title="Please enter your email.">
			<label for=""> New Password <span class="required">*</span></label>
			<input name="newPassword" type="password" id="newPassword" value=""/>
			<?php echo form_error('newPassword');?>
		</div>	
		<div class="field tooltip" title="Please enter your Password.">
			<label for=""> New Password(Confirm) <span class="required">*</span></label>			
                        <input name="newPasswordConf" type="password" id="newPasswordConf" value=""/>
			<?php echo form_error('newPasswordConf');?>
		</div>
		<div class="field">		
			<input class="buttons" name="commit"  type="submit" value="Reset Password" />&nbsp;&nbsp;&nbsp;					
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
