<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFING 
| ------------------------------------------------------------------- 
| Configuration of outgoing mail server. 
| */   

$config['protocol']='smtp';  
$config['smtp_host']='ssl://smtp.googlemail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='300';  
$config['smtp_user']='selvem.jose@gmail.com';  
$config['smtp_pass']='selvem.jose';  
$config['charset']='utf-8';  
$config['newline']="\r\n";  
$config['newline']= "\r\n";
$config['mailtype'] = 'html'; // text or html
$config['validation'] = TRUE; // bool whether to validate email or not      
  
/* End of file email.php */  
/* Location: ./system/application/config/email.php */ 