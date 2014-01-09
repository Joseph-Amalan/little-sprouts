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
				<li class="nav-compose active"><a href="<?php echo base_url();?>messages/compose"><em>Compose Message</em></a></li>
				<li class="nav-inbox "><a href="<?php echo base_url();?>messages/inbox">Inbox</a></li>
				<li class="nav-sent "><a href="<?php echo base_url();?>messages/sent">Sent</a></li>
				<li class="nav-trash "><a href="<?php echo base_url();?>messages/trash">Trash</a></li>	
			</ul>
		</div>
	</div>
	<div id="content" class="inbox-v2 inbox-v2 inbox-compose">		
		<div id="inbox-tabview" class="inbox-tabview">
			Compose
			<div class="content" >	
				<span class="tabs-v2"></span>
				<?php 
				$attributes = array('id' => 'compose','name' => 'compose','class' => 'forms'); 
				echo form_open('messages/compose', $attributes); 
				?>	
				<ul class="inbox-actions">
					<li><input type="submit" name="submit" value="Send Message" class="btn-quaternary"></li>
					<li><a href="<?php echo base_url();?>messages/inbox" title="Cancel" class="btn-quaternary">Cancel</a></li>
				</ul>
				<div class="inbox-item-header">
					<ul>
						<li class="to">
							<label for="connectionNames-msgForm">To:</label>
							<div class="elem">
								<?php echo form_error('toUserEmail'); ?>		
								<div id="ccAutoComplete">
									<div id="ccAutoCompleteSpacer"></div>
									<div id="ccInputHolder">
									<input type="text" size="2" id="ccInput" name="toUserEmail" value="<?php echo set_value('toUserEmail'); ?>" class="yui-ac-input" autocomplete="off" style="width: 300px; visibility: visible; " >
									</div>
								</div>				
							</div>
						</li>
						<li>
							<label for="subject-msgForm">Subject:</label>
							<div class="elem">
								<?php echo form_error('subject'); ?>
								<input type="text" name="subject" value="<?php echo set_value('subject'); ?>" id="subject" class="input-text" >
							</div>
						</li>
					</ul>
				</div>
				<?php echo form_error('bodyMessages'); ?>
				<div class="inbox-item-body">
					<textarea name="bodyMessages" id="bodyMessages" class="input-msgbox"></textarea>					
				</div>
                                <div class="inbox-item-body-primary">
                                    <ul class="inbox-actions">
                                            <li><input type="submit" name="submit" value="Send Message" class="btn-ternary"></li>
                                            <li><a href="<?php echo base_url();?>messages/inbox" title="Cancel" class="discard btn-quaternary">Cancel</a></li>
                                    </ul>
				</div>
				<?php echo form_close(); ?>			
			</div>
		</div>	
	</div>
</div>