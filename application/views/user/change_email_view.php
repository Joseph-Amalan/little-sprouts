<div class="left min-height">		
	<div class="main-internal"> 	
		<h2><span>Change</span> Email adress</h2>
					 
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
		$attributes = array('id' => 'change_email','name' => 'change_email','class' => 'forms'); 
		echo form_open('change_email', $attributes); 
		?>

		<div class="field tooltip" title="Please enter your Old Password.">
			<label> Old Email Adress <span class="required">*</span></label>
			<input name="userOldEmail" type="text"/>
			<?php echo form_error('userOldEmail');?>
		</div>	
		<div class="field tooltip" title="Please enter your New Password.">
			<label> New Email Adress <span class="required">*</span></label>
			<input type="text" name="userNewEmail" id="textbox_id" onpaste="return false;" onCopy="return false" onCut="return false" autocomplete="off" />
			<?php echo form_error('userNewEmail');?>
		</div>	
		<div class="field tooltip" title="Please enter your New Password again.">
			<label> Re-enter Email Adress <span class="required">*</span></label>
			<input type="text" name="userNewConfEmail" id="textbox_id" onpaste="return false;" onCopy="return false" onCut="return false" autocomplete="off" />
			<?php echo form_error('userNewConfEmail');?>
		</div>
		<div class="field">		
				<input class="buttons" name="commit"  type="submit" value="Change Email" />					
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
