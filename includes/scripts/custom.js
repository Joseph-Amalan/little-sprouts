// JavaScript Document
var BASE_URL = "http://"+window.location.hostname+"/";

$(function(){
    
 //-----------inbox and invitation count starts----------------------------//
 
 // auto refresh after 3 min 
  $("#show-count").load(BASE_URL+"common/msg_invt_count").addClass("notification-bubble");
   
   setInterval(function() {
      $("#show-count").addClass("notification-bubble"); 
      $("#show-count").load(BASE_URL+"common/msg_invt_count");
   }, 180000);
   $.ajaxSetup({ cache: false });
     
 ////-----------inbox and invitation count starts----------------------------\\\\

	$('.popup .close, .popup-shader').click(function(){
        $('.popup, .popup-shader').hide();
    });
	
	// prevent cut, copy, paste textfeild
	$('#textbox_id').bind("cut copy paste", function(e) {
		
        e.preventDefault();
        $('#textbox_id').bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });
	
	$('.inactive_user').live('click', function(e) {	
	  
	   e.preventDefault();
	   var user_id = jQuery(this).attr("id")
	   if (confirm('Are you sure you want to delete your account?'))
	   {   
			jQuery('.popup, .popup-shader').css('display', 'block');
			jQuery('.popup .header').html('Delete account');
			
			jQuery.ajax({
			 type		 : "POST",  
			 url         : BASE_URL+"ajax_inactive_user_account/inactive_user_account/" + user_id,
			 dataType 	 : 'json',
			 success     : function (data)
			 {				
				if (data.status === "success")
				{  
				   jQuery('.popup .body').html(data.msg);
				}
				else
				{
				   jQuery('.popup .body').html(data.msg);
				}			
				jQuery(window.location).attr('href', BASE_URL+"/logout");
				setTimeout("jQuery('.popup, .popup-shader').hide(); ", 10000);
			 }
		  });
	   }
		   
	});
	
	jQuery('#checkallnone').live('click',function(){
		if(jQuery(this).is(':checked')){
			jQuery('.msgcheck').each(function() {
				jQuery(this).attr("checked", "checked").closest('li').addClass('checked');
			});
		}else{
			if(jQuery(this).css('opacity')<1){
				jQuery(this).css('opacity',1);
			}
			jQuery('.msgcheck').each(function() {
				jQuery(this).removeAttr("checked").closest('li').removeClass('checked');
			});
		}
	});
	
	$('.msgcheck').change(function(){
	
		if($('.msgcheck:checked').length==$('.msgcheck').length){
			$('#checkallnone').attr("checked", "checked").css('opacity',1);
		}else if($('.msgcheck:checked').length>0){
			$('#checkallnone').attr("checked", "checked").css('opacity',0.5);
		}else{
			$('#checkallnone').removeAttr('checked').css('opacity',1);
		}
		if($(this).is(':checked')){
			$(this).closest('li').addClass('checked');
		}else{
			$(this).closest('li').removeClass('checked');
		}
	});	
	
	jQuery('.delresmsg').live('click',function(){
	            
		if(jQuery('.msgcheck:checked').length==0){
			alert('No message checked.');
		}else{
			var cheval=new Array();
			var tid = jQuery(this).attr('id');
			//alert(tid);
			jQuery('.msgcheck:checked').each(function(index, element) {
				cheval.push(jQuery(this).val());
			});
						
			if(tid=='deletemsg'){
				url= BASE_URL+"messages/move_trash/"+cheval;
				
			}else if(tid=='markunreadmsg'){				
				url= BASE_URL+"messages/mark_unread/"+cheval;
				
			}else if(tid=='restoremsg'){			
				url= BASE_URL+"messages/restore/"+cheval;
				
			}else if(tid=='deletepermanently'){
				url= BASE_URL+"messages/delete_permanently/"+cheval;
				
			}else if(tid=='deleteinvitation'){
										
				url= BASE_URL+"invitations/delete_invitation/"+cheval;
				
			}else{
				alert('Error.');
				url='';
			}

			jQuery.get(url, function(data) {				
				if(tid=='deletemsg' || tid=='restoremsg' || tid=='deletepermanently' || tid=='deleteinvitation'){					
					jQuery('.msgcheck:checked').closest('li').remove();
				}else if(tid=='markunreadmsg'){
					jQuery('.msgcheck:checked').closest('li').addClass('unreadmail');
				}
			});
                        
		 $("#show-count").addClass("notification-bubble"); 
		 $("#show-count").load(BASE_URL+"common/msg_invt_count");
		}
	});
	
	jQuery('.wrap-repfwd .replylink').click(function(){
		var thpar = jQuery(this).parent('.wrap-repfwd');
		jQuery('form.forward_messages', thpar).hide(0);
		jQuery('form.reply_messages', thpar).show(0);
		return false;
	});
	jQuery('.wrap-repfwd .forwardlink').click(function(){
		var thpar = jQuery(this).parent('.wrap-repfwd');
		jQuery('form.reply_messages', thpar).hide(0);
		jQuery('form.forward_messages', thpar).show(0);
		return false;
	});
	jQuery('form.reply_messages .discard').click(function(){
		jQuery(this).closest('form.replyforward').hide(0);
	});
	
      	
	jQuery('html').click(function() { 
		jQuery('#reply_accept').hide(); 
		jQuery('#reply_ignore').hide();
		jQuery('.view_profile_popup').hide();
	}); 
	
	//on mouse over, view mini profile	
	 jQuery('.miniprofile').mouseover(function() {
             
		 var id = jQuery(this).attr('id');
             
		jQuery('.view_profile_popup').hide();			
		jQuery("#view_"+id).show();			
				
	});
	
	//on click, close the mini profile popup
	jQuery('.miniprofile-close').click(function() {		
		jQuery('.view_profile_popup').hide();
	});
        
	//Date Picker
	//http://keith-wood.name/datepick.html        
	//$('.date_picker').datepick({dateFormat: 'mm-dd-yyyy'}).attr('readonly', true);     
	
	//on blur, change phone number format
	jQuery('.mobilephone').blur(function() {
		var values = jQuery(this).val();
						
		if(values.match(/^\d{3}-\d{3}-\d{4}$/)) {
			return true;
		} else {		
			
			if (values == ""){
				alert("Please enter phone number");
				$(".mobilephone").focus();
				return false;
				
			}else if (isNaN(values)){
				alert("Phone Number should be in number");
				$(".mobilephone").val("");
				$(".mobilephone").focus();
				return false;
				
			}else if (values.length != 10) {			
				alert("Phone Number shuold be in 10 character");
				$(".mobilephone").val("");
				$(".mobilephone").focus();
				return false;
			
			} else {					
				pvalue = values.substr(0, 3) + '-' + values.substr(3, 3) + '-' + values.substr(6,4)
				jQuery('.mobilephone').val(pvalue);
				return true;
			}
		}
    });	
	
	//on blur, change phone number format
	jQuery('.homephone').blur(function() {	 
		var value = jQuery(this).val();
		
		if(value.match(/^\d{3}-\d{3}-\d{4}$/)) {
			return true;
		} else {	
		
			if (value == ""){
				alert("Please enter phone number");
				$(".homephone").focus();
				return false;
				
			}else if (isNaN(value)){
				alert("Home Number should be in number");
				$(".homephone").val("");
				$(".homephone").focus();
				return false;
				
			}else if (value.length != 10) {			
				alert("Home Number shuold be in 10 character");
				$(".homephone").val("");
				$(".homephone").focus();
				return false;
				
			} else {					
				pvalue = value.substr(0, 3) + '-' + value.substr(3, 3) + '-' + value.substr(6,4)
				jQuery('.homephone').val(pvalue);
				return true;
			}
		}
    });	
	
	//on blur, change phone number format
	 jQuery('.workphone').blur(function() {
		var value = jQuery(this).val();
		
		if(value.match(/^\d{3}-\d{3}-\d{4}$/)) {
			return true;			
		} else {	
		
			if (value == ""){
				alert("Please enter phone number");
				$(".workphone").focus();
				return false;
				
			}else if (isNaN(value)){
				alert("Work Number should be in number");
				$(".workphone").val("");
				$(".workphone").focus();
				return false;
				
			}else if (value.length != 10) {			
				alert("Work Number shuold be in 10 character");
				$(".workphone").val("");
				$(".workphone").focus();
				return false;
			
			} else {					
				pvalue = value.substr(0, 3) + '-' + value.substr(3, 3) + '-' + value.substr(6,4)
				jQuery('.workphone').val(pvalue);
				return true;
			}
		}
    });	
	
	//on blur, change phone number format
	jQuery('.ssn').blur(function() {	 
		var value = jQuery(this).val();
		
		if(value.match(/^\d{3}-\d{2}-\d{4}$/)) {
			return true;
			
		} else {	
		
			if (value == ""){
				alert("Please enter SSN number");
				$(".ssn").focus();
				return false;
				
			}else if (isNaN(value)){
				alert("SSN should be in number");
				$(".ssn").val("");
				$(".ssn").focus();
				return false;
				
			}else if (value.length != 9) {			
				alert("SSN Number shuold be in 9 Number");
				$(".ssn").val("");
				$(".ssn").focus();
				return false;
				
			} else {						
				pvalue = value.substr(0, 3) + '-' + value.substr(3, 2) + '-' + value.substr(5,4)
				jQuery('.ssn').val(pvalue);
				return true;
			}
		}			
    });
	
	//on blur, change phone number format
	 jQuery('.landlordPhone').blur(function() {
		var value = jQuery(this).val();
		
		if(value.match(/^\d{3}-\d{3}-\d{4}$/)) {
			return true;
			
		} else {	
		
			if (value == ""){
				alert("Please enter Phone number");
				$(".landlordPhone").focus();
				return false;
				
			}else if (isNaN(value)){
				alert("Phone Number should be in number");
				$(".landlordPhone").val("");
				$(".landlordPhone").focus();
				return false;
				
			}else if (value.length != 10) {			
				alert("Phone Number shuold be in 10 character");
				$(".landlordPhone").val("");
				$(".landlordPhone").focus();
				return false;
				
			} else {					
				pvalue = value.substr(0, 3) + '-' + value.substr(3, 3) + '-' + value.substr(6,4)
				jQuery('.landlordPhone').val(pvalue);
				return true;
			}
		}
    });	
	
	//on blur, change phone number format
	 jQuery('.csrphone').blur(function() {
		var value = jQuery(this).val();
		
		if(value.match(/^\d{3}-\d{3}-\d{4}$/)) {
			return true;
			
		} else {	
		
			if (value == ""){
				alert("Please enter Phone number");
				$(".csrphone").focus();
				return false;
				
			}else if (isNaN(value)){
				alert("Phone Number should be in number");
				$(".csrphone").val("");
				$(".csrphone").focus();
				return false;
				
			}else if (value.length != 10) {			
				alert("Phone Number shuold be in 10 character");
				$(".csrphone").val("");
				$(".csrphone").focus();
				return false;
				
			} else {					
				pvalue = value.substr(0, 3) + '-' + value.substr(3, 3) + '-' + value.substr(6,4)
				jQuery('.csrphone').val(pvalue);
				return true;
			}
		}
    });	
		
	//on blur, change phone number format
	 jQuery('.csrAltphone').blur(function() {
		var value = jQuery(this).val();
		
		if(value.match(/^\d{3}-\d{3}-\d{4}$/)) {
			return true;
			
		} else {	
		
			if (value == ""){
				alert("Please enter Phone number");
				$(".csrAltphone").focus();
				return false;
				
			}else if (isNaN(value)){
				alert("Phone Number should be in number");
				$(".csrAltphone").val("");
				$(".csrAltphone").focus();
				return false;
				
			}else if (value.length != 10) {			
				alert("Phone Number shuold be in 10 character");
				$(".csrAltphone").val("");
				$(".csrAltphone").focus();
				return false;
				
			} else {					
				pvalue = value.substr(0, 3) + '-' + value.substr(3, 3) + '-' + value.substr(6,4)
				jQuery('.csrAltphone').val(pvalue);
				return true;
			}
		}
    });
	
	// end of phone validation 
	
	
	//Birth date 
	//$('.dob_date_picker').datepick({ yearRange: '1930:2011', dateFormat: 'mm-dd-yyyy'}).attr('readonly', true);       
	
	
	jQuery('.reply-invitation').live('click',function(){ 
	//jQuery('.toggle-btn').live('click',function(){	
		var id = jQuery(this).attr('id');
		var value = jQuery(this).attr('value');
		
		if(id=='reply-accepted'){
			//jQuery("#reply-rejected").attr("disabled",'disabled');
			//jQuery('#accept_invitation_message').show('slow');	
						
			jQuery('.popup, .popup-shader').css('display', 'block');
			jQuery('.popup .header').html('Send messages');
			jQuery.post(BASE_URL+"ajax_invitation_reply/invitations_reply/"+value, function(data) {
				jQuery('.popup .body').html(data);
			});

			
		}else if(id=='reply-rejected'){	
			//jQuery("#reply-accepted").attr("disabled",'disabled');
			//jQuery('#reject_invitation_message').show('slow');
						
			jQuery('.popup, .popup-shader').css('display', 'block');
			jQuery('.popup .header').html('Send messages');
			jQuery.post(BASE_URL+"ajax_invitation_reply/invitations_reply/"+value, function(data) {
				jQuery('.popup .body').html(data);
			});

		}else if(id=='invitation-accepted'){	
					
			jQuery.post(BASE_URL+"invitations/accept_invitation/"+value, function(data) {				
				jQuery('.accepted').show();
				jQuery('.msgcheck').closest('li').remove();
				jQuery('#accepted').html(data);
			});

		}else if(id=='cancel_reply'){	
			jQuery('#accept_invitation_message').hide('slow');
			jQuery('#reject_invitation_message').hide('slow');
			jQuery("#reply-rejected").removeAttr('disabled');
			jQuery("#reply-accepted").removeAttr('disabled');
		}				
	}); 
	
	//sign up tab next click
	jQuery('.nextbtn').live('click',function(){
		
		var id = jQuery(this).attr('id');
		if(id=='nexttab_2'){			
			ident = id.split("_")[1]; 		
		}else if(id=='nexttab_3'){	
			ident = id.split("_")[1]; 					
		}else if(id=='nexttab_4'){	
			ident = id.split("_")[1]; 					
		}else if(id=='nexttab_5'){	
			ident = id.split("_")[1]; 					
		}else if(id=='nexttab_6'){	
			ident = id.split("_")[1]; 					
		}
		
		jQuery("div#tabscon ul").attr("data-current",ident);		 
		var current = jQuery("div#tabscon ul").attr("data-current");
		var old_tab = current - 1;
		 
		//remove class of activetabheader and hide old contents
		jQuery("#tabHeader_" + old_tab).removeAttr("class");
		jQuery("#tabpage_" + old_tab).css("display", "none");
		
		//add class of activetabheader to new active tab and show contents
		jQuery("#tabHeader_" + current).attr("class","tabActiveHeader");
		jQuery("#tabpage_" + ident).css("display", "block");
		
	});	
        
	$("#tabContainer input,#tabContainer select").bind("blur", function () {           
	   
	   //About you data
		var fullName = $('input[name=userFirstName]').val() + " " + $('input[name=userMiddleName]').val() + " " + $('input[name=userLastName]').val() + " " + $('input[name=userSuffix]').val();
		var prefName = $('input[name=userPreferredName]').val();
		
		var dob = $('input[name=userDob]').val();
		
		var mbNo = $('input[name=userMobileNo]').val();
		var hNo = $('input[name=userHomePhone]').val();
		var wkNo = $('input[name=userWorkPhone]').val();
		
		$('#jname').html(fullName);
		
		//alert(name);
	   /*
		var tr = $('#tabpage_5 tr');
		tr.each(function(){
			//alert( fields[$(this).index()] )
			$(this).children('td:nth-child(1)').html(fields[$(this).index()]);
		});
		*/	
	});
	
	//user clicks into the text box,the default text �Begin Typing to Search� will disappear
	//$("#faq_search_input").watermark("Begin Typing to Search");
	
	//search renter result 
	/*$("#renter_search_input").keyup(function()
	{
		var faq_search_input = $(this).val();
		if(faq_search_input.length>0)
		{					
			$.ajax({
				type: "GET",
				url: BASE_URL + "csr/search/renters/" + faq_search_input,
				data: 'json',
				beforeSend:  function() {
					$('input#faq_search_input').addClass('loading');
				},
				success: function(server_response)
				{
					$('#searchresultdata').html(server_response).show();
					//$('span#faq_category_title').html(faq_search_input);

					if ($('input#faq_search_input').hasClass("loading")) {
						$("input#faq_search_input").removeClass("loading");
					} 
				}
			});
		}
		return false;
	});*/
		
	
	
	
});
