<?php 
	session_start();
		require_once("assets/funcs.php");
		$main = new main;
		$main->check_sesh("customer",array("pass"=>NULL,"fail"=>"../prj"));
		$main->connect_db();
		$static = new static_content;
?>
<!DOCTYPE html>
<html>
<?php echo $static->head(['inner','default','']);?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php echo $static->navbar(['inner','default','../']);?>
  <?php echo $static->sidebar(['inner','customer','dashboard','customer']);?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Dashboard</h1>
    </section>
    <section class="content">
                
				<?php echo $main->retrieve(['recent_booking_customer',$_SESSION['customer']['id']]);?>
       
    </section>
  </div>
  <?php echo $static->footer(['inner','default']);?>
  <div class="control-sidebar-bg"></div>
</div>
<div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice</h4>
      </div>
      <div class="modal-body">
        <div class="block">
			<span id="notify"></span>
              <div class="box-body" id="booking_invoice">
                
              </div>
        </div>
      </div>
     
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Profile</h4>
      </div>
      <div class="modal-body">
        <div class="block">
		<span id="notify"></span>
              <div class="box-body" id="artist_profile"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="delete_booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <div class="block">
		<span id="notify_2"></span>
              <blockquote class="bg-red">Are you sure you want to delete this booking?</blockquote>
        </div>
      </div>
	   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="operation">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php echo $static->jslib(['inner','default',''])?>
</body>
</html>
