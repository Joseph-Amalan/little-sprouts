<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--
/*
|--------------------------------------------------------------------------
| LITTLE SPROUTS
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
<meta name="description" content="<?php echo $meta_description; ?>" />
<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
<meta http-equiv="expires" content="0" />
<meta name="Robots" content="index,follow" />
<meta name="revisit-after" content="2 Days" />
<meta name="language" content="en-us"/>

<link href="<?php echo base_url();?>includes/styles/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>includes/styles/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>includes/styles/tables.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>includes/styles/reset.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
        <link rel="stylesheet" href="<?php echo base_url();?>includes/styles/ie-style.css" type="text/css" />
<![endif]-->
<link href="<?php echo base_url();?>includes/styles/thickbox.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url();?>includes/styles/jquery-ui-datepicket.css" rel="stylesheet" media="all" />

<?php echo $_styles; ?> 

<script type="text/javascript" src="<?php echo base_url();?>includes/scripts/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/scripts/jquery-ui-datepicker.js"></script>
	
<!-- CuFon: Enables smooth pretty custom font rendering. 100% SEO friendly. To disable, remove this section -->
<script src="<?php echo base_url();?>includes/scripts/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>includes/scripts/arial.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>includes/scripts/cuf_run.js" type="text/javascript"></script>
<!-- CuFon ends -->

<script type="text/javascript" src="<?php echo base_url();?>includes/scripts/thickbox.js"></script>	
<script type="text/javascript" src="<?php echo base_url();?>includes/scripts/tooltip.js" ></script>

<script type="text/javascript" src="<?php echo base_url();?>includes/scripts/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/scripts/functions.js"></script>

<?php echo $_scripts; ?>
</head>

<body>

<!-- Main Body Starts -->
<div class="main">
	<!-- Top Header (Advertisement + Search) include -->
	<?php echo $topheader;?>  

	<!-- header with slide show bar starts -->
  <div class="header">
    	
	<!-- Mega Drop Down include --> 
   	<?php echo $megadropdown;?> 
	    
  </div>
<!-- header with slide show bar ends -->

<!-- Body Starts -->
  <div class="body_bg">
    <div class="body">
	<!-- Main Website Content Starts -->
      <div class="left_resize block">
             <?php echo $content;?> 	    
      </div>
    <!-- Main Website Content Ends -->	
	
    </div>
  </div>
<!-- Body Ends -->  

<!-- Footer Starts --> 	
	<?php echo $footer;?>
<!-- Footer Ends -->

</div>
<!-- Main Body Ends -->

</body>
</html>
