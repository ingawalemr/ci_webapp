<?php

class Category_model extends CI_Model{

	public function create($formArray) //insert record
	{
		# insert into table values(null,'$name');
		$this->db->insert('categories', $formArray);
	}

	public function getCategories($params=[]) //fetch record
	{
	 # select * from table where name like '%q';  <----  search using LIKE query
		if (!empty($params['queryString'])) {
			$this->db->like('name', $params['queryString']);
		}
	 $result = $this->db->get('categories')->result_array();  # select * from table
	//echo $this->db->last_query(); //Returns the last query that was run (the query string,).
	return $result;
	}
	
	public function getCategory($id)
	{
		# select * from categories where id =  '$id';
		$this->db->where('id', $id);
		$categories = $this->db->get('categories')->row_array();
		return $categories;
	}

	public function updateCategory($id , $formArray)
	{
		# update table set name = '$name' where id = '$id';
		 $this->db->where('id', $id);
		 $this->db->update('categories', $formArray);
	}

	public function deleteCategory($id)
	{
		//delete from table where id= '$id';
		$this->db->where('id', $id);
		$this->db->delete('categories');
	}
	#############################################################################
	/* front-end model for category display*/
	public function getCategoriesfront($params=[]) //fetch record
	{
	     $this->db->where('categories.status', 1);
		 $result = $this->db->get('categories')->result_array();  # select * from table
		 return $result;
		/* echo $this->db->last_query(); 
		 SELECT * FROM `categories` WHERE `categories`.`status` = 1  */
		 
	}
}
?>