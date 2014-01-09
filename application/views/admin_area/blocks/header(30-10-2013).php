<div id="header">
    <?php $admin_logged_in = FALSE; ?>
    <?php $admin_logged_in = $this->session->userdata('admin_logged_in');
    ?>  
    <div id="top-menu">
        <?php if ($admin_logged_in == TRUE) { ?>
            <?php /* <a href="#" title="My account">My account</a> | 
              <a href="#" title="Settings">Settings</a> |
              <a href="#" title="Contact us">Contact us</a>  |
              <a href="#" title="Edit profile">Edit profile</a> | */ ?>
            <span>Logged in as <a href="<?php echo base_url(); ?>admin_area/dashboard" title="Logged in as admin">admin</a></span> | 
            <a href="<?php echo base_url(); ?>admin_area/logout" title="Logout">Logout</a>
        <?php } ?>

    </div>

    <div id="sitename">
        <a href="<?php echo base_url(); ?>admin_area/dashboard" class="logo float-left" title="Admintasia">Little Sprouts Administrator</a>          
    </div>
    <?php if ($admin_logged_in == TRUE) { ?>
        <ul id="navigation" class="sf-navbar">
            <li>
                <a href="<?php echo base_url(); ?>admin_area/dashboard">Dashboard</a>				
                <ul>					
                    <li><a href="<?php echo base_url(); ?>admin_area/create_user_account">Create User Account</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_area/import_data/import_data_db">Import</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_area/data_entry/index">Data Entry</a></li>
                    <li><a href="<?php echo base_url(); ?>admin_area/export_data/index">Export</a></li>
                    <!--					<li><a href="<?php echo base_url(); ?>admin_area/reporting/pending_renter_request">Reporting</a></li>-->
                </ul> 
            </li>
        </ul>
    <?php } ?>
</div>