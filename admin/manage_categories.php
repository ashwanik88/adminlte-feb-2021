<?php require_once('include/startup.php'); ?>
<?php require_once('library/manage_categories_lib.php'); ?>
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
            <h1 class="m-0 text-dark">Manage Categories</h1>
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
                <h3 class="card-title">Category Listing</h3>
				<div class="float-right">
					<input type="submit" onclick="return confirm('Are you sure want to delete!');" class="btn btn-danger btn-sm" value="Delete" />
					<a class="btn btn-primary btn-sm" href="form_category.php">Add New</a>
				</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th width="10"><input type="checkbox" class="chkAll" onclick="$('.chk').attr('checked', $('.chkAll').is(':checked'));" /></th>
                    <th>User Id</th>
					<th>Name</th>
                    <th>Parent Id</th>
                    <th width="140px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(sizeof($data_categories)){ ?>
					<?php foreach($data_categories as $data_category){ ?>
						<tr class="bg-success">
							<td><input type="checkbox" class="chk" value="<?php echo $data_category['category_id']; ?>" name="category_ids[]" /></td>
							<td><?php echo $data_category['category_id']; ?></td>
							
							<td><?php echo $data_category['category_name']; ?></td>
							<td><?php echo $data_category['parent_id']; ?></td>
							<td><a onclick="return confirm('Are you sure want to delete this?');" href="manage_categories.php?category_id=<?php echo $data_category['category_id']; ?>">Delete</a> | <a href="form_category.php?category_id=<?php echo $data_category['category_id']; ?>">Edit</a></td>
						</tr>
						
						<?php $children = getChildren($data_category['category_id']); 
							  if(sizeof($children)){
								  foreach($children as $child){
									  ?>
						<tr class="bg-warning">
							<td><input type="checkbox" class="chk" value="<?php echo $child['category_id']; ?>" name="category_ids[]" /></td>
							<td><?php echo $child['category_id']; ?></td>
							
							<td><?php echo $data_category['category_name']; ?> &raquo; <?php echo $child['category_name']; ?></td>
							<td><?php echo $child['parent_id']; ?></td>
							<td><a onclick="return confirm('Are you sure want to delete this?');" href="manage_categories.php?category_id=<?php echo $child['category_id']; ?>">Delete</a> | <a href="form_category.php?category_id=<?php echo $child['category_id']; ?>">Edit</a></td>
						</tr>		

<?php $sub_children = getChildren($child['category_id']); 
							  if(sizeof($sub_children)){
								  foreach($sub_children as $sub_child){
									  ?>
						<tr>
							<td><input type="checkbox" class="chk" value="<?php echo $sub_child['category_id']; ?>" name="category_ids[]" /></td>
							<td><?php echo $sub_child['category_id']; ?></td>
							
							<td><?php echo $data_category['category_name']; ?> &raquo; <?php echo $child['category_name']; ?> &raquo; <?php echo $sub_child['category_name']; ?></td>
							<td><?php echo $sub_child['parent_id']; ?></td>
							<td><a onclick="return confirm('Are you sure want to delete this?');" href="manage_categories.php?category_id=<?php echo $sub_child['category_id']; ?>">Delete</a> | <a href="form_category.php?category_id=<?php echo $sub_child['category_id']; ?>">Edit</a></td>
						</tr>			  
									  <?php
								  }
							  }
						
						
						?>						
									  <?php
								  }
							  }
						
						
						?>
						
						
					<?php } ?>
				  <?php }else{ ?>
					<tr><td colspan="5">No record found!</tr>
				  <?php } ?>
				  </tbody>
                </table>
				
				
              </div>
              <!-- /.card-body -->
			  
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