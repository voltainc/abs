$(".datatable").DataTable();

function validate_creds(arg){
	
	
	switch(arg){
		
		case "customer":
		
			
			
			var email = $.trim($("#email").val());
			var password = $.trim($("#password").val());
	
								$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=validate_creds_customer&email="+email+"&password="+password,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	window.location='dashboard';
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
	
		
		
		break;
		
		
		case "artist":
		
			
			
			var email = $.trim($("#email").val());
			var password = $.trim($("#password").val());
	
								$.ajax	
											(
													{
														type: "POST",
														url: "../assets/proc.php",
														data: "act=validate_creds_artist&email="+email+"&password="+password,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	window.location='dashboard';
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
	
		
		
		break;
		
		case "admin":
		
			
			
			var email = $.trim($("#email").val());
			var password = $.trim($("#password").val());
	
								$.ajax	
											(
													{
														type: "POST",
														url: "../assets/proc.php",
														data: "act=validate_creds_admin&email="+email+"&password="+password,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	window.location='dashboard';
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
	
		
		
		break;
		
		
	}
	
}


function register(arg){

	switch(arg[0]){
		
		case "customer":
		
			var name = $.trim($("#name").val());
			var email = $.trim($("#email").val());
			var password = $.trim($("#password").val());
			var age = $.trim($("#age").val());
			var address = $.trim($("#address").val());
			var phone = $.trim($("#phone").val());
			var question = $.trim($("#question").val());
			var answer = $.trim($("#answer").val());
	
								$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=create_customer&name="+name+"&email="+email+"&password="+password+"&age="+age+"&address="+address+"&phone="+phone+"&question="+question+"&answer="+answer,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	$("#notify").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																	redirect(['w_delay','4000','../prj/']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
	
		
						
		
		break;
		
		case "artist":
		
			
			var file_data = $('#pfp').prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('file', file_data);
			form_data.append('act', "create_artist");
			form_data.append('name',$.trim($("#name").val()));
			form_data.append('email',$.trim($("#email").val()));
			form_data.append('password',$.trim($("#password").val()));
			form_data.append('age',$.trim($("#age").val()));
			form_data.append('status',$.trim($("#status").val()));
			form_data.append('skill',$.trim($("#skill").val()));
			form_data.append('origin',$.trim($("#origin").val()));
			form_data.append('category',$.trim($("#category").val()));
			form_data.append('question',$.trim($("#question").val()));
			form_data.append('answer',$.trim($("#answer").val()));
								$.ajax	
											(
													{
														url: '../assets/proc.php', 
														dataType: 'json',
														cache: false,
														contentType: false,
														processData: false,
														data: form_data,                         
														type: 'post',
														success: function(result){
															
															
																if(result['status']=='success')
																{
																	$("#notify").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+result['message']+"</div>"); 
																	redirect(['w_delay','4000','../artist']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+result['message']+"</div>"); 
																}
															
														}
													}
											);
	
		
						
		
		break;
		
		
			
	}
	
	
	
}

function reset(arg){
	
	switch(arg[0]){
		
		case "customer_verify":
				
				var email = $.trim($("#email").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=customer_verify&email="+email,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	
																	redirect(['','reset-question']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
				
			
			
		break;
		
		
		
		case "customer_question":
				
				var answer = $.trim($("#answer").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=customer_question&answer="+answer,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	
																	redirect(['','reset-password']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
				
			
			
		break;
		
		case "customer_password":
				
				var password = $.trim($("#password").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=customer_password&password="+password,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	$("#notify").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																	redirect(['w_delay','3000','../prj/']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
				
			
			
		break;
		
		
		case "artist_verify":
				
				var email = $.trim($("#email").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "../assets/proc.php",
														data: "act=artist_verify&email="+email,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	
																	redirect(['','reset-question']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
				
			
			
		break;
		
		case "artist_question":
				
				var answer = $.trim($("#answer").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "../assets/proc.php",
														data: "act=artist_question&answer="+answer,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	
																	redirect(['','reset-password']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
				
			
			
		break;
		
		case "artist_password":
				
				var password = $.trim($("#password").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "../assets/proc.php",
														data: "act=artist_password&password="+password,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	$("#notify").html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																	redirect(['w_delay','3000','../artist']);
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
				
			
			
		break;
		
	}
	
}

	
function clip_func(x){
	//#arg id funcname params
	switch(x[0]){
		
		case "clip_add_sale":
			
			$("#cash").val("")
			$("#date").val("");
			$("#"+x[1]).attr("onclick",x[2]+x[3]);
			
		break;
		
		case "clip_edit_sale":
			//1->sale 2->cash 3->credit 4->date
			
			// console.log(x);
			
			$("#cash").val(x[3][2])
			$("#date").val(x[3][3]);
			var z = JSON.stringify(x[3]);
			
			$("#"+x[1]).attr("onclick",x[2]+"("+z+")");
		
		break
		
		
		
	}
	

	
}

function redirect(arg){
	
	switch(arg[0]){
		
		case "w_delay":
			var delay = arg[1]; 
			setTimeout(function(){ window.location = arg[2]; }, delay);
		break;
		
		default:
				window.location = arg[1];
		break;
	}
}

$('.datepicker').datepicker({
      autoclose: true
    });