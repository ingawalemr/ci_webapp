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
              <li class="breadcrumb-item active">Categories</li>
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
          	<?php 
          	if ($this->session->flashdata('success') !="") { ?>
          		<div class="alert alert-success">
          			<?php echo $this->session->flashdata('success'); ?>
          		</div>
         		<?php 	}   ?>

            <?php
            $error =  $this->session->flashdata('error');
              if($error !="")
                { ?> 
              <div class="alert alert-danger"><?php echo $error; ?></div>  
            <?php } ?>
            <div class="card">
              <div class="card-header">
              	<div class="card-title">
                  <form id="searchFrm" name="searchFrm" method="get" action="">
                    <div class="input-group mb-0">
                        <input type="text" name="q" value="<?php echo $queryString; ?>" 
                        class="form-control" placeholder="search">
                          <div class="input-group-append">
                              <button class="input-group-text" id="basic-addonl"> <i class="fas fa-search"></i>
                              </button>
                         </div>
                    </div>
                  </form>
                </div>
              		<div class="card-tools">
              			<a href="<?php echo base_url().'admin/Category/create' ?>" 
              				class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
              		</div>
              </div>
              		<div class="card-body">
              			<table class="table">
              				<tr>
              					<th width="50">#</th>
              					<th>Name</th>
              					<th width="100">Staus</th>
              					<th width="160"  class="text-center">Action</th>
              				</tr>
              			
              			<?php if (!empty($categories)) { ?>
              				<?php foreach ($categories as $value) { // 'categories' is a table name?> 
              				<tr>
              					<td><?php echo $value['id']; ?></td>
              					<td><?php echo $value['name']; ?></td>
              					<td>
              					<?php if ($value['status'] == 1) { ?>
              					<span class="badge badge-success">Active</span>
              					<?php } else { ?>
              					<span class="badge badge-danger">Block</span>
              					<?php } ?>
              					</td>
              					<td class="text-center">
              						<a href="<?php echo base_url().'admin/Category/edit/'.$value['id']; ?>"
                          class="btn btn-success btn-sm">
              							<i class="fa fa-plus"></i> Edit
              						</a>
              						<a href="javascript:void(0);" onclick="deleteCategory(<?php echo $value['id'] ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete
              						</a>
              					</td>
              				</tr>
              				<?php } ?>

              			<?php } else { ?>

              				<tr>
              					<td colspan="4">
              						No Record Found
              					</td>
              				</tr>
              			<?php }  ?>

              			</table>
              		</div>
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

<script type="text/javascript">
  function deleteCategory(id) 
  {  //alert(id);
  
    if (confirm('do u want delete Category?')) 
    {
      window.location.href='<?php echo base_url().'admin/Category/delete/' ?>'+id;
     // alert('<?php echo base_url().'admin/Category/delete/' ?>'+id);
    }
  }

</script>