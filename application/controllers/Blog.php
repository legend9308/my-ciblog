<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Blog extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('blog_model');
			$this->load->library('pagination');
		}
		public function index(){
			$cou=$this->blog_model->count();

			$page=$this->uri->segment(3);
			$config['total_rows'] = $cou;
			$config['per_page'] = 3;
			
			$config['base_url'] = site_url('blog/index');
			$this->pagination->initialize($config);
			$result=$this->blog_model->all($config['per_page'],$page);

			$arr['data']=$result;
			$this->load->view('blog.php',$arr);
		}
	}

?>