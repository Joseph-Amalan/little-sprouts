<div class="left ">
  <h2><span></span> What is Credit Rocket ?</h2>
  
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
  
  <img src="<?php echo base_url();?>includes/images/img_1.jpg" alt="img" width="128" height="128" class="floated" />
  
  <p>Credit Rocket, Inc ('CR') would like to build a website application for its primary business and transaction foundation.  
  The application is intended to allow renters to document and submit their rent payments to credit reporting agencies (Trans Union, 
  Equifax and Experian) so Credit Rocket can facilitate the payments application towards improving the renter's credit score.</p><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</div>