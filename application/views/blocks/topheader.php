<?php $logged_in = FALSE;
$user_role_id = FALSE; ?>
<?php $logged_UserName = $this->session->userdata('user_name'); ?>  
<?php $logged_in = $this->session->userdata('logged_in'); ?>  
<?php $user_role_id = $this->session->userdata('user_role_id'); ?>  

<div class="header">
    <div class="header_resize">
        <div class="mylogo" class="center">
            <h1>
           Little Sprouts Data Warehouse
            </h1>
<!--<a href="<?php echo base_url(); ?>index"> 			
                                <img src="<?php echo base_url(); ?>includes/images/inspire_logo.png" width="220" height="70" />
                        </a>-->

        </div>
        <!--		  <div class="menu">
                                <ul>
                                  <li><a href="<?php echo base_url(); ?>index" class="active">Home</a></li>
                                  <li><a href="<?php echo base_url(); ?>#">Services</a></li>
                                  <li><a href="<?php echo base_url(); ?>about_us">About Us</a></li>
<?php if ($logged_in == FALSE) { ?>  <li><a href="<?php echo base_url(); ?>sign_up_role">Register</a></li>	<?php } ?>  
                                  <li><a href="<?php echo base_url(); ?>contact_us">Contact Us</a></li>
                                </ul>
                          </div>-->
        <div class="text_header">

                <?php if ($logged_in == FALSE) { ?> 
                <div class="fleft">
    <?php echo date("F j, Y"); ?>		&nbsp;&nbsp;
                </div>
    <!--			<div class="fleft"><a href="<?php echo base_url(); ?>forgot_password">forgot password</a> | <a href="<?php echo base_url(); ?>sign_up_role">sign-up</a> | <a href="<?php echo base_url(); ?>login">login</a></div>-->
                <div class="fleft"> <a href="<?php echo base_url(); ?>sign_up_role">sign-up</a> | <a href="<?php echo base_url(); ?>login">login</a></div>
            <?php } ?>
               <?php if ($logged_in == TRUE) { ?> 
                <div class="fleft" style="color:green">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo date("F j, Y"); ?> &nbsp;&nbsp; Welcome <?php if ($user_role_id == 1) {
                    //echo "User"; 
                    echo $logged_UserName;
                } ?>
                </div>
<?php } ?>


        </div>
        <div class="clr"></div>
    </div>	  
</div>	
<style>
    #mylogo {
        color: #FF0000;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 30px;
        font-weight: bold;
        margin: 0 auto;
        padding: 33px;
        text-align: center;
        text-transform: uppercase;
        width: auto;
        font-color:black;
    }
    .mylogo h1 {
    color: #000000;
    font: 40px/1.2em Arial,Helvetica,sans-serif;
    margin: 0;
    padding: 24px 0 24px 40px;
}
</style>

