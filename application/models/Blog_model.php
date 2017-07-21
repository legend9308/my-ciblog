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
		public function getone($bid){
			$this->db->from('t_blogs');
			$this->db->where('BLOG_ID',$bid);
			$query=$this->db->get();
			return $query->row();
		}
		public function prev($bid){
			$this->db->limit(1);
			$this->db->from('t_blogs');
			$this->db->where('BLOG_ID<',$bid);
			$this->db->order_by('BLOG_ID', 'DESC');
			//$sql="select * from t_blogs where t_blogs.BLOG_ID<$bid order by t_blogs.BLOG_ID desc limit 1";
			$query=$this->db->get();
			return $query->row();
		}
	}

	//上一篇下一篇
	//select * from t_blogs where t_blogs.BLOG_ID>5 order by t_blogs.BLOG_ID asc limit 1




?>