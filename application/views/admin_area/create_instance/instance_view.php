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
			<?php  
		
			if(!empty($instance_data)) {
		
			foreach($instance_data as $item) { ?>
				<div class="field">
					<?php /* <span class="ad_user_photo">
						<img height="60" width="60" alt="" src="<?php echo base_url();?>includes/images/user_photo.png"> 
					</span> */ ?>
					<div class="ad_user_name">
						<?php echo ucfirst($item->instance_name); ?>
					</div>
				</div>
				<h1>Instance Details</h1>
		
				<div class="view_content_box">
					<div class="field ">
						<label> Instance Name : </label>			
						<span class="font_black"> <?php echo $item->instance_name; ?> </span>
					</div>                
					<div class="field">
						<label> Year : </label>
						 <span class="font_black"><?php echo $item->year; ?></span>
					</div>		
					<div class="field">
						<label> Academic Year :</label>
						<span class="font_black"><?php echo $item->academic_year; ?></span>
					</div>  
					<div class="field">
						<label> Term : </label>
						<span class="font_black"><?php echo $item->term; ?></span>
					</div> 	 		             
					 		             
					<br/>
				</div>
		
				<br/><br/>		
		<?php } } else { ?>
		 No Instance are there.
		<?php } ?>
		</div>           
    </div>		
</div>
<div class="clearfix"></div>		
</body>
</html>