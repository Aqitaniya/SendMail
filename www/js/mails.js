var type_order={
	theClass_mail:'no',
	theClass_date:'desc',
	set:function(){
		this.theClass_mail = $('#mail_order').attr('class');
		this.theClass_date = $('#date_order label').attr('class');
	}
};
function direction(){
	var array_pageHref = (location.toString()).split( '/' );
	var array_pageHref_length = array_pageHref.length;
	var mails_type;
	
	for (var i = 1; i < array_pageHref_length; i++){
		if(array_pageHref[i] == 'in' || array_pageHref[i] == 'out'){
			mails_type = array_pageHref[i];
			break;
		} else {
			mails_type = 'in';	
		}
	}
	
	return mails_type;
}

function update_table(field, order){
	$.ajax({
		type: "post",
		url:  location,
		cache: false,
		data: {field: field,
			   order: order},
		success: function(data) {
			$('#mails').html(data);
			add_date_order();
		}
	}); 
}	
	
//order mails by date
$('#mails').on('click', '#date_order', function(){
	var theClass = $(this).find('label').attr('class');
	
	if (theClass == 'desc'){
		update_table('date', 'asc');
	} else if (theClass == 'asc'){
	    update_table('date', 'desc');
	} else if (theClass == 'no'){
	    update_table('date', 'desc');
	}
});

//order mails by mail
$('#mails').on('click', '#mail_order', function() {
	var theClass = $(this).attr('class');
	
	if (theClass == 'desc'){
		update_table('mail', 'asc');
    } else if (theClass == "asc"){
	    update_table('mail', 'desc');
	} else if (theClass == "no"){
	    update_table('mail', 'desc');
	}
});
	
//view mail
$('#mails').on('click',  
			   'tbody td:nth-child(2), tbody td:nth-child(3), tbody td:nth-child(4)',
			   function(){
	var id_mail = $(this).closest('tr').find('input.letter_delete').val();
	var mails_type = direction();
	
	window.location.href = window.location.origin+'/index.php/view/mail/'+mails_type+'/'+id_mail;
});

	
$('#write_mail').click(function(){
	var mails_type = direction();	
	
	window.location.href = window.location.origin+'/index.php/write/mail/'+mails_type;
});
	

$('#main_page').click(function(){
	window.location.href = history.back();
	window.location.href = history.back();
});
	
	
$("#delete_mails").click(function(){ 
	var mails_type = direction();
	var id_mails =new Array();
	var all_mails;
	
	$("input[class='letter_delete_all']:checked").each(function() {all_mails = "all";});
	$("input[class='letter_delete']:checked").each(function() {id_mails.push($(this).val());});
	type_order.set();
	if(all_mails == "all"){
		delete_mails(mails_type, all_mails);
	} else {
		delete_mails(mails_type, id_mails);
	}
});
function delete_mails(mails_type, mails){
	$.ajax({
		type: "post",
		url:  window.location.origin+"/index.php/mails/del",
		cache: false,				
		data: {mails_type: mails_type,
			   mails: mails},
		success: function(data){
			if(data != ''){
				alert(data);
			} else {
				order_table(type_order.theClass_mail,type_order.theClass_date);
			}
		}
	});
}  

function add_date_order(){
	$("table thead th:nth-child(4)").attr('id', 'date_order');
}

$(document).ready(function(){
	add_date_order();
});

//update the list of letters
setInterval(
	function(){
		var mails_in = window.location.origin+"/index.php/mails/in";
		var mails_out = window.location.origin+"/index.php/mails/out";
		var carent_link = location.toString();
		var rez_in = carent_link.indexOf(mails_in);
		var rez_out = carent_link.indexOf(mails_out);
		
		if (rez_in != -1 || rez_out != -1){	
			type_order.set();
			order_table(type_order.theClass_mail,type_order.theClass_date);
		}
	},
50000);

function order_table(theClass_mail,theClass_date){
	if (theClass_mail == 'asc'){
		update_table('mail', 'asc');
	} else if (theClass_date == "asc"){
		update_table('date', 'asc');
	} else if (theClass_mail == "desc"){
		update_table('mail', 'desc');
	} else if (theClass_date == "desc"){
		update_table('date', 'desc');
	}	
};

