<?php 
	
	class main{
		
		function connect_db(){
			
				$host = "localhost";
				$username = "root";
				$password = "";
				$db = "booking";
				
				// $host = "localhost";
				// $username = "ssraktco_hr";				
				// $password = "wiperdex123";				
				// $db = "ssraktco_hr";
			
			
				if(mysql_connect($host,$username,$password)){
					
						if(!mysql_select_db($db)){
							header("location:down");
							exit();
						}
					
				}else{
					header("location:down");
					exit();
				}
			
		}
		
		function saltish($tbl,$length) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			
			$q = mysql_query("select salt from ".$tbl."");
			if(mysql_num_rows($q)>0){
			while($result=mysql_fetch_array($q)){
						while($randomString!=$result['salt']){
						return $randomString;

						}
					}
			}else{
			return $randomString;
			}
		}
		
		function redirect($url){
			
				header("location:{$url}");
				exit();
			
		}
		
		function check_sesh($session,$args){
		
			if(isset($_SESSION[$session])){
				
				$act = "pass";
				
			}else{
				
				$act = "fail";
			
			}
		
		
				switch($act){
				
					
					case "pass":
						
						if(!empty($args['pass'])){
						
						header("location:{$args['pass']}");
						exit();
						
						}
						
					break;
					
					case "fail":
						
						if(!empty($args['fail'])){
						
						header("location:{$args['fail']}");
						exit();
						}
						
					break;
					
					
					default:
						
						header("location:logout");
						exit();
					
					break;
				
				
				
				}
				
		
		}
		
		function retrieve($arg){
			
			
			switch($arg[0]){
				
				case "question":
					
						$q = mysql_query("select * from question order by id DESC");
						if(mysql_num_rows($q)){
							while($result  = mysql_fetch_assoc($q)){
								?>
									
									<option value="<?php echo $result['id']; ?>"><?php echo ucwords($result['content']); ?></option>
									
								<?php
							}
						}
					
				break;
				
				case "category":
					
						$q = mysql_query("select * from category order by id DESC");
						if(mysql_num_rows($q)){
							while($result  = mysql_fetch_assoc($q)){
								?>
									
									<option value="<?php echo $result['id']; ?>"><?php echo ucwords($result['content']); ?></option>
									
								<?php
							}
						}
					
				break;
				
				case "category_list":
					
						$q = mysql_query("select * from category order by id DESC");
						if(mysql_num_rows($q)>0){
							
								?>
								<div class="box">
									<div class="box-header">
									  <h3 class="box-title">Summary</h3>
									  <button class="btn btn-xs btn-success pull-right " data-toggle="modal" data-target="#myModal" onclick=clip_func(['clip_add_category','operation','table_operations','(<?php echo json_encode(['create_category']);?>)'])>Add</button>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<table class="table table-bordered table-striped datatable">
											<thead>
												<tr>
												  <th>#</th>
												  <th>Category</th>
												</tr>
											</thead>
											<tbody>
											<?php
											  $count=1;
											  while($result=mysql_fetch_assoc($q))
											  {
											?>
												<tr>
													<td><?php echo $count++;?></td>
													<td><?php echo ucwords($result['content']);?></td>
												</tr>
											<?php
											  }
											 ?>
											</tbody>
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<?php
							
							
						}else{
							?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-warning"></i> Empty!</h4>
									<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" onclick=clip_func(['clip_add_category','operation','table_operations','(<?php echo json_encode(['create_category']);?>)'])>Create</button>
								</div>
							<?php
						}
						break;
						case "event_list":
					
						$q = mysql_query("select * from event order by id DESC");
						if(mysql_num_rows($q)>0){
							
								?>
								<div class="box">
									<div class="box-header">
									  <h3 class="box-title">Summary</h3>
									  <button class="btn btn-xs btn-success pull-right " data-toggle="modal" data-target="#myModal" onclick=clip_func(['clip_add_event','operation','table_operations','(<?php echo json_encode(['create_event']);?>)'])>Add</button>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<table class="table table-bordered table-striped datatable">
											<thead>
												<tr>
												  <th>#</th>
												  <th>Event</th>
												</tr>
											</thead>
											<tbody>
											<?php
											  $count=1;
											  while($result=mysql_fetch_assoc($q))
											  {
											?>
												<tr>
													<td><?php echo $count++;?></td>
													<td><?php echo ucwords($result['content']);?></td>
												</tr>
											<?php
											  }
											 ?>
											</tbody>
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<?php
							
							
						}else{
							?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-warning"></i> Empty!</h4>
									<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal" onclick=clip_func(['clip_add_event','operation','table_operations','(<?php echo json_encode(['create_event']);?>)'])>Create</button>
								</div>
							<?php
						}
						break;
						
						case "artist_list":
					
						$q = mysql_query("select * from artist order by id DESC");
						if(mysql_num_rows($q)>0){
							
								?>
								<div class="box">
									<div class="box-header">
									  <h3 class="box-title">Summary</h3>
									<!-- /.box-header -->
									<div class="box-body">
										<table class="table table-bordered table-striped datatable">
											<thead>
												<tr>
												  <th>#</th>
												  <th>Artist</th>
												</tr>
											</thead>
											<tbody>
											<?php
											  $count=1;
											  while($result=mysql_fetch_assoc($q))
											  {
											?>
												<tr>
													<td><?php echo $count++;?></td>
													<td><?php echo ucwords($result['name']);?></td>
												</tr>
											<?php
											  }
											 ?>
											</tbody>
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<?php
							
							
						}else{
							?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-warning"></i> Empty!</h4>
								</div>
							<?php
						}
					
				break;
				
				case "recent_booking_customer":
						
						$q = mysql_query("select * from booking where customer = '{$arg[1]} 'order by id DESC");
						if(mysql_num_rows($q)>0){
							
								?>
								<div class="box">
									<div class="box-header">
									  <h3 class="box-title">Recent Bookings</h3>
									<!-- /.box-header -->
									<div class="box-body">
										<table class="table table-bordered table-striped datatable">
											<thead>
												<tr>
												  <th>#</th>
												  <th>Artist</th>
												  <th>From</th>
												  <th>To</th>
												  <th>Status</th>
												  <th>Created</th>
												</tr>
											</thead>
											<tbody>
											<?php
											  $count=1;
											  while($result=mysql_fetch_assoc($q))
											  {
											?>
												<tr>
													<td><?php echo $count++;?></td>
													<td>
														<button class='btn btn-xs btn-primary' data-toggle='modal' data-target='#myModal' onclick=retrieve(['artist_profile','<?php echo $result['artist']; ?>'])><?php echo ucwords($this->ret_by("artist","id",$result['artist'],"name")); ?></button>
													</td>
													<td><?php echo date("d, M Y",strtotime($result['from_date']));?></td>
													<td><?php echo date("d, M Y",strtotime($result['to_date']));?></td>
													<td><?php echo $this->retrieve(['customer_booking_status',$result['status'],$result['id']]);?></td>
													<td><?php echo date("d, M Y",strtotime($result['reg_date']));?></td>
												</tr>
											<?php
											  }
											 ?>
											</tbody>
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<?php
							
							
						}else{
							?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-warning"></i> Empty!</h4>
								</div>
							<?php
						}
					
				break;
				
				case "recent_booking_artist":
						
						$q = mysql_query("select * from booking where artist = '{$arg[1]}' and status=0 order by id DESC");
						if(mysql_num_rows($q)>0){
							
								?>
								<div class="box">
									<div class="box-header">
									  <h3 class="box-title">Recent Bookings</h3>
									<!-- /.box-header -->
									<div class="box-body">
										<table class="table table-bordered table-striped datatable">
											<thead>
												<tr>
												  <th>#</th>
												  <th>Customer</th>
												  <th>From</th>
												  <th>To</th>
												  <th>Created</th>
												  <th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php
											  $count=1;
											  while($result=mysql_fetch_assoc($q))
											  {
											?>
												<tr>
													<td><?php echo $count++;?></td>
													<td><?php echo ucwords($this->ret_by("customer","id",$result['customer'],"name"));?></td>
													<td><?php echo date("d, M Y",strtotime($result['from_date']));?></td>
													<td><?php echo date("d, M Y",strtotime($result['to_date']));?></td>
													<td><?php echo date("d, M Y",strtotime($result['reg_date']));?></td>
													<td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#approve_booking" onclick=clip_func(['clip_add_fee','operation','table_operations','(<?php echo json_encode(['create_fee',$result['id']]);?>)'])>Approve</button>&nbsp;<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#reject_booking" onclick=clip_func(['clip_reject_booking','operation_2','table_operations','(<?php echo json_encode(['reject_booking',$result['id']]);?>)'])>Reject</button></td>
												</tr>
											<?php
											  }
											 ?>
											</tbody>
										</table>
									</div>
									<!-- /.box-body -->
								</div>
								<?php
							
							
						}else{
							?>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-warning"></i> Empty!</h4>
								</div>
							<?php
						}
					
				break;
				
				case "customer_booking_status":
						
						switch($arg[1]){
							
							case "0":
								return "<label class='label label-warning'>Waiting</label>";
							break;
							
							case "1":
								return "<a href='javascript:void(0)'class='label label-success' data-toggle='modal' data-target='#invoice' onclick=retrieve(['invoice',{$arg[2]}])>Accepted</a>";
							break;
							
							case "2":
								return "<label class='label label-danger'>Rejected</label>";
							break;
							
							
						}
					
				break;
				
				
				case "reset_question_customer":
						
						$q = mysql_query("select * from reset where type='customer' and user='{$arg[1]}'");
						if(mysql_num_rows($q)){
							$result = mysql_fetch_assoc($q);
								?>
									<input type="text" class="form-control" placeholder="Secret Question" value="<?php echo $this->ret_by("question","id",$result['question'],"content"); ?>" disabled />
								<?php
						}else{
							?>
								 <input type="text" id="question" class="form-control" placeholder="Secret Question" value="" disabled />
							<?php
						}
					
				break;
				
				case "reset_question_artist":
						
						$q = mysql_query("select * from reset where type='artist' and user='{$arg[1]}'");
						if(mysql_num_rows($q)){
							$result = mysql_fetch_assoc($q);
								?>
									<input type="text" class="form-control" placeholder="Secret Question" value="<?php echo $this->ret_by("question","id",$result['question'],"content"); ?>" disabled />
								<?php
						}else{
							?>
								 <input type="text" id="question" class="form-control" placeholder="Secret Question" value="" disabled />
							<?php
						}
					
				break;
				
				case "artist_search_list":
					$q = mysql_query("SELECT * FROM booking where '{$arg[1]}' BETWEEN from_date and to_date OR '{$arg[2]}' BETWEEN from_date and to_date");
					
								if(!mysql_num_rows($q)){
									return true;
								}
					
				break;
				
				
			}
			
			
			
		}
		function ret_by($tbl,$entity,$attr,$return){
			
			$q = mysql_query("select * from ".$tbl." where ".$entity."='".$attr."'");
				if(mysql_num_rows($q)){ 
					$result = mysql_fetch_assoc($q);
					return $result[$return];
				}
		}
		
		function upload($name,$file,$path){
			
			$errors = array(
				0 => 'There is no error, the file uploaded with success',
				1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
				2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
				3 => 'The uploaded file was only partially uploaded',
				4 => 'No file was uploaded',
				6 => 'Missing a temporary folder',
				7 => 'Failed to write file to disk.',
				8 => 'A PHP extension stopped the file upload.',
			);
			
			if(empty($file['error'])){
				
					 $allowed = array("jpg","jpeg","png");
					 $max_size = 2097152;
					 $ext = explode(".",$file['name']);
					 
					 if(in_array(strtolower(end($ext)),$allowed)){
						 if($file['size']<=$max_size){
							if(!file_exists($path)) {
								mkdir($path, 0777, true);
							}
							move_uploaded_file($file['tmp_name'],$path."/".$name.".jpg");
							if(file_exists($path."/".$name.".jpg")) {
								return array("status"=>"success");
							} else {
								return array("status"=>"error","message"=>"File upload failed");
							}
							 
						 }else{
							 return array("status"=>"error","message"=>"File size must not exceed 2mb");
						 }
						 
					 }else{
						 return array("status"=>"error","message"=>"Invalid file type");
					 }
			 
				
			}else{
				return array("status"=>"error","message"=>$errors[$file['error']]);
			}
			
		}
	}
	class static_content{
		
		function head($arr){
			
			switch($arr[0]){
				
					case "inner":
					
						
						switch($arr[1]){
							
							case "default":
								
								return
									"
										<head>
										  <meta charset='utf-8'>
										  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
										  <title>Artist Booking System</title>
										  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
										  <link rel='stylesheet' href='{$arr[2]}font-awesome/css/font-awesome.min.css'>
										  <link rel='stylesheet' href='{$arr[2]}bootstrap/css/bootstrap.min.css'>
										  <link rel='stylesheet' href='{$arr[2]}dist/css/AdminLTE.min.css'>
										  <link rel='stylesheet' href='{$arr[2]}dist/css/skins/_all-skins.min.css'>
										  <link rel='stylesheet' href='{$arr[2]}plugins/datatables/dataTables.bootstrap.css'>
										  <link rel='stylesheet' href='{$arr[2]}plugins/datepicker/datepicker3.css'>
										  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
										  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
										  <!--[if lt IE 9]>
										  <script src='{$arr[2]}ie9/js/html5shiv.min.js'></script>
										  <script src='{$arr[2]}ie9/js/respond.min.js'></script>
										  <![endif]-->
										</head>
									";
								
							break;
							
						}
						
					
					
					break;
				
			}
			
			
		}
		
		function jslib($arr){
			
			switch($arr[0]){
				
					case "inner":
					
						
						switch($arr[1]){
							
							case "default":
								
									return
									"
									<script src='{$arr[2]}plugins/jQuery/jquery-2.2.3.min.js'></script>
									<script src='{$arr[2]}bootstrap/js/bootstrap.min.js'></script>
									<script src='{$arr[2]}plugins/slimScroll/jquery.slimscroll.min.js'></script>
									<script src='{$arr[2]}plugins/fastclick/fastclick.js'></script>
									<script src='{$arr[2]}dist/js/app.min.js'></script>
									<script src='{$arr[2]}dist/js/demo.js'></script>
									<script src='{$arr[2]}plugins/datatables/jquery.dataTables.min.js'></script>
									<script src='{$arr[2]}plugins/datatables/dataTables.bootstrap.min.js'></script>
									<script src='{$arr[2]}plugins/datepicker/bootstrap-datepicker.js'></script>
									<script src='{$arr[2]}dist/js/handler.js'></script>
									
									";
								
							break;
							
						}
						
					break;
				
			}
			
			
		}
		
		function navbar($arr){
			
			switch($arr[0]){
				
					case "inner":
					
						
						switch($arr[1]){
							
							case "default":
								
									return
									"
									 <header class='main-header'>
										<a href='javascript:void(0)' class='logo'>
										  <span class='logo-mini'><b>ABS</b></span>
										  <span class='logo-lg'><b>A B S</b></span>
										</a>
										<nav class='navbar navbar-static-top'>
										  <a href='javascript:void(0)' class='sidebar-toggle' data-toggle='offcanvas' role='button'>
											<span class='sr-only'>Toggle navigation</span>
											<span class='icon-bar'></span>
											<span class='icon-bar'></span>
											<span class='icon-bar'></span>
										  </a>
										  <div class='navbar-custom-menu'>
											<ul class='nav navbar-nav'>
											  <li>
												<a href='logout'><i class='fa fa-power-off'></i></a>
											  </li>
											</ul>
										  </div>
										</nav>
									  </header>
									
									";
								
							break;
							
							
						}
						
					break;
				
			}
			
			
		}
		
		function sidebar($arr){
			
			switch($arr[0]){
				
					case "inner":
					
						
						switch($arr[1]){
							
							case "customer":
								
								if($arr[2]=="dashboard"){$dashboard="class='active'";$booking="";}
								elseif($arr[2]=="booking"){$dashboard="";$booking="class='active'";}
								else{$dashboard="";$booking="";}
									return
									"
									 <aside class='main-sidebar'>
										<section class='sidebar'>
										  <div class='user-panel'>
											<div class='pull-left image'>
											  <img src='dist/img/admin_avatar.jpg' class='img-circle' alt='User Image'>
											</div>
											<div class='pull-left info'>
											  <p>".ucwords($_SESSION[$arr[3]]['name'])."</p>
											  <a href='javascript:void(0)'><i class='fa fa-circle text-success'></i> Online</a>
											</div>
										  </div>
										  <ul class='sidebar-menu'>
											<li class='header'>MAIN NAVIGATION</li>
												<li {$dashboard}>
													<a href='dashboard'>
														<i class='fa fa-dashboard'></i> <span>Dashboard</span>
													</a>
												</li>
												<li {$booking}>
													<a href='booking'>
														<i class='fa fa-cog'></i> <span>Booking</span>
													</a>
												</li>
										  </ul>
										</section>
									  </aside>
									";
								
							break;
							
							case "artist":
								
								if($arr[2]=="dashboard"){$dashboard="class='active'";}
								else{$dashboard="";}
									return
									"
									 <aside class='main-sidebar'>
										<section class='sidebar'>
										  <div class='user-panel'>
											<div class='pull-left image'>
											  <img src='assets/{$_SESSION[$arr[3]]['id']}/pfp/{$_SESSION[$arr[3]]['id']}.jpg' class='img-circle' alt='User Image'>
											</div>
											<div class='pull-left info'>
											  <p>".ucwords($_SESSION[$arr[3]]['name'])."</p>
											  <a href='javascript:void(0)'><i class='fa fa-circle text-success'></i> Online</a>
											</div>
										  </div>
										  <ul class='sidebar-menu'>
											<li class='header'>MAIN NAVIGATION</li>
												<li {$dashboard}>
													<a href='dashboard'>
														<i class='fa fa-dashboard'></i> <span>Dashboard</span>
													</a>
												</li>
												
										  </ul>
										</section>
									  </aside>
									";
								
							break;
							
							case "admin":
								
								if($arr[2]=="dashboard"){$dashboard="class='active'";$category="";$artist="";$event="";}
								elseif($arr[2]=="category"){$dashboard="";$category="class='active'";$artist="";$event="";}
								elseif($arr[2]=="artist"){$dashboard="";$category="";$artist="class='active'";$event="";}
								elseif($arr[2]=="event"){$dashboard="";$category="";$artist="";$event="class='active'";}
								else{$dashboard="";$category="";$artist="";$event="";}
									return
									"
									 <aside class='main-sidebar'>
										<section class='sidebar'>
										  <div class='user-panel'>
											<div class='pull-left image'>
											  <img src='../dist/img/admin_avatar.jpg' class='img-circle' alt='User Image'>
											</div>
											<div class='pull-left info'>
											  <p>".ucwords($_SESSION[$arr[3]]['name'])."</p>
											  <a href='javascript:void(0)'><i class='fa fa-circle text-success'></i> Online</a>
											</div>
										  </div>
										  <ul class='sidebar-menu'>
											<li class='header'>MAIN NAVIGATION</li>
												<li {$dashboard}>
													<a href='dashboard'>
														<i class='fa fa-dashboard'></i> <span>Dashboard</span>
													</a>
												</li>
												<li {$category}>
													<a href='category'>
														<i class='fa fa-cog'></i> <span>Category</span>
													</a>
												</li>
												<li {$event}>
													<a href='event'>
														<i class='fa fa-cog'></i> <span>Event</span>
													</a>
												</li>
												<li {$artist}>
													<a href='artist'>
														<i class='fa fa-cog'></i> <span>Artist</span>
													</a>
												</li>
										  </ul>
										</section>
									  </aside>
									";
								
							break;
							
							
						}
						
					break;
				
			}
			
			
		}
		
		function footer($arr){
			
			switch($arr[0]){
				
					case "inner":
					
						
						switch($arr[1]){
							
							case "default":
								
									return
									"
									<footer class='main-footer'>
										<div class='pull-right hidden-xs'>
										  <b>Version</b> 1.0.0
										</div>
										<strong>Copyright &copy; ".date("Y")." <a href='javascript:void(0)'>Najwa</a>.</strong> All rights
										reserved.
									</footer>
									";
								
							break;
							
						}
						
					break;
				
			}
			
			
		}
		
		
	}

?>