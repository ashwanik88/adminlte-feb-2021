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
				<form action="" method="POST">
              <div class="card-header">
                <h3 class="card-title">User Listing</h3>
				<div class="float-right">
					<input type="submit" onclick="return confirm('Are you sure want to delete!');" class="btn btn-danger btn-sm" value="Delete User" />
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
                    <th><a href="manage_users.php?<?php echo $pagination_url; ?>&sort_by=user_id&sort_order=<?php echo $sort_swap; ?>">User Id</a></th>
                    <th>Photo</th>
					<th><a href="manage_users.php?<?php echo $pagination_url; ?>&sort_by=email&sort_order=<?php echo $sort_swap; ?>">Email</a></th>
					<th><a href="manage_users.php?<?php echo $pagination_url; ?>&sort_by=firstname&sort_order=<?php echo $sort_swap; ?>">Name</a></th>
					<th><a href="manage_users.php?<?php echo $pagination_url; ?>&sort_by=status&sort_order=<?php echo $sort_swap; ?>">Status</a></th>
					<th><a href="manage_users.php?<?php echo $pagination_url; ?>&sort_by=date_added&sort_order=<?php echo $sort_swap; ?>">Date Added</a></th>
                    <th width="140px">Action</th>
                  </tr>
				  <tr>
					<td></td>
					<td><input type="text" class="form-control" /></td>
					<td></td>
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
							<td><input type="checkbox" class="chk" value="<?php echo $data_user['user_id']; ?>" name="user_ids[]" /></td>
							<td><?php echo $data_user['user_id']; ?></td>
							<td>
								<?php if(!empty($data_user['photo'])){ ?>
								<img src="<?php echo HTTP_UPLOADS. $data_user['photo']; ?>" width="100" />
								<?php }else{ ?>
								<img src="<?php echo HTTP_UPLOADS; ?>/avatar.png" width="100" />
								<?php } ?>
								
								</td>
							<td><?php echo $data_user['email']; ?></td>
							<td><?php echo $data_user['firstname']; ?> <?php echo $data_user['lastname']; ?></td>
							<td><?php echo $data_user['status']; ?></td>
							<td><?php echo $data_user['date_added']; ?></td>
							<td><a onclick="return confirm('Are you sure want to delete this?');" href="manage_users.php?user_id=<?php echo $data_user['user_id']; ?>">Delete</a> | <a href="form_user.php?user_id=<?php echo $data_user['user_id']; ?>">Edit</a></td>
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
				  <?php for($i = 1; $i <= ceil($total_users/$page_limit); $i++){ ?>
                  <li class="page-item"><a class="page-link" href="manage_users.php?page=<?php echo $i . $sort_url; ?>"><?php echo $i; ?></a></li>
				  <?php } ?>
                  
                </ul>
              </div>
			  </form>
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