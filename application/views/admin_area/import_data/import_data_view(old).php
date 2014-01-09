<div class="title title-spacing">
        <h2>Import Data into Database</h2>        
</div>

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

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
        <div class="portlet-header ui-widget-header">Import Data</div>
        <div class="portlet-content">
                <?php		
                $attributes = array('id' => 'import_data','name' => 'import_data','class' => 'forms', 'enctype'=>'multipart/form-data'); 
                echo form_open('admin_area/import_data/import_data_db', $attributes); 
                ?> 
				<ul>
					<li>
						<div>
                                                   
					<ul>
						<li>
							<label class="desc">
									Upload File:
							</label>
							<div>
								<input type="file" tabindex="1" size="40" class="field text full" name="import_data_file"  />
                                                                <input type="hidden" tabindex="1" size="40" class="field text full" name="import_data_e"  />
<!--								<span class="red">Error message example ...</span>-->
							</div>
						</li>
						
						<li class="buttons">
							<button type="submit" value="Submit" class="ui-state-default ui-corner-all" id="saveForm">Submit</button>
						</li>
					</ul>
				</form>
                                   
						</div>
					</li>
					
				</ul>
                <?php echo form_close(); ?>
        </div>
</div>
<div class="clearfix"></div>
<!--<i class="note">* Just a simple note here ...</i>-->
