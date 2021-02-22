<?php $this->load->view('front/header'); ?>

<div class="container-fluid" style="background-image: url(../public/images/contactus_image.jpg);">
 <div class="row">
 	<div class="col-md-12">
 		<h2 class="text-center text-white pt-5">Contact Us</h2>
 	</div>

 	<div class="container mt-4 pb-4">
 		<div class="row">
 			<div class="col-md-7">
 				<div class="card  h-100  mb-5">
 					<div class="card-header text-white bg-secondary">
 						  Have question or comments?
 					</div>
	 				<div class="card-body">

	 					<?php
	 					if (!empty($this->session->flashdata('success')))  
	 					{ ?>
	 						<div class="alert alert-success">
	 							<?php echo $this->session->flashdata('success'); ?>
	 						</div>

	 				<?php	}	?>
	 					<form name="contactus" id="contactus" method="post" action="<?php echo base_url('Pages/contact')?>">
	 						<div class="form-gorup">
	 							<label>Name : </label>
	 							<input type="text" name="name" id="name" value="<?php echo set_value('name') ?>" class="form-control <?php echo (form_error('name') !="") ? 'is-invalid':'';?>">  
	 							<?php echo form_error('name'); ?>
	 						</div>

	 						<div class="form-gorup">
	 							<label>Email : </label>
	 						   <input type="text" name="email" id="email" value="<?php echo set_value('email') ?>" class="form-control <?php echo (form_error('email') !="") ? 'is-invalid' : ''  ?>">
	 						   <?php echo form_error('email'); ?>
	 						</div>

	 						<div class="form-gorup">
	 							<label>Message : </label>
	 							<textarea name="msg" id="msg" rows="5" class="form-control">
	 								<?php echo set_value('msg') ?>
	 							</textarea>
	 						</div><br>

	 						<button type="submit" id="submit" class="btn btn-primary ">Send</button>

	 					</form>
	 				</div>
 				</div>
 			</div>

 			<div class="col-md-5">
 				<div class="card  h-100">
 					<div class="card-header text-white bg-secondary">
 						  Reach Us
 					</div>
 					<div class="card-body">
 						<p class="mb-0"><strong>Customer Service</strong></p>
 						<p class="mb-0">Phone: +91 9970410333</p>
 						<p class="mb-0">Email-id : ingawalemr12@gmail.com</p>
 						
 						<p class="mb-3">&nbsp;</p>
 						
 						<p class="mb-0"><strong>Office Address:</strong></p>
 						<p class="mb-0">SidsTech Digital,</p>
 						<p class="mb-0">Sai Siddhi Chowk,, Sainagar,</p>
 						<p class="mb-0">Ambegaon, Pune - 411046 (India) </p>
 						<p class="mb-0">Phone: +91 9970410333</p>
 						<p class="mb-0">Email-id : sidstechdigital@gmail.com</p>

 						<p class="mb-3">&nbsp;</p>  
 						
 						<p class="mb-0"><strong>Residence Address:</strong></p>
 						<p class="mb-0">Flat Nos.8, ShivParvati Biilding,</p>
 						<p class="mb-0"> Ambedkar Chowk, Shirwal , 412801</p>
 						<p class="mb-0">Phone: +91 9970410333</p>
 						<p class="mb-0">Email-id : ingawalemr12@gmail.com</p>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
</div>
<?php $this->load->view('front/footer'); ?>