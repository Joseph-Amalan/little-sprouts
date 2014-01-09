<div class="other-box yellow-box ui-corner-all">
    <div class="cont tooltip ui-corner-all" title="">
        <h3>Welcome !</h3> <br/>
       <?php /* <p><b>Admintasia</b> is a <b>complete</b>, fully and easily customisable <b>backend administration user interface</b>. Please proceed to the actual demo by clicking the <b>Ok</b> button below. Enjoy !</p> */ ?>
	</div>
</div> 
<?php /*
<div class="page-title ui-widget-content ui-corner-all">
    <h1>Viewing: <b>Dashboard</b></h1>
    <div class="other">
		<div class="float-left">You can put some text/buttons here or just remove this div.</div>
		<div class="button float-right">
			<a href="#"  class="btn ui-state-default"><span class="ui-icon ui-icon-circle-plus"></span>Example</a>
		</div>
		<div class="clearfix"></div>
    </div>
</div> */ 
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
 <br/> 
<div class="page-title ui-widget-content ui-corner-all">
    <h1>Administration Options</h1>
    <div class="other">
		<ul id="dashboard-buttons">
			<li>
				<a href="<?php echo base_url(); ?>admin_area/create_user_account" class="Mail_compose tooltip" title="Create User account">Create User Account</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>admin_area/import_data/import_data_db" class="Box_recycle tooltip" title="Import">Import</a>
			</li>
                        <li>
				<a href="<?php echo base_url(); ?>admin_area/data_entry/index" class="Clipboard_3 tooltip" title="Data Entry">Data Entry</a>
			</li>	
                        <li>
				<a href="<?php echo base_url(); ?>admin_area/export_data/index" class="Box_recycle tooltip" title="Export">Export</a>
			</li>	
<!--			<li>
				<a href="<?php echo base_url(); ?>admin_area/reporting/pending_renter_request" class="Books tooltip" title="Reporting">Reporting</a>
			</li>-->
			<?php /*<li>
				<a href="<?php echo base_url(); ?>admin_area/list_renters" class="Clipboard_3 tooltip" title="List of renters">List of renters</a>
				<div class="clearfix"></div>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>admin_area/list_landlords" class="Clipboard_3 tooltip" title="List of landlord">List of landlord</a>
				<div class="clearfix"></div>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>admin_area/list_csr" class="Clipboard_3 tooltip" title="List of CSR">List of CSR</a>
				<div class="clearfix"></div>
			</li> 
			
			
			<li>
				<a href="#" class="Briefcase_files tooltip" title="Briefcase files"></a>
			</li>
			<li>
				<a href="#" class="Chart_5 tooltip" title="Chart 5">Chart</a>
			</li>
			<li>
				<a href="#" class="Glass tooltip" title="Glass">Glass</a>
			</li>
			<li>
				<a href="#" class="Globe tooltip" title="Globe">Globe</a>
			</li>
			<li>
				<a href="#" class="Star tooltip" title="Active account">List of renters</a>
				<div class="clearfix"></div>
			</li>
			<li>
				<a href="#" class="Mail_compose tooltip" title="Mail compose">Mail compose</a>
			</li>
			<li>
				<a href="#" class="Mail_open tooltip" title="Mail open">Mail open</a>
			</li>
			<li>
				<a href="#" class="Monitor tooltip" title="Monitor">Monitor</a>
			</li>  */ ?>
		</ul>
		<div class="clearfix"></div>
    </div>
</div> 

<?php /*
<div class="title title-spacing">
    <h2>Dashboard grid example</h2>
    You can put whatever you like in these containers. I've mode some examples using accordions, buttons, news, tabs and forms. 
	For more grid examples, visit <a href="#" title="More layout examples">this page</a>.
</div>

*/ ?>
<div class="three-column">
    <div class="column">
		<?php /*<div class="portlet form-bg">
			 <div class="portlet-header">Form Example 2</div>
			<div class="portlet-content">
				<form action="#" method="post" enctype="multipart/form-data" class="forms" name="form" >
					<ul>
						<li>
							<label class="desc">
									Email:
							</label>
							<div>
								<input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="" />
								<span class="red">Error message example ...</span>
							</div>
						</li>
						<li>
							<label class="desc">
									Password:
							</label>
							<div>
								<input type="password" tabindex="1" maxlength="255" value="" class="field text full" name="" />
								<label>These inputs have class="full", which means that they have 100% width.</label>
							</div>
						</li>
						<li class="buttons">
							<button type="submit" value="Submit" class="ui-state-default ui-corner-all" id="saveForm">Login</button>
						</li>
					</ul>
				</form>
				<div class="linetop clearfix"></div>
				<p>Added class="form-bg" to obtain the light gray background.</p>
			</div> 
		</div> */ ?>
		</div>
    <div class="column">
		<?php /* <div class="portlet">
			<div class="portlet-header">Tabs, messages and tables</div>
			 <div class="portlet-content">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">First</a></li>
						<li><a href="#tabs-2">Second</a></li>
						<li><a href="#tabs-3">Third</a></li>
					</ul>
					<div id="tabs-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
					<div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
					<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
				</div>
				<div class="clearfix"></div>
				<i class="note">* Table example below: </i>
				<div class="hastable">
					<table cellspacing="0">
						<thead>
							<tr>
								<td><input type="checkbox" class="checkbox" value=""/></td>
								<td>Name</td>
								<td>Email</td>
								<td>Options</td>
							</tr>
						</thead>
						<tbody>
							<tr>  	  	
								<td>
									<input type="checkbox" class="checkbox" value=""/>
								</td>
								<td>
									John 
								</td>
								<td>
									Lorem .
								</td>
								<td>
									Options
								</td>
							</tr>
							<tr class="alt">  	  	
								<td>
									<input type="checkbox" class="checkbox" value=""/>
								</td>
								<td>
									 John 
								</td>
								<td>
									Lorem .
								</td>
								<td>
								   Options
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div> 
		</div>*/ ?>
    </div>
    <div class="column">
		<?php /* <div class="portlet"> */ ?>
			<?php /* <div class="portlet-header">Buttons</div> */ ?>
			<div class="portlet-content">
			<?php /*	<p>Admintasia contains a total of more than 180 icons. I only added a few for demonstration. In the theme package you will find a page that contains all buttons you have at your disposal (buttons.html)</p>
				<ul id="icons" class="ui-widget ui-helper-clearfix">
						<li class="ui-state-default ui-corner-all" title=".ui-icon-star"><span class="ui-icon ui-icon-star"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-link"><span class="ui-icon ui-icon-link"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-cancel"><span class="ui-icon ui-icon-cancel"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-plus"><span class="ui-icon ui-icon-plus"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-plusthick"><span class="ui-icon ui-icon-plusthick"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-minus"><span class="ui-icon ui-icon-minus"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-minusthick"><span class="ui-icon ui-icon-minusthick"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-close"><span class="ui-icon ui-icon-close"></span></li>

						<li class="ui-state-default ui-corner-all" title=".ui-icon-script"><span class="ui-icon ui-icon-script"></span></li>
						<li class="ui-state-default ui-corner-all" title=".ui-icon-alert"><span class="ui-icon ui-icon-alert"></span></li>

				</ul>
				<div class="clearfix"></div>
				<p>You can transform those icons into links.See the examples below.</p>

				<div class="clearfix"></div>
				<a href="#" class="btn ui-state-default ui-corner-all">
					<span class="ui-icon ui-icon-grip-dotted-horizontal"></span>
					Button 1
				</a>
				<a href="#" class="btn ui-state-default ui-corner-all">
					<span class="ui-icon ui-icon ui-icon-gripsmall-diagonal-se"></span>
					Button 2
				</a>
				<a href="#" class="btn ui-state-default ui-corner-all">
					<span class="ui-icon ui-icon-grip-solid-horizontal"></span>
					Button 3
				</a>
				<div class="clearfix"></div>
				<p class="title-spacing linetop">Here is a pagination example:</p>
				<ul class="pagination">
					<li class="previous-off">&laquo;Previous</li>
					<li class="active">1</li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>

					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
					<li><a href="#">7</a></li>
					<li><a href="#">8</a></li>
					<li><a href="#">9</a></li>

					<li><a href="#">10</a></li>
					<li class="next"><a href="#">Next &raquo;</a></li>
				</ul>
		*/	?>	<div class="clearfix"></div>
			</div>
		<?php /* </div> */ ?>
	</div>
</div>

