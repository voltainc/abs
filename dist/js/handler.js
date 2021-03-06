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

function table_operations(arg){
	
	// var data = jQuery.parseJSON(arg);
	
	switch(arg[0]){
		
		case "create_category":
		
			var content = $.trim($("#content").val());
	
					
						
								$.ajax	
															(
																	{
																		type: "POST",
																		url: "../assets/proc.php",
																		data: "act=create_category&content="+content,
																		cache: false,
																		success: function(result){
																			
																			var data = jQuery.parseJSON(result);
																			
																				if(data['status']=='success')
																				{
																					window.location='category';	 
																			
																				}else{
																					
																						 $("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																				}
																			
																		}
																	}
															);
						
		
		break;
		
		case "create_event":
		
			var content = $.trim($("#content").val());
	
					
						
								$.ajax	
															(
																	{
																		type: "POST",
																		url: "../assets/proc.php",
																		data: "act=create_event&content="+content,
																		cache: false,
																		success: function(result){
																			
																			var data = jQuery.parseJSON(result);
																			
																				if(data['status']=='success')
																				{
																					window.location='event';	 
																			
																				}else{
																					
																						 $("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																				}
																			
																		}
																	}
															);
						
		
		break;
		
		case "create_fee":
		
			var content = $.trim($("#content").val());
	
					
						
								$.ajax	
															(
																	{
																		type: "POST",
																		url: "../assets/proc.php",
																		data: "act=create_fee&booking="+arg[1]+"&content="+content,
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
		
		case "reject_booking":
		
						
								$.ajax	
															(
																	{
																		type: "POST",
																		url: "../assets/proc.php",
																		data: "act=reject_booking&booking="+arg[1],
																		cache: false,
																		success: function(result){
																			
																			var data = jQuery.parseJSON(result);
																			
																				if(data['status']=='success')
																				{
																					window.location='dashboard';	 
																			
																				}else{
																					
																						 $("#notify_2").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																				}
																			
																		}
																	}
															);
						
		
		break;
		
		case "delete_booking":
		
						
								$.ajax	
															(
																	{
																		type: "POST",
																		url: "assets/proc.php",
																		data: "act=delete_booking&booking="+arg[1],
																		cache: false,
																		success: function(result){
																			
																			var data = jQuery.parseJSON(result);
																			
																				if(data['status']=='success')
																				{
																					window.location='dashboard';	 
																			
																				}else{
																					
																						 $("#notify_2").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
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

function retrieve(arg){
	
		switch(arg[0]){
			
			case "search_artist":
				
				
				var category = $.trim($("#category").val());
				var from = $.trim($("#from").val());
				var to = $.trim($("#to").val());
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=search_artist&category="+category+"&from="+from+"&to="+to,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	
																	$("#result").html(data['message']);
																	
																}else{
																	
																		$("#result").html("<blockquote>"+data['message']+"</blockquote>"); 
																}
															
														}
													}
											);
			
			
			break;
			
			case "artist_profile":
				
				
				var category = $.trim($("#category").val());
				
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=artist_profile&artist="+arg[1],
														cache: false,
														success: function(result){
																	
																	$("#artist_profile").html(result);
															
														}
													}
											);
			
			
			break;
			
			case "create_booking":
				
				var category = $.trim($("#category").val());
				var from = $.trim($("#from").val());
				var to = $.trim($("#to").val());
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=create_booking&artist="+arg[1]+"&category="+category+"&from="+from+"&to="+to,
														cache: false,
														success: function(result){
															
															var data = jQuery.parseJSON(result);
															
																if(data['status']=='success')
																{
																	
																	retrieve(['search_artist']);
																	
																	
																}else{
																	
																		$("#notify").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+data['message']+"</div>"); 
																}
															
														}
													}
											);
			
			
			break;
			
			case "invoice":
				
				$.ajax	
											(
													{
														type: "POST",
														url: "assets/proc.php",
														data: "act=invoice&booking="+arg[1],
														cache: false,
														success: function(result){
															
															$("#booking_invoice").html(result);
															
															
														}
													}
											);
			
			
			break;
			
		}
	
}
	
function clip_func(x){
	//#arg id funcname params
	switch(x[0]){
		
		case "clip_add_category":
			
			$("#content").val("")
			$("#"+x[1]).attr("onclick",x[2]+x[3]);
			
		break;
		case "clip_add_event":
			
			$("#content").val("")
			$("#"+x[1]).attr("onclick",x[2]+x[3]);
			
		break;
		case "clip_add_fee":
			
			$("#content").val("")
			$("#"+x[1]).attr("onclick",x[2]+x[3]);
			
		break;
		case "clip_reject_booking":
			
			$("#"+x[1]).attr("onclick",x[2]+x[3]);
			
		break;
		case "clip_delete_booking":
			
			$("#"+x[1]).attr("onclick",x[2]+x[3]);
			
		break;
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

jQuery('.dtpickerwt').datetimepicker({
  timepicker:true,
  format:'Y/m/d H:i',
});
jQuery('.dtpickerwd').datetimepicker({
  timepicker:false,
  format:'Y/m/d',
});
