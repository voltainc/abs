<?php 
		session_start();
		require_once("assets/funcs.php");
		$main = new main;
		$main->check_sesh("customer_question",array("pass"=>NULL,"fail"=>"reset"));
		$main->connect_db();
		$static = new static_content;
		$_SESSION['customer_password'] = $_SESSION['customer_question'];
		unset($_SESSION['customer_question']);
		
?>
<!DOCTYPE html>
<html>
<?php echo $static->head(['inner','default',''])?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Artist Booking | </b>System
  </div>
  <div class="login-box-body">
    <span class="block" id="notify"></span>
	  <div class="form-group has-feedback">
        <input type="text" id="password" class="form-control" placeholder="New Password">
		<span class="help-block pull-left"><a href="../prj">Login</a></span><span class="help-block pull-right"><a href="register">Register</a></span>
      </div>
	   <div class="block">
          <button class="btn btn-primary btn-block btn-flat" onclick=reset(["customer_password"])>Continue</button>
      </div>
  </div>
</div>
<?php echo $static->jslib(['inner','default',''])?>
</body>
</html>
