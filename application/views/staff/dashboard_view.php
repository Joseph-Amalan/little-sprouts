<div class="left " style="min-height:376px;">		
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
	<div class="renter_acc_left">
	&nbsp;
	</div>
	<div class="renter_acc_right"> 
			
		<ul style="width:300px; float:left;">
			<li>
				<h2><span>My Account</span></h2>
				<ul style="padding:0px 0px 0px 20px">
                                     <li>
				<a href="<?php echo base_url(); ?>staff/data_entry/index" class="Clipboard_3 tooltip" title="Data Entry">Data Entry</a>
			</li>	
					
				</ul>
			</li>
	   </ul>
	  <?php  /* <ul style="width:300px; float:left;">
			<li>
				<h2><span>Manage Payment</span></h2>
				<ul style="padding:0px 0px 0px 20px">
					<li><a href="#">Change payment schedule</a></li>						
				</ul>
			</li>
	   </ul>*/ ?>
            
     
            
	   <!--<div style="width: 600px;float: left;margin: 40px 0px 0px 0px;">
			<ul>
				<li>
					<span></span>
				</li>
			</ul>		
	   </div>-->
	</div>
</div>
