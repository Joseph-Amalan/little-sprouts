<div class="other-box ui-corner-all" style="height:338px;">		
    <div style="overflow: hidden; z-index: 1002; outline: 0px; height: auto; width: 414px; margin:50px 0px 0px 427px;" class="ui-dialog ui-widget ui-widget-content ui-corner-all  ui-draggable" tabindex="-1" role="dialog" aria-labelledby="ui-dialog-title-login">
		<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix" unselectable="on">
			<span class="ui-dialog-title" id="ui-dialog-title-login" unselectable="on">Members Login</span>
			<a href="#" class="ui-dialog-titlebar-close ui-corner-all" role="button" unselectable="on"></a>
		</div>
		
		<?php	
		
		$attributes = array('id' => 'admin_login','name' => 'admin_login','class' => 'forms'); 
		echo form_open('admin_area/index', $attributes); ?> 
		
		<div style="height: auto; min-height: 48px; width: auto; " class="ui-dialog-content ui-widget-content">
                   
			<ul>
				<li>				
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
				</li>
				<li>
					<label for="email" class="desc">User Name:</label>
					<div>
						<input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="admin_username" id="admin_username">
						<?php echo form_error('admin_username'); ?>
					</div>
				</li>
				<li>
					<label for="password" class="desc">Password:</label>
					<input type="password" tabindex="1" maxlength="255" value="" class="field text full" name="admin_password" id="admin_password">
					<?php echo form_error('admin_password'); ?>
				</li>
			</ul>
		</div>
		<div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
			<button type="submit" class="ui-state-default ui-corner-all">Login</button>	
		</div>
		<?php echo form_close(); ?>
	</div>
</div>