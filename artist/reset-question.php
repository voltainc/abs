<?php 
		session_start();
		require_once("../assets/funcs.php");
		$main = new main;
		$main->check_sesh("artist_verify",array("pass"=>NULL,"fail"=>"reset"));
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
       <?php $main->retrieve(['reset_question_artist',$_SESSION['artist_verify']['id']]);?>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" id="answer" class="form-control" placeholder="Answer">
		<span class="help-block pull-left"><a href="../prj">Login</a></span><span class="help-block pull-right"><a href="register">Register</a></span>
      </div>
	   <div class="block">
          <button class="btn btn-primary btn-block btn-flat" onclick=reset(["artist_question"])>Continue</button>
      </div>
  </div>
</div>
<?php echo $static->jslib(['inner','default','../'])?>
</body>
</html>
