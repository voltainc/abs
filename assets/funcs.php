<?php 
	
	class main{
		
		function __construct(){
			date_default_timezone_set('Asia/Dubai');
		}
		
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
										<a href='{$arr[2]}admin' class='logo'>
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
								
								if($arr[2]=="dashboard"){$dashboard="class='active'";}
								else{$dashboard="";}
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
												
										  </ul>
										</section>
									  </aside>
									";
								
							break;
							
							case "admin":
								
								if($arr[2]=="dashboard"){$dashboard="class='active'";}
								else{$dashboard="";}
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