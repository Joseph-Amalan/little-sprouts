<!--<div class="sub-menu"> -->
<!--	<div class="fleft">   
		<a href="<?php echo base_url();?>how_it_works">How it works</a>
		<a href="<?php echo base_url();?>about_us">About us</a>
		<a href="<?php echo base_url();?>contact_us">Contact us</a>		
	</div>-->
		
	<div class="fright">
                    
            <?php $logged_in = FALSE;?>
            <?php $logged_in = $this->session->userdata('logged_in'); ?>  
                    
			<?php if($logged_in == TRUE) { 
		 
				$role = $this->session->userdata('user_role_id');					

			
                                         echo anchor('staff/data_entry/index', 'DataEntry', 'title="DataEntry"'); ?>
            
                                         
                                         &nbsp;&nbsp;&nbsp;&nbsp;
            <?php
                                         
					echo anchor('logout', 'Logout', 'title="logout"'); 					
			} ?>
	</div>	
<!--</div>-->
