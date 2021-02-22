<?php $this->load->view('front/header'); ?>

<div class="container">
	<h3 class="pt-4 pb-4">Blog / <?php echo $category['name']; ?></h3>

	<?php if(!empty($articles)) 
	{
		foreach ($articles as $article) { ?>	
	<div class="row mb-5">
		<div class="col-md-4">
			<?php
			if (!empty($article['image'])) { ?>
				<img class="w-100 rounded" src="<?php echo base_url().'public/uploads/articles/thumb_admin/'.$article['image'] ?>">
		<?php	} ?>
		</div>
		
		<div class="col-md-8">
			<p class="bg-light pt-2 pb-2 pl-2">
				<a href="<?php echo base_url('Blog/category/'.$article['category']) ?>" class="text-muted text-uppercase"><?php echo $article['category_name']; ?></a>
			</p>
			
			<h3><a href="<?php echo base_url('Blog/details/'.$article['id']) ?>"><?php echo $article['title']; ?></a></h3>
			
			<p><?php echo word_limiter(strip_tags($article['description']), 45); ?>
				<a href="<?php echo base_url('Blog/details/'.$article['id']) ?>">Read More</a>
			</p>      
			<?php //strip_tags() - it removes html contents , tags etc from text or paragraph ?>

			
			<p class="text-muted">Posted by <strong><?php echo $article['author']; ?></strong> on 
				<strong><?php echo date('d M Y', strtotime( $article['created_at'])); ?></strong>
			</p>
		</div>
	</div>

<?php } 
	} ?>
	<div class="row">
		<div class="col-md-12">
		<?php echo  $pagination_links; ?>
		</div>
	</div>
</div>

<?php $this->load->view('front/footer'); ?>