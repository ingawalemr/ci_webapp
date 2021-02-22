<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct(){ //login purpose
		parent::__construct();
		$admin =$this->session->userdata('admin');
		
		if (empty($admin)) {
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/Login/index');
		}
	}

	public function index()
	{
		# This method will show category list page(display data)
		$this->load->model('Category_model');
		$queryString = $this->input->get('q');
		$params['queryString'] = $queryString;

		$Categori = $this->Category_model->getCategories($params);
		$data['categories'] = $Categori;  // 'categories' is a table name
		$data['queryString'] = $queryString;

		$data['mainModule'] = 'category';
		$data['subModule'] = 'viewcategory';

		$this->load->view('admin/category/list', $data);
	}

	public function create()
	{
		$this->load->helper('commom_helper'); // load helper for image resize
		
		$data['mainModule'] = 'category';
		$data['subModule'] = 'createcategory';

		#Upload File
		$config['upload_path']          = './public/uploads/category/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']          = TRUE;

        $this->load->library('upload', $config);

		# This method will show category create page(insert data)
		$this->load->model('Category_model');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');

		if ($this->form_validation->run() == TRUE) 
		{
			 
				//print_r($_FILES['image']); exit();    or  print_r($_FILES); exit;
				if (!empty($_FILES['image']['name'])) // Now user has selected a file so we will proceeed
				{
					if ($this->upload->do_upload('image'))// File uploaded successfully
					{
						$data = $this->upload->data();//echo "<pre>";print_r($data);echo "</pre>";exit();
													 
						//resize image
				resizeImage($config['upload_path'].$data['file_name'], 	
	        				$config['upload_path'].'thumb/'.$data['file_name'], 300, 270);

						$formArray['image']  = $data['file_name'];  #insert values into table with image 
						$formArray['name']   = $this->input->post('name'); 
						$formArray['status'] = $this->input->post('status');
						$formArray['created_at'] = date('Y-m-d H:i:s');
						
						$this->Category_model->create($formArray);
						$this->session->set_flashdata('success', 'Category added successfully');
						redirect(base_url().'admin/Category/index');
					}
					else
					{
						# image upload errors...select 'image" only, "not pdf file" etc
						$error = $this->upload->display_errors('<p class="invalid-feedback">','</p>');
						$data['erroeImageUpload'] = $error;
						$this->load->view('admin/category/create', $data);	
					}
				}
				else 
				{
					# validation success...... insert into table without image selection	
					$formArray['name'] = $this->input->post('name'); 
					$formArray['status'] = $this->input->post('status');
					$formArray['created_at'] = date('Y-m-d H:i:s');
					
					$this->Category_model->create($formArray);
					$this->session->set_flashdata('success', 'Category added successfully');
					redirect(base_url().'admin/Category/index');
				}			
		} 
		else
		{
			# validation errors 
		$this->load->view('admin/category/create', $data);			
		}

	}

	public function edit($id)
	{
		# This method will show category edit page(update data)
			$this->load->model('Category_model');
			
			$data['mainModule'] = 'category';
			$data['subModule'] = '';	

			$categories=$this->Category_model->getCategory($id); #print_r($categories);
					
			if (empty($categories)) 
			{
				$this->session->set_flashdata('error', 'Categoey not found');
				redirect(base_url().'admin/Category/index');
			}

				$this->load->helper('commom_helper'); // load helper for image resize
				#Upload File
				$config['upload_path']          = './public/uploads/category/';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['encrypt_name']          = TRUE;

		        $this->load->library('upload', $config);

				# This method will show category create page(insert data)
				$this->load->model('Category_model');
				$this->load->library('form_validation');

				$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
				$this->form_validation->set_rules('name', 'Name', 'trim|required');

				if ($this->form_validation->run() == TRUE) 
				{
					
					if (!empty($_FILES['image']['name'])) 
					{
						if ($this->upload->do_upload('image'))// File uploaded successfully
						{
							$data = $this->upload->data();
							
							resizeImage($config['upload_path'].$data['file_name'], 	
		        						$config['upload_path'].'thumb/'.$data['file_name'], 300, 270);

							$formArray['image']  = $data['file_name'];  
							$formArray['name']   = $this->input->post('name'); 
							$formArray['status'] = $this->input->post('status');
							$formArray['updated_at'] = date('Y-m-d H:i:s');
							
							$this->Category_model->updateCategory($id , $formArray);

							if (file_exists('./public/uploads/category/'.$categories['image'])) {
								unlink('./public/uploads/category/'.$categories['image']);
							}

							if (file_exists('./public/uploads/category/thumb/'.$categories['image'])) {
								unlink('./public/uploads/category/thumb/'.$categories['image']);
							}

							$this->session->set_flashdata('success', 'Category updated successfully');
							redirect(base_url().'admin/Category/index');
						}
						else
						{
							# image upload errors...select 'image" only, "not pdf file" etc
						  $error = $this->upload->display_errors('<p class="invalid-feedback">','</p>');
						  $data['erroeImageUpload'] = $error;
						  $data['categories'] = $categories;
						  $this->load->view('admin/category/edit' ,$data);	
						}
					}
					else 
					{
						# validation success...... insert into table without image selection	
						$formArray['name'] = $this->input->post('name'); 
						$formArray['status'] = $this->input->post('status');
						$formArray['updated_at'] = date('Y-m-d H:i:s');
						
						$this->Category_model->updateCategory($id , $formArray);
						$this->session->set_flashdata('success', 'Category updated successfully');
						redirect(base_url().'admin/Category/index');
					}			
				} 
				else
				{
					$data['categories'] = $categories;
					$this->load->view('admin/category/edit' ,$data);
				}


	}

	public function delete($id)
	{
		# This method will show category delete page(delete data)
		$this->load->model('Category_model');	
		$categories=$this->Category_model->getCategory($id); #print_r($categories);
					
			if (empty($categories)) 
			{
				$this->session->set_flashdata('error', 'Categoey not found');
				redirect(base_url().'admin/Category/index');
			}

		if (file_exists('./public/uploads/category/'.$categories['image'])) {
			unlink('./public/uploads/category/'.$categories['image']);
		}

		if (file_exists('./public/uploads/category/thumb/'.$categories['image'])) {
			unlink('./public/uploads/category/thumb/'.$categories['image']);
		}

		$this->Category_model->deleteCategory($id);
		$this->session->set_flashdata('success', 'Categoey deleted successfully');
		redirect(base_url().'admin/Category/index');
	}
}
