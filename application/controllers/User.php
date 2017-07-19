<?php  
	defined('BASEPATH') OR exit('No direct script access allowed');
	class User extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('user_model');
			$this->load->helper('captcha');
		}
		public function reg(){
			$cap=$this->cap();
			$arr['cap']=$cap;
			$this->load->view('reg.php',$arr);
		}
		public function do_reg(){
			$email=$this->input->post('email');
			$name=$this->input->post('name');
			$pwd=$this->input->post('pwd');
			$gender=$this->input->post('gender');
			$province=$this->input->post('province');

			$query=$this->user_model->user_insert($email,$name,$pwd,$gender,$province);
			if($query){
				redirect('user/login');
			}else{
				$this->reg();
			}
		}
		public function cap(){
			$vals = array(
			    'word'      => rand(1000,9999),
			    'img_path'  => './captcha/',
			    'img_url'   => base_url().'captcha/',
			    'img_width' => '150',
			    'img_height'    => 30,
			    'expiration'    => 7200,
			    'word_length'   => 8,
			    'font_size' => 16,
			    'img_id'    => 'Imageid',
			    'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			    'colors'    => array(
		        	'background' => array(255, 255, 255),
		        	'border' => array(255, 255, 255),
		        	'text' => array(0, 0, 0),
		        	'grid' => array(255, 40, 40)
	    		)
			);

			$cap = create_captcha($vals);
			return $cap;
		}
		public function check(){
			header('Access-Control-Allow-Origin:*');
			$num=$this->input->post('num');
			var_dump($num);
		}
		public function login(){
			$this->load->view('login.php');
		}
		public function do_login(){
			$email=$this->input->post('email');
			$pwd=$this->input->post('pwd');
			$result=$this->user_model->check($email,$pwd);
			if($result){
				$data=array(
					'uid'=>$result->user_id,
					'uname'=>$result->account,
					'login'=>true
					);
				$_SESSION['uid']='';
				$_SESSION['uname']='';
				$_SESSION['login']='';
				$this->session->set_userdata($data);
				redirect('blog/index');
			}else{
				echo "<script>alert('用户名或密码错误')</script>";
				$this->login();
			}
		}
	}
?>