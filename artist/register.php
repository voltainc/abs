<?php 
	session_start();
		require_once("../assets/funcs.php");
		$main = new main;
		$main->check_sesh("artist",array("pass"=>"dashboard","fail"=>NULL));
		$main->connect_db();
		$static = new static_content;
?>
<!DOCTYPE html>
<html>
<?php echo $static->head(['inner','default','../'])?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Artist Booking | </b>System
  </div>
  <div class="login-box-body">
    <span class="block" id="notify"></span>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="name" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" id="age" placeholder="Age">
        <span class="glyphicon glyphicon-heart-empty form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <select class="form-control" id="status" placeholder="Status">
			<option value="married">Married</option>
			<option value="single">Single</option>
		</select>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" id="skill" placeholder="Skill">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" id="origin" placeholder="Origin">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
	   <div class="form-group has-feedback">
        <select class="form-control" id="category" placeholder="Secret Question">
			<option value="" disabled>Category</option>
			<?php echo $main->retrieve(['category']);?>
		</select>
      </div>
	  <div class="form-group has-feedback">
        <select class="form-control" id="question" placeholder="Secret Question">
			<option value="" disabled>Secret Question</option>
			<?php echo $main->retrieve(['question']);?>
		</select>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" id="answer" placeholder="Answer">
		
        <span class="glyphicon glyphicon-key form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="file" class="form-control" id="pfp" placeholder="Profile Picture">
		<span class="help-block pull-left"><a href="../artist">Login</a></span><span class="help-block pull-right"><a href="reset">Reset Password</a></span>
      </div>
       <div class="block">
          <button class="btn btn-primary btn-block btn-flat" onclick=register(["artist"])>Sign In</button>
      </div>
  </div>
</div>
<?php echo $static->jslib(['inner','default','../'])?>
</body>
</html>
