<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Blog_model extends CI_Model{
		public function all($a,$b){
			$ses=$_SESSION['uid'];
			//$b=($b-1)*$a;
			$this->db->limit($a,$b);
			$this->db->select("*");
			$this->db->from('t_blogs');
			$this->db->where('WRITER',$ses);
			$this->db->join('t_blog_catalogs','t_blog_catalogs.CATALOG_ID=t_blogs.CATALOG_ID');
			$query=$this->db->get();
			return $query->result();
		}
		public function count(){
			$num=$this->db->count_all_results('t_blogs');
			return $num;
		}
	}





?>