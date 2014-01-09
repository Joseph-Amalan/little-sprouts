

<div class="left"> <div id="FBalbum"></div>   
	<h2 style="text-align:center;"><span>Boost Your Credit Simply By Paying Rent</span></h2> <br/>
        
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
	
	<!-- table starts -->
	<div class="hastable">
		<table> 
			<tbody>
				<tr>
					<td><img src="<?php echo base_url();?>includes/images/process-icon.gif" width="100" align="left" border="0" height="100" hspace="0">
						Create your account
					</td>
					<td><img src="<?php echo base_url();?>includes/images/rightme-icon.jpg" width="100" align="left" border="0" height="100" hspace="0"> 
						Pay your rent
					</td>
					<td><img src="<?php echo base_url();?>includes/images/whowe-icon.gif" width="100" align="left" border="0" height="100" hspace="0">
						Boost your credit score!
					</td>
				</tr>   
			</tbody>
		</table>						
	</div>
	<!-- table ends --> 		  		
</div>
<div class="left ">
	<h2><span></span> What is Credit Rocket ?</h2>
	
	<img src="<?php echo base_url();?>includes/images/img_1.jpg" alt="img" width="128" height="128" class="floated" />
	
	<p>Credit Rocket, Inc ('CR') would like to build a website application for its primary business and transaction foundation.  
	The application is intended to allow renters to document and submit their rent payments to credit reporting agencies (Trans Union, 
	Equifax and Experian) so Credit Rocket can facilitate the payments application towards improving the renter's credit score.</p><br/>
	
	<a href="#"><img src="<?php echo base_url();?>includes/images/reading.gif" alt="img" width="121" height="28" border="0" /></a> 		 
</div>