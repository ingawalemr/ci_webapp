<?php $this->load->view('admin/header'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/Category/index' ?>">Categories</a></li>
              <li class="breadcrumb-item active">Edit category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
              	<div class="card-title">
              		Edit Category  &nbsp;<span style="background: red"> <?php echo $categories['name']; ?></span>
                  <?php //echo $categories['name']; ?>
              	</div>
              </div>
<form name="categoryForm" id="categoryForm" method="post" 
action="<?php echo base_url().'admin/Category/edit/'.$categories['id'] ?>" enctype="multipart/form-data" >
             	<div class="card-body">
					<div class="form-group">
              			<label>Name</label>
   					<input type="text" name="name" id="name" 
   					value="<?php echo set_value('name', $categories['name']); ?>" class="form-control <?php echo (form_error('name') !="") ? 'is-invalid' : ''?>">
              			<?php echo form_error('name'); ?>
              		</div>
              		
              		<div class="form-group">
              			<label>Image</label><br>
              			<input type="file" name="image" id="image" 
              			class="<?php echo (!empty($erroeImageUpload)) ? 'is-invalid' : '' ; ?>" ><br>

              		<?php echo (!empty($erroeImageUpload)) ? $erroeImageUpload : '' ; ?>

              		<?php if ($categories['image'] != "" && file_exists('./public/uploads/category/thumb/'.$categories['image'])) { ?>
              			<img class="mt-3" src="<?php echo base_url().'public/uploads/category/thumb/'.$categories['image'] ?>">
              		<?php }  else {?>
              			<img width="250" src="<?php echo base_url().'public/uploads/category/no_image.jpg'; ?>">
              		<?php } ?>	
            		</div>
              		
              		<div class="custom-control custom-radio float-left">
              		<input  class="custom-control-input" type="radio" value="1" name="status" id="statusActive" <?php echo ($categories['status'] == 1) ? 'checked' : '' ?>>
              		<label for="statusActive" class="custom-control-label">Active</label>
              		</div>

              		<div class="custom-control custom-radio float-left ml-3">
              		<input  class="custom-control-input" type="radio" value="0" name="status" id="statusBlock" <?php echo ($categories['status'] == 0) ? 'checked' : '' ?>>
              		<label for="statusBlock" class="custom-control-label">Block</label>
              		</div>
              	</div>

              	<div class="card-footer">
  					  <button type="submit" name="submit" class="btn btn-primary">Update</button>
  					  <a href="<?php echo base_url().'admin/category/index' ?>" class="btn btn-secondary">Back</a>
              	</div>
  </form>	
           </div>
         </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/footer'); ?>
