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
								
								if(mysql_query("insert into artist values ('','{$name}','{$age}','{$status}','{$skill}','{$origin}','{$category}','{$email}','{$password}','{$salt}',true,(current_timestamp))")){
									
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
			
			case "create_category":
				
				$content = trim(@$_REQUEST['content']);
				if(!empty($content)){
						$q = mysql_query("select * from category where content='{$content}'");
						if(mysql_num_rows($q)){
							echo json_encode(array("status"=>"error","message"=>"already exists"));
						}else
						{
							if(mysql_query("insert into category values('','{$content}')")){
								echo json_encode(array("status"=>"success"));
							}else{
								echo json_encode(array("status"=>"error","message"=>"error while creating category"));
							}
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"all fields required"));
				}
				
			break;
			
			case "create_event":
				
				$content = trim(@$_REQUEST['content']);
				if(!empty($content)){
						$q = mysql_query("select * from event where content='{$content}'");
						if(mysql_num_rows($q)){
							echo json_encode(array("status"=>"error","message"=>"already exists"));
						}else
						{
							if(mysql_query("insert into event values('','{$content}')")){
								echo json_encode(array("status"=>"success"));
							}else{
								echo json_encode(array("status"=>"error","message"=>"error while creating event"));
							}
						}
					
				}else{
					echo json_encode(array("status"=>"error","message"=>"all fields required"));
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
			
			
			case "search_artist":
			
					$category = trim(@$_REQUEST["category"]);
					$from = trim(@$_REQUEST["from"]);
					$to = trim(@$_REQUEST["to"]);
					
					// print_r($_REQUEST);
					// exit();
					
					if(!empty($category) AND !empty($from) AND !empty($to)){
						
						$q = mysql_query("select * from artist where category='{$category}' and status=true");
						
						if(mysql_num_rows($q)){
							
							$from_date = date("Y-m-d",strtotime($from));
							$to_date = date("Y-m-d",strtotime($to));
							while($result = mysql_fetch_assoc($q)){
								$arr="";
								if($main->retrieve(['artist_search_list',$from_date,$to_date])){
									$arr.= 
													"
														<div class='col-md-4'>
														  <!-- Widget: user widget style 1 -->
														  <div class='box box-widget widget-user-2'>
															<!-- Add the bg color to the header using any of the bg-* classes -->
															<div class='widget-user-header bg-black'>
															  <div class='widget-user-image'>
																<img class='img-circle' src='artist/assets/{$result['id']}/pfp/{$result['id']}.jpg' alt='User Avatar'>
															  </div>
															  <!-- /.widget-user-image -->
															  <h3 class='widget-user-username'>".ucwords($result['name'])."</h3>
															  <h5 class='widget-user-desc'><button class='btn btn-xs btn-primary' data-toggle='modal' data-target='#myModal' onclick=retrieve(['artist_profile','".$result['id']."'])>Request booking</button></h5>
															</div>
														   
														  </div>
														  <!-- /.widget-user -->
														</div>
													";
								}
								
							}
							if($arr!=""){
								echo json_encode(array("status"=>"success","message"=>$arr));
							}else{
								echo json_encode(array("status"=>"success","message"=>"<blockquote>No data found</blockquote>"));
							}

						}else{
							echo json_encode(array("status"=>"error","message"=>"No data found"));
						}
						
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "artist_profile":
			
					$artist = trim(@$_REQUEST["artist"]);
					if(!empty($artist)){
					
						$q = mysql_query("select * from artist where id='{$artist}'");
								
						if(mysql_num_rows($q)){
								$result = mysql_fetch_assoc($q);
								?>
								
									
									<div class="box box-primary">
										<div class="box-body box-profile">
										  <img class="profile-user-img img-responsive img-circle" src='artist/assets/<?php echo $result['id']; ?>/pfp/<?php echo $result['id']; ?>.jpg' alt="User profile picture">

										  <h3 class="profile-username text-center"><?php echo ucwords($result['name'])?></h3>

										  <p class="text-muted text-center"><?php echo $main->ret_by("category","id",$result['category'],"content") ?></p>

										  <ul class="list-group list-group-unbordered">
											<li class="list-group-item">
											  <b>Age</b> <a class="pull-right"><?php echo $result['age']?></a>
											</li>
											<li class="list-group-item">
											  <b>Marital Status</b> <a class="pull-right"><?php echo ucwords($result['marital_status']);?></a>
											</li>
											<li class="list-group-item">
											  <b>Skill</b> <a class="pull-right"><?php echo ucwords($result['skill'])?></a>
											</li>
											<li class="list-group-item">
											  <b>Origin</b> <a class="pull-right"><?php echo ucwords($result['origin']);?></a>
											</li>
											<li class="list-group-item">
											  <b>Email</b> <a class="pull-right"><?php echo $result['email']?></a>
											</li>
										  </ul>
										  <button class="btn btn-success btn-block" onclick=retrieve(['create_booking',<?php echo $result['id']; ?>]) data-dismiss="modal"><b>Book</b></button>
										</div>
										<!-- /.box-body -->
									</div>
																
								
								<?php								
								
						}
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "create_booking":
			
					$artist = trim(@$_REQUEST["artist"]);
					$category = trim(@$_REQUEST["category"]);
					$from = trim(@$_REQUEST["from"]);
					$to = trim(@$_REQUEST["to"]);
					if(!empty($artist) AND !empty($category) AND !empty($from) AND !empty($to)){
						session_start();
						$from_date = date("Y-m-d H:i:S",strtotime($from));
						$to_date = date("Y-m-d H:i:s",strtotime($to));
						$salt = $main->saltish('booking',15);
						$q = mysql_query("insert into booking values('','{$_SESSION['customer']['id']}','{$artist}','{$category}','{$from_date}','{$to_date}',0,'{$salt}',(current_timestamp))");
						if($q){
							echo json_encode(array("status"=>"success","message"=>""));
						}else{
							echo json_encode(array("status"=>"error","message"=>"An error occured while processing"));
						}
						
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "create_fee":
			
					$booking = trim(@$_REQUEST["booking"]);
					$content = trim(@$_REQUEST["content"]);
					
					if(!empty($booking) AND !empty($content)){
						
						$q = mysql_query("insert into fee values('','{$booking}','{$content}',(current_timestamp))");
						if($q){
							mysql_query("update booking set status=1 where id='{$booking}'");
							echo json_encode(array("status"=>"success","message"=>""));
						}else{
							echo json_encode(array("status"=>"error","message"=>"An error occured"));
						}
						
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "reject_booking":
			
					$booking = trim(@$_REQUEST["booking"]);
					
					if(!empty($booking)){
						
						$q = mysql_query("update booking set status=2 where id='{$booking}'");
						if($q){
							echo json_encode(array("status"=>"success","message"=>""));
						}else{
							echo json_encode(array("status"=>"error","message"=>"An error occured"));
						}
						
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "delete_booking":
			
					$booking = trim(@$_REQUEST["booking"]);
					
					if(!empty($booking)){
						
						
						if(mysql_query("delete from booking where id='{$booking}'")){
							if(mysql_query("delete from fee where booking='{$booking}'")){
								echo json_encode(array("status"=>"success","message"=>""));
							}else{
								echo json_encode(array("status"=>"error","message"=>"An error occured"));
							}
							
						}else{
							echo json_encode(array("status"=>"error","message"=>"An error occured"));
						}
						
					}else{
						echo json_encode(array("status"=>"error","message"=>"All fields required"));
					}
			break;
			
			case "invoice":
			
					$booking = trim(@$_REQUEST["booking"]);
					
					
					if(!empty($booking)){
						
						$q = mysql_query("select * from booking where id='{$booking}'");
						if(mysql_num_rows($q)){
							$result = mysql_fetch_assoc($q);
							?>
								
								
									  <table class="table table-responsive table-striped">
										
										<tr>
										<th>Artist</th>
										  <td><?php echo ucwords($main->ret_by("artist","id",$result['artist'],"name"));?></td>
										</tr>
										<tr> 
										<th>From</th>
										  <td><?php echo date("d, M Y",strtotime($result['from_date']));?></td>
										</tr>
										<tr> 
										<th>To</th>
										  <td><?php echo date("d, M Y",strtotime($result['to_date']));?></td>
										</tr>
										<tr>
										<th>Fee</th>
										  <td><?php echo ucwords($main->ret_by("fee","id",$result['id'],"content"));?></td>
										</tr>
										<tr> 
										<th>Created</th>
										  <td><?php echo date("d, M Y",strtotime($result['reg_date']));?></td>
										</tr>
										
									  </table>
								
							
							
							<?php
						}else{
							echo json_encode(array("status"=>"error","message"=>"An error occured"));
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