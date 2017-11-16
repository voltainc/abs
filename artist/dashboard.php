<?php 
	session_start();
		require_once("../assets/funcs.php");
		$main = new main;
		$main->check_sesh("artist",array("pass"=>NULL,"fail"=>"../artist"));
		$main->connect_db();
		$static = new static_content;
		
?>
<!DOCTYPE html>
<html>
<?php echo $static->head(['inner','default','../']);?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php echo $static->navbar(['inner','default','../']);?>
  <?php echo $static->sidebar(['inner','artist','dashboard','artist']);?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>SALE</h1>
    </section>
    <section class="content">
      
    </section>
  </div>
  <?php echo $static->footer(['inner','default']);?>
  <div class="control-sidebar-bg"></div>
</div>
<?php echo $static->jslib(['inner','default','../'])?>
</body>
</html>
