<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Model 
{
	var $user = null;

	public function get_user($user)
	{
		return $this->db->where('email' , $user['email'])
					->where('password' , $user['password'])
					->get("users")
					->row();
	}

	public function register_user($user)
	{
		return $this->db->insert('users', $user);
	}


}