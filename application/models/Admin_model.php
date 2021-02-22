<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getByUsename($username)
	{
		//select * from tablename where Username = '$username';
			 $this->db->where('Username' , $username);
	$admin = $this->db->get('adminlogin')->row_array();
		return $admin;
	}
}
?>