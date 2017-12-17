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
  <?php echo $static->sidebar(['inner','customer','booking','customer']);?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>BOOKING</h1>
    </section>
    <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Search</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Category</label>
                <select class="form-control" id="category" style="width: 100%;">
                 <option value="">Select Category</option>
				 <?php $main->retrieve(['category']);?>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
			<div class="col-md-2">
              <div class="form-group">
                <label>From</label>
                <input type="text" id="from" class="form-control dtpickerwt" />
              </div>
              <!-- /.form-group -->
            </div>
			<div class="col-md-2">
              <div class="form-group">
                <label>To</label>
                <input type="text" id="to" class="form-control dtpickerwt" />
              </div>
              <!-- /.form-group -->
            </div>
			<div class="col-md-2">
              <div class="form-group">
                <label>&nbsp;</label>
                <button class="form-control btn btn-primary" onclick="retrieve(['search_artist'])">Search</button>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      
    </div>
	<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Results</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row" id="result">
            <blockquote>Empty</blockquote>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      
    </div>
	  
    </section>
	
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
	
  </div>
  <?php echo $static->footer(['inner','default']);?>
  <div class="control-sidebar-bg"></div>
</div>
<?php echo $static->jslib(['inner','default',''])?>
</body>
</html>
