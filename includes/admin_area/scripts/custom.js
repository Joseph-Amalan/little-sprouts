// JavaScript Document

var BASE_URL = "http://"+window.location.hostname+"/";
//alert(BASE_URL);

$(document).ready(function() { 

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
				alert("Mobile Number should be in number");
				$(".mobilephone").val("");
				$(".mobilephone").focus();
				return false;
				
			}else if (values.length != 10) {			
				alert("Mobile Number shuold be in 10 character");
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



	// Navigation menu

	/*$('ul#navigation').superfish({ 
		delay:       1000,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast',
		autoArrows:  true,
		dropShadows: false
	});*/
         $('ul#navigation li:first').children('ul').hide();
        $('ul#navigation li:first').hover(function(){
            $(this).children('ul').show();
        },function(){
            $(this).children('ul').hide();
        });
	
	$('ul#navigation li').hover(function(){
		$(this).addClass('sfHover2');
	},
	function(){
		$(this).removeClass('sfHover2');
	});

	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// Tabs
	$('#tabs, #tabs2, #tabs5').tabs();

         /*    
	// Dialog			
	$('#dialog').dialog({
		autoOpen: false,
		width: 600,
		bgiframe: false,
		modal: false,
		buttons: {
			"Ok": function() { 
				$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
       
	// Login Dialog Link
	$('#login_dialog').click(function(){
		$('#login').dialog('open');
		return false;
	});

	// Login Dialog			
	$('#login').dialog({
		autoOpen: false,
		width: 300,
		height: 230,
		bgiframe: true,
		modal: true,
		buttons: {
			"Login": function() { 
				$(this).dialog("close"); 
			}, 
			"Close": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
        
        // Dialog Link
	$('#dialog_link').click(function(){
		$('#dialog').dialog('open');
		return false;
	});

	// Dialog auto open			
	$('#welcome').dialog({
		autoOpen: true,
		width: 470,
		height: 180,
		bgiframe: true,
		modal: true,
		buttons: {
			"View Admintasia V1.0": function() { 
				$(this).dialog("close"); 
			}			
		}
	});

	// Dialog auto open			
	$('#welcome_login').dialog({
		autoOpen: true,
		width: 370,
		height: 430,
		bgiframe: true,
		modal: true,
		buttons: {
			"Proceed to demo !": function() {
				window.location = "index.php";
			}
		}
	});
        */
	
	

	// Datepicker
	$('#datepicker').datepicker({
		inline: true
	});
	
	//http://keith-wood.name/datepick.html        
	$('.date_picker').datepick({dateFormat: 'mm-dd-yyyy'}).attr('readonly', true); 
	
	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	//Sortable

	$(".column").sortable({
		connectWith: '.column'
	});

	//Sidebar only sortable boxes
	$(".side-col").sortable({
		axis: 'y',
		connectWith: '.side-col'
	});

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header")
			.addClass("ui-widget-header")
			.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
			.end()
		.find(".portlet-content");

	$(".portlet-header .ui-icon").click(function() {
		$(this).toggleClass("ui-icon-circle-arrow-n");
		$(this).parents(".portlet:first").find(".portlet-content").slideToggle();
	});

	$(".column").disableSelection();


	/* Table Sorter */
	$("#sort-table")
	.tablesorter({
		widgets: ['zebra'],
		headers: { 
		            // assign the secound column (we start counting zero) 
		            0: { 
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            }, 
		            // assign the third column (we start counting zero) 
		            6: { 
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            } 
		        } 
	})
	
	.tablesorterPager({container: $("#pager")}); 

	$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

	
});

	/* Tooltip */

	$(function() {
		$('.tooltip').tooltip({
			track: true,
			delay: 0,
			showURL: false,
			showBody: " - ",
			fade: 250
			});
		});
		
	/* Theme changer - set cookie */

    $(function() {
       
		$("link[title='style']").attr("href","css/styles/default/ui.css");
        $('a.set_theme').click(function() {
           	var theme_name = $(this).attr("id");
			$("link[title='style']").attr("href","css/styles/" + theme_name + "/ui.css");
			$.cookie('theme', theme_name );
			$('a.set_theme').css("fontWeight","normal");
			$(this).css("fontWeight","bold");
        });
		
		var theme = $.cookie('theme');
	    
		if (theme == 'default') {
	        $("link[title='style']").attr("href","css/styles/default/ui.css");
	    };
	    
		if (theme == 'light_blue') {
	        $("link[title='style']").attr("href","css/styles/light_blue/ui.css");
	    };
	

	/* Layout option - Change layout from fluid to fixed with set cookie */
       
       $("#fluid_layout a").click (function(){
			$("#fluid_layout").hide();
			$("#fixed_layout").show();
			$("#page-wrapper").removeClass('fixed');
			$.cookie('layout', 'fluid' );
       });

       $("#fixed_layout a").click (function(){
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
			$("#page-wrapper").addClass('fixed');
			$.cookie('layout', 'fixed' );
       });

	    var layout = $.cookie('layout');
	    
		if (layout == 'fixed') {
			$("#fixed_layout").hide();
			$("#fluid_layout").show();
	        $("#page-wrapper").addClass('fixed');
	    };

		if (layout == 'fluid') {
			$("#fixed_layout").show();
			$("#fluid_layout").hide();
	        $("#page-wrapper").addClass('fluid');
	    };	
	});
    
    
/* Check all table rows */
	
var checkflag = "false";
function check(field) {
	if (checkflag == "false") {
		for (i = 0; i < field.length; i++) {
		field[i].checked = true;}
		checkflag = "true";
		return "check_all"; 
	}
	else {
		for (i = 0; i < field.length; i++) {
		field[i].checked = false; }
		checkflag = "false";
		return "check_none"; 
	}
}

function confirmWindow(UserName, user_id, user_email)
{
	var agree = window.confirm("Are Sure Want to Delete User '"+ UserName + "'");
	if (agree)
	{	
		//alert(BASE_URL+"admin_area/list_renters/delete_profile/" + user_id + '/' + user_email);
		jQuery(window.location).attr('href', BASE_URL+"admin_area/list_renters/delete_profile/" + user_id + '/' + user_email);
	}	
	else
	{
	  return false ;
	}
}
function confirmLandlordDeleteWindow(UserName, user_id, user_email)
{
	var agree = window.confirm("Are Sure Want to Delete User '"+ UserName + "'" );
	if (agree)
	{	
		//alert(BASE_URL+"admin_area/list_landlords/delete_profile/" + user_id + '/' + user_email);
		jQuery(window.location).attr('href', BASE_URL+"admin_area/list_landlords/delete_profile/" + user_id + '/' + user_email);
	}	
	else
	{
	  return false ;
	}
}

function confirmCsrDeleteWindow(UserName, user_id, user_email)
{
	var agree = window.confirm("Are Sure Want to Delete User '"+ UserName + "'");
	if (agree)
	{	
		//alert(BASE_URL+"admin_area/list_landlords/delete_profile/" + user_id + '/' + user_email);
		jQuery(window.location).attr('href', BASE_URL+"admin_area/list_csr/delete_profile/" + user_id + '/' + user_email);
	}	
	else
	{
	  return false ;
	}
}


