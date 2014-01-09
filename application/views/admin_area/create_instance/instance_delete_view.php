<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link href="<?php echo base_url();?>includes/admin_area/styles/style.css" rel="stylesheet" media="all" />
	</head>
<body>
<div id="page-wrapper">
    <div id="main-wrapper">
		<div id="main-content" class="view_user_profile">				
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
		
		<?php $attributes = array('id' => 'admin_login','name' => 'admin_login','class' => 'forms'); 
			  echo form_open('admin_area/list_instance/delete_instance/'.$instance_id. '/' . $instance_name, $attributes);  ?>	
                		
			<b>Once you delete this Instance, in this instance id based  Student details  records also  will be delete permanently.</b><hr/><br/>
		 
			<div class="field">
				<label>Reason<span class="required">*</span></label>
				<textarea name="instanceAccountDeleteReason" style="height: 100px;width: 484px;"></textarea>
				<?php echo form_error('instanceAccountDeleteReason'); ?>
			</div> 
			<div class="buttons ipbtn">	   
				<input class="ui-state-default ui-corner-all" type="submit" value="Delete Instance Account" id="ipEditBtn" class="submit">
			</div>	
			<?php echo form_close(); ?>	
		</div>		
	</div>
</div>
<div class="clearfix"></div>	
</body>
</html>