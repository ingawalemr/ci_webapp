<?php

class Article_model extends CI_Model
{
		/* Backend model	*/
	public function getArticle($id) //fetch single article
	{
		// select * from table where id = $id;
		$this->db->select('articles.*, categories.name as category_name');
		$this->db->where('articles.id', $id);
		$this->db->join('categories', 'categories.id = articles.category', 'left');
		$article = $this->db->get('articles')->row_array();
		return $article;
	}

	public function getArticles($param = array()) //fetch all articles
	{		
		if (isset($param['offset']) && isset($param['limit'])) {
			$this->db->limit($param['offset'], $param['limit']);
		}
		
		if (isset($param['q'])) {
			$this->db->or_like('title', trim($param['q']) );   // search record
			$this->db->or_like('author', trim($param['q']));
		}

		$articles =	$this->db->get('articles')->result_array();// select * from articles
		//echo $this->db->last_query();
		return $articles;								
	}

	public function getArticlesCount($param = array()) //pagination and search record
	{
		if (isset($param['q'])) {
			$this->db->or_like('title', trim($param['q']) );   // search record
			$this->db->or_like('author', trim($param['q']));
		}

		if (isset($param['category_id'])) {
			$this->db->where('category', $param['category_id']);
		}

		$count = $this->db->count_all_results('articles'); // count all rows in db table
		//echo $this->db->last_query();
		return $count;								
	}

	public function addArticle($formArray) // insert articles
	{
		$this->db->insert('articles', $formArray);
		return $this->db->insert_id();// insert ID number when performing database inserts
	}

	public function updateArticle($id, $formArray)
	{
		$this->db->where('id', $id);			// update table set name = $name where id = $id;
		$this->db->update('articles', $formArray);
	}

	public function deleteArticle($id)
	{	
		$this->db->where('id', $id); // delete from table where where id = $id;
		$this->db->delete('articles');
	}


	##############################################################################################
	/*	frontend model	*/

		public function getArticlesfront($param = array()) //fetch all articles
	{		
		if (isset($param['offset']) && isset($param['limit'])) {
			$this->db->limit($param['offset'], $param['limit']);
		}
		
		if (isset($param['q'])) {
			$this->db->or_like('title', trim($param['q']) );   // search record
			$this->db->or_like('author', trim($param['q']));
		}

		if (isset($param['category_id'])) {
			$this->db->where('category', $param['category_id']);
		}
		$this->db->SELECT('articles.*, categories.name as category_name');
		$this->db->where('articles.status', 1);
	 	$this->db->order_by('articles.created_at', 'DESC');
		$this->db->join('categories', 'categories.id = articles.category' , 'left');
		$articles =	$this->db->get('articles')->result_array();// select * from articles
		/*echo $this->db->last_query(); 
		 SELECT * FROM `articles` WHERE `articles`.`status` = 1 ORDER BY `created_at` DESC  */
		return $articles;								
	}
}
?>