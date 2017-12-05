<?php 
	session_start();
		require_once("../assets/funcs.php");
		$main = new main;
		$main->check_sesh("admin",array("pass"=>NULL,"fail"=>"../admin"));
		$main->connect_db();
		$static = new static_content;
?>
<!DOCTYPE html>
<html>
<?php echo $static->head(['inner','default','../']);?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php echo $static->navbar(['inner','default','../']);?>
  <?php echo $static->sidebar(['inner','admin','event','admin']);?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Event</h1>
    </section>
    <section class="content">
      <?php $main->retrieve(['event_list'])?>

    </section>
	
  </div>
  <?php echo $static->footer(['inner','default']);?>
  <div class="control-sidebar-bg"></div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Event</h4>
      </div>
      <div class="modal-body">
        <div class="block">
			<span id="notify"></span>
              <div class="box-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="content" placeholder="Enter Event Name">
                </div>
              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="operation">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php echo $static->jslib(['inner','default','../'])?>
</body>
</html>
