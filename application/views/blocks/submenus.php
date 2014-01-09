<div class="sub-menu" style="background:#069;"> 
	<ul>   
		<?php  if($logged_in) { ?>
			
		<?php if($role == 1) { ?> 
			<li class="nodrop"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
		<?php  } elseif($role == 2) { ?> 
		  <li class="nodrop"><a href="<?php echo base_url();?>landlord/dashboard">Home</a></li> <?php } } ?>
		  <li class="nodrop"><a href="<?php echo base_url();?>messages/inbox">Inbox</a></li>
	</ul>
</div>
