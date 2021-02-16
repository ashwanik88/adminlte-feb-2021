<?php require_once('include/startup.php'); ?>
<?php require_once('library/manage_user_lib.php'); ?>
<?php require_once('common/htmlstart.php'); ?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
          <div class="col-sm-12">
		<?php showAlert(); ?>
		</div></div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">

<div class="card">
              <div class="card-header">
                <h3 class="card-title">User Listing</h3>
				<div class="float-right">
					<a class="btn btn-danger btn-sm" href="#">Delete User</a>
					<a class="btn btn-primary btn-sm" href="form_user.php">Add New User</a>
				</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <!-- <th width="10"><input type="checkbox" class="chkAll" onclick="($(this).is(':checked'))?$('.chk').attr('checked', true):$('.chk').attr('checked', false);" /></th>--> 
                    <th width="10"><input type="checkbox" class="chkAll" onclick="$('.chk').attr('checked', $('.chkAll').is(':checked'));" /></th>
                    <th>User Id</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Action</th>
                  </tr>
				  <tr>
					<td></td>
					<td><input type="text" class="form-control" /></td>
					<td><input type="text" class="form-control" /></td>
					<td><input type="text" class="form-control" /></td>
					<td><input type="text" class="form-control" /></td>
					<td><input type="text" class="form-control" /></td>
					<td><input type="button" class="btn btn-sm btn-info" value="Filter" /></td>
				  </tr>
                  </thead>
                  <tbody>
                  <?php if(sizeof($data_users)){ ?>
					<?php foreach($data_users as $data_user){ ?>
						<tr>
							<td><input type="checkbox" class="chk" /></td>
							<td><?php echo $data_user['user_id']; ?></td>
							<td><?php echo $data_user['email']; ?></td>
							<td><?php echo $data_user['firstname']; ?> <?php echo $data_user['lastname']; ?></td>
							<td><?php echo $data_user['status']; ?></td>
							<td><?php echo $data_user['date_added']; ?></td>
							<td>Edit</td>
						</tr>
					<?php } ?>
				  <?php }else{ ?>
					<tr><td colspan="6">No record found!</tr>
				  <?php } ?>
				  </tbody>
                </table>
				
				
              </div>
              <!-- /.card-body -->
			  
			  <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-left">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->     

          </div>
          <!-- /.col -->

        </div>
		
		
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once('common/footer.php'); ?>
<?php require_once('common/scripts.php'); ?>
<?php require_once('common/htmlend.php'); ?>