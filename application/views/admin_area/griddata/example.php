<div class="title title-spacing">
        <h2>Grid Data</h2>        
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
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<div>
<!--		<a href='<?php echo site_url('admin_area/examples/customers_management')?>'>Customers</a> |
		<a href='<?php echo site_url('admin_area/examples/orders_management')?>'>Orders</a> |
		<a href='<?php echo site_url('admin_area/examples/products_management')?>'>Products</a> |
		<a href='<?php echo site_url('admin_area/examples/offices_management')?>'>Offices</a> | -->
<!--		<a href='<?php echo site_url('admin_area/examples/employees_management')?>'>Employees</a> |		 
		<a href='<?php echo site_url('admin_area/examples/film_management')?>'>Films</a> | 
		<a href='<?php echo site_url('admin_area/examples/film_management_twitter_bootstrap')?>'>Twitter Bootstrap Theme [BETA]</a> | 
		<a href='<?php echo site_url('admin_area/examples/multigrids')?>'>Multigrid [BETA]</a>-->
		
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>

