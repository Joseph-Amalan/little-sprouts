<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Inspire Credit</title></head>
<body>
	<table style='background-color:#ffffff;font-family:Helvetica Neue,Arial,Verdana; font-size:12px;border: 1px solid rgb(204, 204, 204);' align='center' border='0' cellpadding='5px' cellspacing='10px' width='650px' >
	<tr>
		<td></td>
		<td align='right'>
			<a href='http://www.facebook.com/inspirecredit' target='_blank' title='inspirecredit Facebook'>
				<img src='<?php echo base_url();?>includes/images/facebook.png' border='0' height='23' width='23' alt='Facebook' title='inspirecredit Facebook'>
			</a> 
		</td>
	</tr>
	<tr>
		<td valign='middle' width='50%'>
		   <a href='http://www.inspirecredit.com/' target='_blank' title='inspirecredit.com'>
				<img src='<?php echo base_url();?>includes/images/inspire_logo.png' alt='inspirecredit Logo' title='inspirecredit Logo' border='0'>
		   </a>
		 </td>
	 </tr>
	 <tr><td colspan='2'></td></tr>
	 <?php  foreach($renter_data as $item) { ?>
	 <tr><td colspan='2'>Dear <?php echo ucfirst($item->renter_first_name); ?>,</td></tr>
	
	 <tr>
		 <td colspan='2'>	
			Your landlord, <?php echo $item->landlord_first_name . ' ' . $item->landlord_last_name; ?> has rejected your lease information.
			Please see the reason below:
		</td>
	 </tr>
	  <?php } ?>		 
	  <tr>
		 <td colspan='2' style="background:#FD8B8E; color:#000; font-size:14px; font-weight:bold;">	
			<?php echo nl2br(strip_tags($body_messages)); ?>
		</td>
	 </tr>	
	  <tr>
		 <td colspan='2'>	
			 Please click on the link below to re-submit the application to your landlord.
		</td>
	 </tr>	
	  <tr>
		 <td colspan='2'>	
			<?php echo $re_lease_verification_link; ?>
		</td>
	 </tr>
	 <tr>
		 <td colspan='2'>
			 The benefits to you of this service include:
			 <ul> 
				<li>On-time payments, every time</li>
				<li>Complete payments</li>
				<li>Payments made directly from your account</li>
				<li>Reporting of your payments to participating credit bureau</li>
				<li>Email notification of payments for your records</li>
				<li>Online history of payments</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td colspan='2'>Inspire Credit's payment is safe and secure, backed by Norton Security, the nation's leader in online security. Please feel
			free to contact us with any questions at 800-555-INSPIRE.
		</td>
	</tr>
	<tr><td colspan='2'>Thank you,</td></tr>
	<tr>
		<td colspan='2'>
			<address>Alex Casteel</address>
			<address>Co-founder, Inspire Credit</address>
			<address><a href='http://www.inspirecredit.com' title='inspirecredit.com'>www.inspirecredit.com</a></address>
		</td>
	</tr>
	</table>
</body>
</html>