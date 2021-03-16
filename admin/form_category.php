<?php require_once('include/startup.php'); ?>
<?php require_once('library/form_category_lib.php'); ?>
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
                <h3 class="card-title">Category Form</h3>
				<div class="float-right">
					<a class="btn btn-default btn-sm" href="manage_categories.php">Back</a>
				</div>
              </div>
              <!-- /.card-header -->
              <form class="form-horizontal" method="POST" action="">
                <div class="card-body">
				
                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Select Parent</label>
                    <div class="col-sm-10">
                      <select name="parent_id" id="parent_id" class="form-control">
						<option value="0">Top Parent</option>
						<?php showCategories(0); ?>
						
					  </select>
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="<?php echo $category_name; ?>">
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