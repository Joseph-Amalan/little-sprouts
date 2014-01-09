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
<br/> 
<div class="title">
	<h3>View\Edit\Active\Deactice account\Delete & Block\Unblock Registered Renters</h3>
</div>
<div class="hastable">
	<div class="pagination"><?php echo $links; ?></div> <br/><br/><br/>

	<table id="sort-table"> 
		<thead> 
			<tr>
				<?php /* <th><input type="hidden" value="check_none" onclick="this.value=check(this.form.list)" class="submit"/></th> */ ?>
				<td>Name</td> 
				<td <?php if ($sort_column == 'user_email') echo "class=\"sort_$sort_order\"" ?> >
					<a href="<?php echo(($sort_column == 'user_email' && $sort_order == 'desc') ? (base_url().'admin_area/list_renters/active_renters/ue/desc/'.$page) : (base_url().'admin_area/list_renters/active_renters/ue/desc/'.$page)); ?>">Email</a></td>
				<td <?php if ($sort_column == 'register_date') echo "class=\"sort_$sort_order\"" ?> >
					<a href="<?php echo(($sort_column == 'user_email' && $sort_order == 'desc') ? (base_url().'admin_area/list_renters/active_renters/ue/desc/'.$page) : (base_url().'admin_area/list_renters/active_renters/rgd/desc/'.$page)); ?>">Reg Date</a></td>
				<td>Inact./Act. Account</td>
				<td>IP Address</td>				
				<td>IP Status</td>
				<td>Block/Unblock by IP</td>
				<td>View</td>
				<td>Edit</td>  
				<td>Delete</td>  
			</tr> 
		</thead> 
		<tbody> 
			 <?php  
			 if(!empty($list_renters)) { 
				
				$count = 1;				
				foreach($list_renters as $item) {
			 ?>			
			<tr>
				<?php /* <td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td> */ ?>
				<td>
					<a class="thickbox" href="<?php echo base_url();?>admin_area/list_renters/view_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<?php echo ucfirst($item->renter_first_name) . ' ' . ucfirst($item->renter_middle_name) . ' ' . ucfirst($item->renter_last_name); ?>
					</a>
				</td> 
				<td><a href="mailto:<?php echo $item->user_email; ?>" ><?php echo $item->user_email; ?></a></td> 
				<td><?php echo $item->register_date; ?></td>	
				 <td style="text-align:center;">
					<a class="tooltip thickbox" title="Inactive/Active Renter Profile" href="<?php echo base_url();?>admin_area/list_renters/user_edit_account_status/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=435&width=480">
						<?php if($item->user_account_status == 1) { ?>
						<img src="<?php echo base_url(); ?>includes/admin_area/images/active_icon.png" border="0" height="24" width="24">
						<?php }  else { ?> 
						<img src="<?php echo base_url(); ?>includes/admin_area/images/inactive_icon.png" border="0" height="24" width="24">
						<?php } ?>
					</a>
				</td> 		
				<td><?php echo $item->user_ip_address; ?></td>
				 <td style="text-align:center;">
					<a class="" title="Block/Unblock Renter Profile" href="#">
						<?php if($item->user_ip_address_status == 1) { echo "<span style='color:green; font-weight:bold'> Unblock </span>"; } 
						else { echo "<span style='color:red; font-weight:bold'> Block </span>"; } ?>
					</a>
				</td> 
				 <td style="text-align:center;">
					<a class="tooltip thickbox" title="Block/Unblock <?php echo ucfirst($item->renter_first_name) . ' ' . ucfirst($item->renter_middle_name) . ' ' . ucfirst($item->renter_last_name); ?> ip adress" href="<?php echo base_url();?>admin_area/list_renters/ip_edit/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=435&width=480">
						<img src="<?php echo base_url(); ?>includes/admin_area/images/ip_address.gif" border="0" height="17" width="17">
					</a>
				</td>
				<td style="text-align:center;">
					<a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" title="View <?php echo ucfirst($item->renter_first_name) . ' ' . ucfirst($item->renter_middle_name) . ' ' . ucfirst($item->renter_last_name); ?> Profile" href="<?php echo base_url();?>admin_area/list_renters/view_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<span class="ui-icon ui-icon-view"></span>
					</a>
				</td>
				<td style="text-align:center;">
					<a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" title="Edit <?php echo ucfirst($item->renter_first_name) . ' ' . ucfirst($item->renter_middle_name) . ' ' . ucfirst($item->renter_last_name); ?> Profile" href="<?php echo base_url();?>admin_area/list_renters/edit_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<span class="ui-icon ui-icon-edit"></span>
					</a>
				</td> 			
				<td style="text-align:center;">
					<?php
						$fullname = ucfirst($item->renter_first_name);
					?>
					<a class="tooltip thickbox" title="Delete <?php echo ucfirst($item->renter_first_name) . ' ' . ucfirst($item->renter_middle_name) . ' ' . ucfirst($item->renter_last_name); ?> Profile" 
					href="<?php echo base_url();?>admin_area/list_renters/delete_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=300&width=480">
						<img src="<?php echo base_url(); ?>includes/admin_area/images/delete.png" border="0" height="17" width="17">
					</a>
				</td> 
			</tr> 			
			<?php  $count++; } 
			} else { ?>			
			<tr>
				<td colspan="10"> There are no New Renter </td>
			</tr>
			<?php } ?>		
		</tbody>
	 </table>	 
	<div class="pagination"><?php echo $links; ?></div>		
</div>
<div class="clearfix"></div>

