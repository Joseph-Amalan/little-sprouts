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
	<h3>View\Edit\Active\Deactice account\Delete & Block\Unblock Registered Landlords</h3>
</div>
<div class="hastable">
	
		<div class="pagination"><?php echo $links; ?></div> <br/><br/><br/>
		<table id="sort-table"> 
			<thead> 
				<tr>
					<?php /* <th><input type="checkbox" value="check_none" onclick="this.value=check(this.form.list)" class="submit"/></th> */ ?>
					<td>Name</td> 
					<td>Email</td>
					<td>Reg Date</td>
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
				if(!empty($list_landlords)) { 
						$count = 1;	
					   foreach($list_landlords as $item) {
				?>			
				<tr>
					<?php /* <td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td> */ ?>
					<td>
						<a class="thickbox" href="<?php echo base_url();?>admin_area/list_landlords/view_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<?php echo ucfirst($item->landlord_first_name) . ' ' . ucfirst($item->landlord_middle_name) . ' ' . ucfirst($item->landlord_last_name); ?></a>
					</td> 
					<td><a href="mailto:<?php echo $item->user_email; ?>" ><?php echo $item->user_email; ?></a></td> 
					<td><?php echo $item->register_date; ?></td>	
					<td style="text-align:center;">
						<a class="tooltip thickbox" title="Inactive/Active Landlord Profile" href="<?php echo base_url();?>admin_area/list_landlords/user_edit_account_status/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=435&width=480">
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
						<a class="tooltip thickbox" title="Block/Unblock <?php echo ucfirst($item->landlord_organization); ?> ip adress" href="<?php echo base_url();?>admin_area/list_landlords/ip_edit/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=435&width=480">
							<img src="<?php echo base_url(); ?>includes/admin_area/images/ip_address.gif" border="0" height="17" width="17">
						</a>
					</td> 
					<td style="text-align:center;">
						<a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" title="View <?php echo ucfirst($item->landlord_organization); ?> Profile" href="<?php echo base_url();?>admin_area/list_landlords/view_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
							<span class="ui-icon ui-icon-view"></span>
						</a>
					</td>
					<td style="text-align:center;">
						<a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" title="Edit <?php echo ucfirst($item->landlord_organization); ?> Profile" href="<?php echo base_url();?>admin_area/list_landlords/edit_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
							<span class="ui-icon ui-icon-edit"></span>
						</a>
					</td> 			
					<td style="text-align:center;">
						<?php
							$FirstName = ucfirst($item->landlord_first_name);
						?>
						<a class="tooltip thickbox" title="Delete <?php echo ucfirst($item->landlord_first_name) . ' ' . ucfirst($item->landlord_middle_name) . ' ' . ucfirst($item->landlord_last_name); ?> Profile" 
							href="<?php echo base_url();?>admin_area/list_landlords/delete_profile/<?php echo $item->user_id . '/' . $item->user_email; ?>?keepThis=true&TB_iframe=true&height=300&width=480">
							<img src="<?php echo base_url(); ?>includes/admin_area/images/delete.png" border="0" height="17" width="17">
						</a>
					</td>
				</tr> 				
				<?php $count++; } } else { ?>		
				<tr>
					<td colspan="10"> There are no New Landlord </td>
				</tr>
				<?php } ?>			
			</tbody>
		</table>
		<?php /* 
		<div id="pager">	
			<a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#">
				<span class="ui-icon ui-icon-arrowthickstop-1-w"></span>
			</a>
			<a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
				<span class="ui-icon ui-icon-circle-arrow-w"></span>
			</a>			
			<input type="text" class="pagedisplay"/>
			<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#">
				<span class="ui-icon ui-icon-circle-arrow-e"></span>
			</a>
			<a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
				<span class="ui-icon ui-icon-arrowthickstop-1-e"></span>
			</a>
			<select class="pagesize">
				<option value="10" selected="selected">10 results</option>
				<option value="20">20 results</option>
				<option value="30">30 results</option>
				<option value="40">40 results</option>
			</select>								
		</div> */ ?>
	
	<div class="pagination"><?php echo $links; ?></div> <br/>
</div>
<div class="clearfix"></div>


