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
	<h3>View\Edit\Delete Instances</h3>
</div>
<div class="hastable">
	<div class="pagination"><?php echo $links; ?></div> <br/><br/><br/>

	<table id="sort-table"> 
		<thead> 
			<tr>
				<?php /* <th><input type="hidden" value="check_none" onclick="this.value=check(this.form.list)" class="submit"/></th> */ ?>
				
<!--				<td <?php if ($sort_column == 'instance_name') echo "class=\"sort_$sort_order\"" ?> >
					<a href="<?php echo(($sort_column == 'instance_name' && $sort_order == 'desc') ? (base_url().'admin_area/list_instance/active_instance/ue/desc/'.$page) : (base_url().'admin_area/list_instance/active_instance/ue/desc/'.$page)); ?>">Instance Name</a></td>
				<td <?php if ($sort_column == 'term') echo "class=\"sort_$sort_order\"" ?> >
					<a href="<?php echo(($sort_column == 'instance_name' && $sort_order == 'desc') ? (base_url().'admin_area/list_instance/active_instance/ue/desc/'.$page) : (base_url().'admin_area/list_instance/active_instance/rgd/desc/'.$page)); ?>">Term</a></td>
				--><td>Instance Name</td>
                                <td>Term</td>
                                <td>Year</td>
				<td>Academic Year</td>				
				<td>View</td>
				<td>Edit</td>  
				<td>Delete</td>  
			</tr> 
		</thead> 
		<tbody> 
			 <?php  
			 if(!empty($list_instance)) { 
				
				$count = 1;				
				foreach($list_instance as $item) {
			 ?>			
			<tr>
				<?php /* <td class="center"><input type="checkbox" value="1" name="list" class="checkbox"/></td> */ ?>
				<td>
					<a class="thickbox" href="<?php echo base_url();?>admin_area/list_instance/view_instance/<?php echo $item->instance_id . '/' . $item->instance_name; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<?php echo ucfirst($item->instance_name); ?>
					</a>
				</td> 				 
				<td><?php echo $item->term; ?></td>
                                <td><?php echo $item->year; ?></td>
                                <td><?php echo $item->academic_year; ?></td>				
				
				
				<td style="text-align:center;">
					<a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" title="View <?php echo ucfirst($item->instance_name);?> Details" href="<?php echo base_url();?>admin_area/list_instance/view_instance/<?php echo $item->instance_id . '/' . $item->instance_name; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<span class="ui-icon ui-icon-view"></span>
					</a>
				</td>
				<td style="text-align:center;">
					<a class="btn_no_text btn ui-state-default ui-corner-all tooltip thickbox" title="Edit <?php echo ucfirst($item->instance_name); ?> Details" href="<?php echo base_url();?>admin_area/list_instance/edit_instance/<?php echo $item->instance_id . '/' . $item->instance_name; ?>?keepThis=true&TB_iframe=true&height=480&width=480">
						<span class="ui-icon ui-icon-edit"></span>
					</a>
				</td> 			
				<td style="text-align:center;">
					<?php
						$fullname = ucfirst($item->instance_name);
					?>
					<a class="tooltip thickbox" title="Delete <?php echo ucfirst($item->instance_name); ?> Details" 
					href="<?php echo base_url();?>admin_area/list_instance/delete_instance/<?php echo $item->instance_id . '/' . $item->instance_name; ?>?keepThis=true&TB_iframe=true&height=300&width=480" >
						<img src="<?php echo base_url(); ?>includes/admin_area/images/delete.png" border="0" height="17" width="17">
					</a>
				</td> 
			</tr> 			
			<?php  $count++; } 
			} else { ?>			
			<tr>
				<td colspan="10"> There are No  Instance </td>
			</tr>
			<?php } ?>		
		</tbody>
	 </table>	 
	<div class="pagination"><?php echo $links; ?></div>		
</div>
<div class="clearfix"></div>

<script type="text/javascript">
   /* function hidebox(id) {
        var e = document.getElementById(id);
        e.style.display = 'block';

    } */
/*function confirmDelete(){
    alert('ssssssssss');
var agree=confirm("Are you sure you want to delete this file?");
if(agree)
     return true ;
else
     return false ;
}*/
</script>

