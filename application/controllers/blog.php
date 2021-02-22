<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public function index($page=1)
	{
		$this->load->model('Article_model');
		$this->load->helper('text');

		$this->load->library('pagination');  //pagination
		$perPage = 4;
		$param['offset'] = $perPage ;
		$param['limit'] = ($page*$perPage)-$perPage;
		$config['base_url'] = base_url('Blog/index');
		$config['total_rows'] = $this->Article_model->getArticlesCount();
   /*echo $config['total_rows'] = $this->Article_model->getArticlesCount();exit();*/
		$config['per_page'] = $perPage;
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

		$articles = $this->Article_model->getArticlesfront($param);//print_r($articles);
		$data =array();
		$data['articles'] = $articles;
		$data['pagination_links'] = $pagination_links;
		$this->load->view('front/blog', $data);
	}

	public function categories()
	{
		$this->load->model('Category_model');
		$categories = $this->Category_model->getCategoriesfront();
		$data=array();
		$data['categories'] = $categories; //print_r($categories);

		$this->load->view('front/categories', $data);

	}

	public function details($id)
	{
		$this->load->model('Article_model'); 
		$articles = $this->Article_model->getArticle($id); //print_r($articles);
		if (empty($articles)) {
			redirect(base_url().'Blog');
		}
		$data=array();
		$data['articles'] = $articles;
		$this->load->view('front/details', $data);
	}

	public function category($category_id, $page=1)
	{
		$this->load->model('Category_model');
		$this->load->model('Article_model');
		$this->load->helper('text');
		$this->load->library('pagination');  //pagination
	
		$category=	$this->Category_model->getCategory($category_id);

		$perPage = 3;
		$param['offset'] = $perPage ;
		$param['limit'] = ($page*$perPage)-$perPage;
		$param['category_id'] = $category_id;

		$config['base_url'] = base_url('Blog/category/'.$category_id);
		$config['total_rows'] = $this->Article_model->getArticlesCount($param);
		$config['uri_segment'] = 4;
		$config['per_page'] = $perPage;
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

		$articles = $this->Article_model->getArticlesfront($param);//print_r($articles);
		$data =array();
		$data['articles'] = $articles;
		$data['category'] = $category;
		$data['pagination_links'] = $pagination_links;
		$this->load->view('front/category_article', $data);
	}
}
