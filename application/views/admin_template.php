<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<!--
	/*
	|--------------------------------------------------------------------------
	|  LITTLE SPROUTS
	|--------------------------------------------------------------------------
	| AUTHOR 	VEMBU
	|--------------------------------------------------------------------------
	| CONTACT AT 	vembu [AT] knstek [DOT] COM	
	|--------------------------------------------------------------------------
	|
	*/
	-->
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="Robots" content="index,follow">
	<meta name="revisit-after" content="2 Days">
	<meta name="language" content="en-us">

	<!--<link rel="shortcut icon" href="<?php echo base_url();?>includes/admin_area/images/favicon.ico">-->
	<link href="<?php echo base_url();?>includes/admin_area/styles/style.css" rel="stylesheet" media="all" />	
	<link href="<?php echo base_url();?>includes/admin_area/styles/general.css" rel="stylesheet" media="all" />
	<link href="<?php echo base_url();?>includes/admin_area/styles/thickbox.css" rel="stylesheet" media="all" />   
<link href="<?php echo base_url();?>includes/admin_area/scripts/js/themes/redmond/jquery-ui.custom.css" type="text/css"  rel="stylesheet" media="screen" />  
        <link href="<?php echo base_url();?>includes/admin_area/scripts/js/jqgrid/css/ui.jqgrid.css"  type="text/css"  rel="stylesheet" media="screen" /> 	
	<?php echo $_styles; ?>

	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/jquery-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/superfish.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/tablesorter.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/tablesorter-pager.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/cookie.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/thickbox.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/custom.js"></script>
	
	  <script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/js/jqgrid/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/js/jqgrid/js/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>includes/admin_area/scripts/js/themes/jquery-ui.custom.min.js"></script>
      
    

	<?php echo $_scripts; ?>

	<!--[if IE 6]>
	<link href="<?php echo base_url();?>includes/admin_area/styles/ie6.css" rel="stylesheet" media="all" />

	<script src="<?php echo base_url();?>includes/admin_area/scripts/pngfix.js"></script>
	<script>
	  /* EXAMPLE */
	  DD_belatedPNG.fix('.logo, .other ul#dashboard-buttons li a');
	</script>
	<![endif]-->
	<!--[if IE 7]>
	<link href="<?php echo base_url();?>includes/admin_area/styles/ie7.css" rel="stylesheet" media="all" />
	<![endif]-->

	</head>
	<body>
	<!-- Main Body Starts -->

	  <!-- Header include -->     
			<?php echo $header;?> 
	  <!-- Header include Ends -->		

	<div id="page-wrapper">
	<!-- Body Starts -->
			<div id="main-wrapper">
				<div id="main-content">
					<?php echo $content;?> 
				</div>
				<div class="clearfix"></div>
			</div>
	<!-- Body Ends -->	

	<!-- Right Side Bar Starts -->
		<?php $admin_logged_in = FALSE;?>
		<?php $admin_logged_in = $this->session->userdata('admin_logged_in'); ?>
			<?php if($admin_logged_in) {  ?>
			<div id="sidebar">
				<?php echo $right_side_bar;?> 			
				<div class="clearfix"></div>
			</div>
			<?php }; ?>        
	<!-- Right Side Bar Ends -->		
	</div>
	<div class="clearfix"></div>		

	<!-- Footer Starts --> 	
		<?php echo $footer;?>
	<!-- Footer Ends -->

	<!-- Main Body Ends -->
	</body>
</html>
