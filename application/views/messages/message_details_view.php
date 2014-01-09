<?php
/*
echo '<pre>';
print_r($view_message);
echo '</pre>'; 
 * 
 */ 
?>

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
				<li class="nav-sent"><a href="<?php echo base_url();?>messages/sent">Sent</a></li>	
				<li class="nav-trash"><a href="<?php echo base_url();?>messages/trash">Trash</a></li>	
			</ul>
		</div>
	</div>
	<div id="content" class="inbox-v2 inbox-item-detail">			
		<?php  	
		if($view_message) 
		{
			$i = 0;
			foreach ($view_message as $items) 
			{ ?>
			
		<div class="msg-detailbox">	
			<div class="top-msg-detbar">
				<div style="float:left;"><?php echo $items->subject; ?></div>
				<div style="border:none; float:right;"><?php echo $items->created; ?></div>
			</div>		
			<div class="msg-body-det">
				<div class="inbox-item-header" style="background:none; border:none;">
					<!--<p class="to"><span class="label"><b>To: </b></span><?php  //echo $items->to_user_email; ?></p>-->
                                        <p class="to"><span class="label"><b>From: </b></span><?php  echo $items->from_user_email; ?></p>
					<p class="date"><span class="label"><b>Date: </b></span><?php echo  $items->created; ?></p>
					<p class="date"><span class="label"><b>Subject: </b></span><?php echo  $items->subject; ?></p>
				</div>
				<div class="inbox-item-body">
					<span class="text">
						<?php echo  $items->message; ?>
					</span>
				</div>				
				<div class="wrap-repfwd">
					<a class="replylink" href="">Reply</a> &nbsp;&nbsp; <a class="forwardlink" href="">Forword</a> &nbsp;&nbsp;

					<?php /* <a class="delete_mail" href="<?php echo base_url();?>messages/move_trash_mail/<?php echo $items->message_id; ?>">Delete</a> */ ?>
					
					<?php 
						$attributes = array('id' => 'compose','name' => 'compose','class' => 'reply_messages msgform inbox-compose forms', ); 
						echo form_open('messages/compose', $attributes); 
					?>	
					<input type="hidden" name="conv_id" value="<?php echo $items->conv_id; ?>" />
					<div class="inbox-item-header">
						<ul>
							<li class="to">
								<label for="connectionNames-msgForm">To:</label>
								<div class="elem">
									<?php echo form_error('toUserEmail'); ?>	
									<div id="ccAutoComplete">
										<div id="ccAutoCompleteSpacer"></div>
										<div id="ccInputHolder">
											<input type="text" size="2" id="ccInput" name="toUserEmail" readonly="readonly" value="<?php  echo $items->from_user_email; ?>" class="yui-ac-input" style="width: 300px; visibility: visible; ">
										</div>
									</div>				
								</div>
							</li>
							<li>						
								<label for="subject">Subject:</label>
								<div class="elem">
									<input type="text" name="subject" value="Re: <?php echo $items->subject; ?>" id="subject" class="input-text" maxlength="150">
								</div>
							</li>
						</ul>
					</div>
					<?php echo form_error('bodyMessages'); ?>
					<div class="inbox-item-body">
						<textarea name="bodyMessages" id="bodyMessages" class="field tinymce input-msgbox"  rows="2" cols="10"><?php echo  $items->message; ?></textarea>
						
					</div>
                                        <?php /*On <?php echo $items->created; ?>, <?php echo '<'.$items->from_user_email.'>'; ?> wrote: */?>
						<div class="inbox-item-body-primary">
							<ul class="inbox-actions">
								<li><input type="submit" name="submit" value="Send Message" class="btn-ternary"></li>
								<li><a href="" title="Cancel" class="btn-quaternary">Cancel</a></li>
							</ul>
						</div>
					<?php echo form_close(); ?>	
					<?php /*** reply message form end */ ?>

					<?php 
						$attributes = array('id' => 'compose','name' => 'compose','class' => 'forward_messages msgform inbox-compose forms', ); 
						echo form_open('messages/compose', $attributes); 
					?>	
					<input type="hidden" name="conv_id" value="<?php echo $items->conv_id; ?>" />
					<div class="inbox-item-header">
						<ul>
							<li class="to">
								<label for="connectionNames-msgForm">To:</label>
								<div class="elem">
									<?php echo form_error('toUserEmail'); ?>	
									<div id="ccAutoComplete">
										<div id="ccAutoCompleteSpacer"></div>
										<div id="ccInputHolder">
											<input type="text" size="2" id="ccInput" name="toUserEmail" value="" class="yui-ac-input" style="width: 300px; visibility: visible; ">
										</div>
									</div>				
								</div>
							</li>
							<li>						
								<label for="subject">Subject:</label>
								<div class="elem">
									<input type="text" name="subject" value="fwd: <?php echo $items->subject; ?>" id="subject" class="input-text" maxlength="150">
								</div>
							</li>
						</ul>
					</div>
					<?php echo form_error('bodyMessages'); ?>
					<div class="inbox-item-body">
						<textarea name="bodyMessages" id="bodyMessages" class="field tinymce input-msgbox"  rows="2" cols="10"><?php echo  $items->message; ?></textarea>
						<?php /*On <?php echo $items->created; ?>, <?php echo '<'.$items->from_user_email.'>'; ?> wrote: */?>
						<div class="inbox-item-body-primary">
							<ul class="inbox-actions">
								<li><input type="submit" name="submit" value="Send Message" class="btn-ternary"></li>
								<li><a href="" title="Cancel" class="btn-quaternary">Cancel</a></li>
							</ul>
						</div>
					</div>			
					<?php echo form_close(); ?>	

					
				</div>	
			</div>
		
		</div>
		
		<?php 						
			} 
			
		}
                else 
                { ?>							
                    <br/><div class="error">Oop! something went wrong.</div>
                <?php 
                }
                ?>
		
	</div>
</div>