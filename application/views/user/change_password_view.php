<div class="left min-height">		
	<div class="main-internal"> 	
		<h2><span>Change</span> Password</h2>
					 
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
		$attributes = array('id' => 'change_password','name' => 'change_password','class' => 'forms'); 
		echo form_open('change_password', $attributes); 
		?>

		<div class="field tooltip" title="Please enter your Old Password.">
				<label> Old Password <span class="required">*</span></label>
				<input name="oldPassword" type="password"/>
				<?php echo form_error('oldPassword');?>
		</div>	
		<div class="field tooltip" title="Please enter your New Password.">
				<label> New Password <span class="required">*</span></label>
				<input name="newPassword" type="password"/>
				<?php echo form_error('newPassword');?>
		</div>	
		<div class="field tooltip" title="Please enter your New Password again.">
				<label> Re-enter New Password <span class="required">*</span></label>
				<input name="newPasswordConf" type="password" />
				<?php echo form_error('newPasswordConf');?>
		</div>
		<div class="field">		
				<input class="buttons" name="commit"  type="submit" value="Change Password" />					
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
