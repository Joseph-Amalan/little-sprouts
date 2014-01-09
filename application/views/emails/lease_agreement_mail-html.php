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
	 <tr><td colspan='2'>Dear <?php echo $landlord_name; ?>,</td></tr>
	 <?php  foreach($renter_data as $item) { ?>
	 <tr>
		 <td colspan='2'>	
			Tenant <?php echo $item->renter_first_name . ' ' . $item->renter_middle_name . ' '. $item->renter_last_name; ?> of 
			<?php echo $item->renter_address_line_one . ' '. $item->renter_address_line_two . ', ' . ucfirst($item->renter_city) . ', ' . $item->state_name . ' ' . $item->renter_zip_code; ?>, 
			has requested that we provide bill payment services from his account to yours. Your assistance is necessary to complete this process.
		 </td>
	 </tr>
	 <?php } ?>
	 <tr>
		 <td colspan='2'>	
			Please follow this link to verify your tenant’s lease information and to designate where you would like payments submitted.
			<a target="_blank" style="text-decoration:none" href="<?php echo $generate_lease_confirmation_link; ?>" >
			<?php echo $generate_lease_confirmation_link; ?></a>
		 </td>
	 </tr>
	 <tr><td colspan='2'></td></tr>
	 <tr>
		 <td colspan='2'>
			 The benefits to you of this service include:
			 <ul> 
				<li>On-time payments, every time</li>
				<li>Complete payments</li>
				<li>Payments deposited directly into your account</li>
				<li>Faster availability of funds</li>
				<li>Reporting of tenant’s payment behavior to credit bureau on your behalf</li>
				<li>Email notification of payments for your records</li>
				<li>Online history of payments</li>
			</ul>
		</td>
	</tr>	 
	<tr>
	<td colspan='2'>Inspire Credit’s payment is safe and secure, backed by Norton Security, the nation’s leader in online security. Please feel
		free to contact us with any questions at 800-555-INSPIRE.
	</td>
	</tr>
	<tr><td colspan='2'>Thank you,</td></tr>
	<tr>
		<td colspan='2'>
			<address>Alex Casteel</address>
			<address><i>Co-founder, Inspire Credit</i></address>
			<address><a href='http://www.inspirecredit.com' title='inspirecredit.com'>www.inspirecredit.com</a></address>
		</td>
	</tr>
	</table>
</body>
</html>