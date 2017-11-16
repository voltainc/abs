<?php 
		require_once('funcs.php');
		$main = new main;
		$main->connect_db();

		
		switch(trim(@$_REQUEST['act'])){
			
			case "validate_creds_customer":
				
				$email = trim(@$_REQUEST['email']);
				$password = trim(@$_REQUEST['password']);
				
				if(!empty($email) AND !empty($password)){
					
						$q = mysql_query("select * from customer where email = '{$email}' and password = '{$password}'");
						if(mysql_num_rows($q)>0){
							$result = mysql_fetch_assoc($q);
							session_start();
							$_SESSION['customer'] = $result;
							echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Invalid Username / Password"));
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"All fields required"));
				}
			
			break;
			
			case "validate_creds_artist":
				
				$email = trim(@$_REQUEST['email']);
				$password = trim(@$_REQUEST['password']);
				
				if(!empty($email) AND !empty($password)){
					
						$q = mysql_query("select * from artist where email = '{$email}' and password = '{$password}'");
						if(mysql_num_rows($q)>0){
							$result = mysql_fetch_assoc($q);
							session_start();
							$_SESSION['artist'] = $result;
							echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Invalid Username / Password"));
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"All fields required"));
				}
			
			break;
			
			case "validate_creds_admin":
				
				$email = trim(@$_REQUEST['email']);
				$password = trim(@$_REQUEST['password']);
				
				if(!empty($email) AND !empty($password)){
					
						$q = mysql_query("select * from admin where email = '{$email}' and password = '{$password}'");
						if(mysql_num_rows($q)>0){
							$result = mysql_fetch_assoc($q);
							session_start();
							$_SESSION['admin'] = $result;
							echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Invalid Username / Password"));
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"All fields required"));
				}
			
			break;
			
			case "create_customer":
				
				$name = trim(@$_REQUEST["name"]);
				$age = trim(@$_REQUEST["age"]);
				$address = trim(@$_REQUEST["address"]);
				$phone = trim(@$_REQUEST["phone"]);
				$email = trim(@$_REQUEST["email"]);
				$password = trim(@$_REQUEST["password"]);
				$question = trim(@$_REQUEST["question"]);
				$answer = trim(@$_REQUEST["answer"]);
				$salt = $main->saltish("customer",15);
				if(!empty($name) AND !empty($email) AND !empty($password) AND !empty($age) AND !empty($address) AND !empty($phone) AND !empty($question) AND !empty($answer)){
						
						if(is_numeric($age) AND is_numeric($phone) AND filter_var($email, FILTER_VALIDATE_EMAIL)){
							
							$q = mysql_query("select * from customer where email = '{$email}'");
							if(mysql_num_rows($q)>0){
								echo json_encode(array("status"=>"error","message"=>"Email already exists"));
							}else{
								
								if(mysql_query("insert into customer values('','{$name}','{$age}','{$address}','{$phone}','{$email}','{$password}','{$salt}',(current_timestamp))")){
									$user = $main->ret_by("customer","salt",$salt,"id");
									if(mysql_query("insert into reset values('','customer','{$user}','{$question}','{$answer}',(current_timestamp))")){
										echo json_encode(array("status"=>"success","message"=>"Registration Successfull, you will be redirected to the login page"));
									}else{
										echo json_encode(array("status"=>"error","message"=>"Error in processing"));
									}
								}else{
									echo json_encode(array("status"=>"error","message"=>"Error in processing"));
								}
							}
							
						}else{
							echo json_encode(array("status"=>"error","message"=>"Invalid Data type"));
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"All fields required"));
				}
			
			break;
			
			case "create_artist":
				
					$file = @$_FILES['file'];
					$name = trim(@$_REQUEST["name"]);
					$age = trim(@$_REQUEST["age"]);
					$status = trim(@$_REQUEST["status"]);
					$skill = trim(@$_REQUEST["skill"]);
					$origin = trim(@$_REQUEST["origin"]);
					$category = trim(@$_REQUEST["category"]);
					$email = trim(@$_REQUEST["email"]);
					$password = trim(@$_REQUEST["password"]);
					$question = trim(@$_REQUEST["question"]);
					$answer = trim(@$_REQUEST["answer"]);
					$salt = $main->saltish("artist",15);
					
					if(!empty($file) AND !empty($name) AND !empty($age) AND !empty($status) AND !empty($skill) AND !empty($origin) AND !empty($category) AND !empty($email) AND !empty($password) AND !empty($question) AND !empty($answer)){
						
						if(is_numeric($age) AND filter_var($email, FILTER_VALIDATE_EMAIL)){
							
							$q = mysql_query("select * from artist where email = '{$email}'");
							if(mysql_num_rows($q)>0){
								echo json_encode(array("status"=>"error","message"=>"Email already exists"));
							}else{
								
								if(mysql_query("insert into artist values ('','{$name}','{$age}','{$status}','{$skill}','{$origin}','{$category}','{$email}','{$password}','{$salt}',(current_timestamp))")){
									
									$user = $main->ret_by("artist","salt",$salt,"id");
									if(mysql_query("insert into reset values('','artist','{$user}','{$question}','{$answer}',(current_timestamp))")){
										$main->upload($user,$file,"../artist/assets/{$user}/pfp/");
										echo json_encode(array("status"=>"success","message"=>"Registration Successfull, you will be redirected to the login page"));
									}else{
										echo json_encode(array("status"=>"error","message"=>"Error in processing"));
									}
								
									
								}else{
									echo json_encode(array("status"=>"error","message"=>"An error occured while processing"));
								}
								
							}
							
						}else{
							echo json_encode(array("status"=>"error","message"=>"Invalid Data type"));
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"All fields required"));
				}
					
				
			break;
			
			case "customer_verify":
			
				
					$email = trim(@$_REQUEST["email"]);
					if(!empty($email)){
						$q = mysql_query("select * from customer where email = '{$email}'");
								
						if(mysql_num_rows($q)){
								$result = mysql_fetch_assoc($q);
								session_start();
								$_SESSION['customer_verify'] = $result;
								echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Email not found"));
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
				
			
			break;
			
			case "customer_question":
			
					$answer = trim(@$_REQUEST["answer"]);
					if(!empty($answer)){
					session_start();
						$q = mysql_query("select * from reset where type='customer' and user='{$_SESSION['customer_verify']['id']}' and answer = '{$answer}'");
								
						if(mysql_num_rows($q)){
								$result = mysql_fetch_assoc($q);
								$_SESSION['customer_question'] = $_SESSION['customer_verify'];
								unset($_SESSION['customer_verify']);
								echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Wrong Answer"));
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "customer_password":
			
					$password = trim(@$_REQUEST["password"]);
					if(!empty($password)){
					session_start();
						$q = mysql_query("update customer set password='{$password}' where id='{$_SESSION['customer_password']['id']}'");
								
						if($q){
								unset($_SESSION['customer_password']);
								echo json_encode(array("status"=>"success","message"=>"Password has been reset you will be redirected to the login page"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Wrong Answer"));
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "artist_verify":
			
				
					$email = trim(@$_REQUEST["email"]);
					if(!empty($email)){
						$q = mysql_query("select * from artist where email = '{$email}'");
								
						if(mysql_num_rows($q)){
								$result = mysql_fetch_assoc($q);
								session_start();
								$_SESSION['artist_verify'] = $result;
								echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Email not found"));
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
				
			
			break;
			
			case "artist_question":
			
					$answer = trim(@$_REQUEST["answer"]);
					if(!empty($answer)){
					session_start();
						$q = mysql_query("select * from reset where type='artist' and user='{$_SESSION['artist_verify']['id']}' and answer = '{$answer}'");
								
						if(mysql_num_rows($q)){
								$result = mysql_fetch_assoc($q);
								$_SESSION['artist_question'] = $_SESSION['artist_verify'];
								unset($_SESSION['artist_verify']);
								echo json_encode(array("status"=>"success"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Wrong Answer"));
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "artist_password":
			
					$password = trim(@$_REQUEST["password"]);
					if(!empty($password)){
					session_start();
						$q = mysql_query("update artist set password='{$password}' where id='{$_SESSION['artist_password']['id']}'");
								
						if($q){
								unset($_SESSION['artist_password']);
								echo json_encode(array("status"=>"success","message"=>"Password has been reset you will be redirected to the login page"));
						}else{
							echo json_encode(array("status"=>"error","message"=>"Wrong Answer"));
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			
			default:
			
				echo json_encode(array("status"=>"error","message"=>"invalid method"));
			
			break;
		}
?>