<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class User_model extends CI_Model{
		public function user_insert($email,$name,$pwd,$gender,$province){
			$data=array(
				'account'=>$email,
				'password'=>$pwd,
				'name'=>$name,
				'gender'=>$gender,
				'province'=>$province
				);
			$query=$this->db->insert('t_users',$data);
			return $query;
		}
		public function check($email,$pwd){
			$arr=array(
				'account'=>$email,
				'password'=>$pwd
				);
			$this->db->from('t_users');
			$this->db->where($arr);
			$query=$this->db->get();
			return $query->row();
		}
	}


?>