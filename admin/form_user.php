<?php require_once('include/startup.php'); ?>
<?php require_once('library/form_user_lib.php'); ?>
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
            <h1 class="m-0 text-dark"><?php echo $document_title; ?></h1>
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
                <h3 class="card-title">User Form</h3>
				<div class="float-right">
					<a class="btn btn-default btn-sm" href="manage_users.php">Back</a>
				</div>
              </div>
              <!-- /.card-header -->
              <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?php echo $cpassword; ?>">
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $phone; ?>">
                    </div>
                  </div>
				  <div class="form-group row">
                    <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">
					  <img src="<?php echo HTTP_UPLOADS. $filename; ?>" width="100px" />
                      <input type="file" class="form-control" id="photo" name="photo" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="rActive" name="status" value="1" <?php echo ($status == 1)?'checked="checked"':'';?>>
                          <label for="rActive" class="custom-control-label">Active</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="rInactive" name="status" value="0" <?php echo ($status == 0)?'checked="checked"':'';?>>
                          <label for="rInactive" class="custom-control-label">Inactive</label>
                        </div>
                      </div>
                    </div>
                  </div>
				  <div class="form-group row">
				  <div class="offset-sm-2 col-sm-10">
						<button type="submit" class="btn btn-info">Submit</button>
						<button type="reset" class="btn btn-default">Reset</button>
				  </div>
				  </div>
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer -->
              </form>
              <!-- /.card-body -->
			  
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