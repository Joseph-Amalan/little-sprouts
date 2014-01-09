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
<div class="left grid-c" style="min-height:356px;">	
	<div id="sidebar" class="sidebar">
		<div id="inbox-nav">
			<ul>
				<li class="nav-compose"><a href="<?php echo base_url();?>messages/compose"><em>Compose Message</em></a></li>
				<li class="nav-inbox"><a href="<?php echo base_url();?>messages/inbox">Inbox</a></li>
				<li class="nav-sent active"><a href="<?php echo base_url();?>messages/sent">Sent</a></li>	
				<li class="nav-trash "><a href="<?php echo base_url();?>messages/trash">Trash</a></li>	
			</ul>
		</div>
	</div>
	<div id="content" class="inbox-v2">
		<div id="inbox-tabview" class="inbox-tabview">
			<ul class="tabs-v2 inbox-tabview-nav">				
				<li class="selected">
					<a href="<?php echo base_url();?>messages/sent"><em>Sent Messages</em></a>
				</li>
				<?php $user_role = $this->session->userdata('user_role_id'); 
					  $user_id = $this->session->userdata('user_id');
				
				if($user_role == 1) { ?>
				<li>
					<a href="<?php echo base_url();?>invitations/sent"><em> Sent Invitations</em></a>
				</li>
				<?php }   ?>
			</ul>
			
			<div class="content" class="inbox-v2">
				<div id="messages" class="inbox-null">	
						<ul class="inbox-list">
							<?php 
							if(!empty($message_list))
							{ ?>
							<div class="select-filters-sort" style="margin: 10px 0px 0px 0px;float: left;overflow: hidden;width: 98%;">	
								<div class="new-bulk">
									<ul class="bulk">
										<li>
											<input type="checkbox" id="checkallnone" />
											<input type="button" class="delresmsg btn-ternary" value="DELETE" id="deletemsg">
										</li>	
										<li style="float:right;"><input type="button" class="delresmsg btn-ternary" value="Mark as Unread" id="markunreadmsg" /></li>
									</ul>
								</div>
								<div class="clr"></div>	
							</div>							
							
							<?php	$i = 0;
								foreach ($message_list as $items) 
								{ 									
							?>							
								<li class="inbox-item message-item readmail <?php if(($items->to_user ==  $user_id && $items->to_viewed == 0) || ($items->from_user ==  $user_id && $items->from_viewed == 0)) { echo 'unreadmail'; } ?>" >																						
								      <input type="checkbox" id="<?php echo $user_id . '-' . $items->message_id; ?>" class="msgcheck" value="<?php echo $items->message_id; ?>" />	
                                                                      <a href="<?php echo base_url();?>messages/view/<?php echo $items->message_id; ?>">
									<div class="item-content">
										<span class="participants">									
											<span class="miniprofile-container" id="">
											<?php 
											if($items->to_user == $items->from_user) { echo "me"; } else { echo $items->to_user_email; }
											?>
											</span>									
										</span>	
										<span class="subject">									
												<?php echo  $items->subject;
												if($items->counttitle != 1) { echo '...(' . $items->counttitle . ')'; }  ?>									
										</span>								
										<div class="date"><?php echo $items->created; ?></div>								
									</div>	
								      </a>
								</li>	
															
							<?php                                                         
                                                         } 
							} else { ?>
							<br/><div class="notice">There are no sent messages.</div>
							<?php } ?>	
						</ul>
					</div>
			</div>
		</div>
	</div>
</div>