<?php $this->load->view('front/header'); ?>

<div class="container">
	<h3 class="pt-4 pb-4">Blog</h3>
	
	<div class="row">	
		<div class="col-md-12">
			<h3><?php echo $articles['title']; ?></h3>
			<div class="d-flex justify-content-between">
			    <p class="text-muted">Posted by <strong> <?php echo $articles['author'];  ?> </strong> on <strong> <?php echo date('d M Y', strtotime($articles['created_at']));?></strong></p>
			    
				<a href="" class="text-muted text-uppercase p-2 bg-light"><?php echo $articles['category_name'];  ?></a>
			</div>

			<div class="mb-3 mt-3">
				<?php
				$path='./public/uploads/articles/thumb_front/'.$articles['image'];
				if ($articles['image'] !='' && file_exists($path)) { ?>
					<img class="w-100 rounded" src="<?php echo base_url().'public/uploads/articles/thumb_front/'.$articles['image']; ?>">
				<?php }	?>
			</div>
			<p><?php echo strip_tags($articles['description']); ?></p>
		</div>
	</div>
</div>

<?php $this->load->view('front/footer'); ?>
