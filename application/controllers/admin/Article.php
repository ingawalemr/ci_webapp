<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

		public function __construct(){ //login purpose
		parent::__construct();
		$admin =$this->session->userdata('admin');
		if (empty($admin)) {
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/Login/index');
		}
	}

	# This method will show article/list (Display) page.
	public function index($page=1)
	{
		$perpage = 5;	   // search record
		$param['offset'] =$perpage;  //per page 5 records
		$param['limit'] =  ($page*$perpage)-$perpage;
		$param['q'] = $this->input->get('q');

		$this->load->model('Article_model');
		$this->load->library('pagination');  	// pagination links open
		
		$config['base_url'] = base_url('admin/Article/index');
		$config['total_rows'] = $this->Article_model->getArticlesCount($param);
		$config['per_page'] = $perpage;
		$config['use_page_numbers'] = TRUE;

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open']= '<li class="page-item">';
		$config['num_tag_close']='</li>';
		$config['cur_tag_open'] ="<li class='disabled page-item'><li class='active page-item'>
									<a href='#' class='page-link'>";
		$config['cur_tag_close'] ="<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] ="<li class='page-item'>";
		$config['next_tag1_close'] ="</li>";
		$config['prev_tag_open'] ="<li>";
		$config['prev_tag1_close'] ="<li class='page-item'>";
		$config['first_tag_open'] ="<li>";
		$config['first_tag1_close'] ="<li class='page-item'>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag1_close'] = "<li class='page-item'>";
		$config['attributes'] = array('class' => 'page-link'); 			// pagination links close

		$this->pagination->initialize($config);
		$pagination_links = $this->pagination->create_links();

		//$param['offset'] = $config['per_page'];  //per page 5 records
		//$param['limit'] =  ($page*$config['per_page'])-$config['per_page']; // (1*5)-5 = 0
		//$param['q'] = $this->input->get('q');   # search record

		$articles = $this->Article_model->getArticles($param); //print_r($articles); exit();

		//$data['q'] = $this->input->get('q');
		$data['articles'] = $articles;
		$data['pagination_links'] = $pagination_links;

		$data['mainModule'] = 'article';
		$data['subModule'] = 'viewarticle';

		$this->load->view('admin/article/list', $data);
	}

	# This method will show article/create (insert) page.
	public function create()
	{
		$this->load->model('Category_model'); //Category_model show -"select * from table"
		$categories = $this->Category_model->getCategories();
		$data['categories'] = $categories;

		$data['mainModule'] = 'article';
		$data['subModule'] = 'createarticle';

		$this->load->helper('commom_helper');

		$config['upload_path']          = './public/uploads/articles/';  //image upload
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
		$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[20]');
		$this->form_validation->set_rules('author','Author','trim|required');

		if ($this->form_validation->run() == true) 
		{
			# code success...
			//print_r($_FILES); exit();
			if ($_FILES['image']['name'] !="") 
			{
				# image upload...
				if ($this->upload->do_upload('image')) 
				{
					$data = $this->upload->data();  # image uploaded successfully...
					
					//resize Image
					resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].
						'thumb_front/'.	$data['file_name'],1120, 800 );
					resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].
						'thumb_admin/'.	$data['file_name'],300, 250 );			
					
					# insert data wiyhout image selection
					$formArray['image'] = $data['file_name'];
					$formArray['title'] = $this->input->post('title'); 
					$formArray['category'] = $this->input->post('category_id');
					$formArray['description'] = $this->input->post('description');
					$formArray['author'] = $this->input->post('author');
					$formArray['status'] = $this->input->post('status');
					$formArray['created_at'] = date('Y-m-d H:i:s');

					$this->load->model('Article_model');
					$this->Article_model->addArticle($formArray);
					$this->session->set_flashdata('success', 'Article inserted successfully');
					redirect(base_url().'admin/Article/index');

				}else
				{
					# error in upload
					$errors = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
					$data['imageError'] = $errors;
					$this->load->view('admin/article/create', $data);
				}
			} else
			{	# insert data wiyhout image selection
				$formArray['title'] = $this->input->post('title'); 
				$formArray['category'] = $this->input->post('category_id');
				$formArray['description'] = $this->input->post('description');
				$formArray['author'] = $this->input->post('author');
				$formArray['status'] = $this->input->post('status');
				$formArray['created_at'] = date('Y-m-d H:i:s');

				$this->load->model('Article_model');
				$this->Article_model->addArticle($formArray);
				$this->session->set_flashdata('success', 'Article inserted successfully');
				redirect(base_url().'admin/Article/index');
			}
		}
		else
		{
			# code error...
			$this->load->view('admin/article/create', $data);
		}	
	}

	# This method will show article/edit (update) page.
	public function edit($id)
	{
		$this->load->library('form_validation');
		$this->load->model('Article_model');     #show "select * from table where id = $id;"
		$this->load->model('Category_model'); //Category_model show -"select * from table"
		
		$data['mainModule'] = 'article';
		$data['subModule'] = '';
		$categories = $this->Category_model->getCategories();
		
		$article = $this->Article_model->getArticle($id);  //print_r($article);	exit;
		
		if (empty($article)) {
			$this->session->set_flashdata('error','Article not found');
			redirect(base_url('admin/Article/index'));
		}
		$data['categories'] = $categories;
		$data['article'] = $article;

		//form validation for update 
		$this->load->helper('commom_helper');

		$config['upload_path']          = './public/uploads/articles/';  //image upload
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
		$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[20]');
		$this->form_validation->set_rules('author','Author','trim|required');

		if ($this->form_validation->run() == true) 
		{
			# code success...
			//print_r($_FILES); exit();
			if ($_FILES['image']['name'] !="") 
			{
				# image upload...
				if ($this->upload->do_upload('image')) 
				{
					$data = $this->upload->data();  # image uploaded successfully...
					
					//delete or unlink old image from DB/ each folder
					$path='./public/uploads/articles/thumb_admin/'.$article['image'];
                    if ($article['image'] !="" && file_exists($path) ) { 
                      	unlink($path);
                      }

                    $path='./public/uploads/articles/thumb_front/'.$article['image'];
                    if ($article['image'] !="" && file_exists($path) ) { 
                      	unlink($path);
                      }

                    $path='./public/uploads/articles/'.$article['image'];
                    if ($article['image'] !="" && file_exists($path) ) { 
                      	unlink($path);
                      } 

					//resize Image
					resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].
						'thumb_front/'.	$data['file_name'],1120, 800 );
					resizeImage($config['upload_path'].$data['file_name'], $config['upload_path'].
						'thumb_admin/'.	$data['file_name'],300, 250 );			
					
					# insert data wiyhout image selection
					$formArray['image'] = $data['file_name'];
					$formArray['title'] = $this->input->post('title'); 
					$formArray['category'] = $this->input->post('category_id');
					$formArray['description'] = $this->input->post('description');
					$formArray['author'] = $this->input->post('author');
					$formArray['status'] = $this->input->post('status');
					$formArray['updated_at'] = date('Y-m-d H:i:s');

					$this->load->model('Article_model');
					$this->Article_model->updateArticle($id, $formArray);
					$this->session->set_flashdata('success', 'Article updated successfully');
					redirect(base_url().'admin/Article/index');

				}else
				{
					# error in upload
					$errors = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
					$data['imageError'] = $errors;
					$this->load->view('admin/article/create', $data);
				}
			} else
			{	# insert data wiyhout image selection
				$formArray['title'] = $this->input->post('title'); 
				$formArray['category'] = $this->input->post('category_id');
				$formArray['description'] = $this->input->post('description');
				$formArray['author'] = $this->input->post('author');
				$formArray['status'] = $this->input->post('status');
				$formArray['updated_at'] = date('Y-m-d H:i:s');

				$this->load->model('Article_model');
				$this->Article_model->updateArticle($id, $formArray);
				$this->session->set_flashdata('success', 'Article updated successfully');
				redirect(base_url().'admin/Article/index');
			}
		}
		else
		{
			$this->load->view('admin/article/edit', $data);	
		}			
	}

	# This method will show article/list (Display) page.
	public function delete($id)
	{	//echo $id;
		$this->load->model('Article_model');

			$article = $this->Article_model->getArticle($id);  //print_r($article);	exit;
			if (empty($article)) {
				$this->session->set_flashdata('error','Article not found');
				redirect(base_url('admin/Article/index'));
			}
		
			//delete or unlink old image from DB/ each folder
			$path='./public/uploads/articles/thumb_admin/'.$article['image'];
            if ($article['image'] !="" && file_exists($path) ) { 
              	unlink($path);
            }

       	 	$path='./public/uploads/articles/thumb_front/'.$article['image'];
             if ($article['image'] !="" && file_exists($path) ) { 
                 unlink($path);
            }

       		$path='./public/uploads/articles/'.$article['image'];
            if ($article['image'] !="" && file_exists($path) ) { 
              	unlink($path);
            }

		$this->Article_model->deleteArticle($id);
		$this->session->set_flashdata('success', 'Article has been deleted successfully');
		redirect(base_url().'admin/Article/index');
	}
}
