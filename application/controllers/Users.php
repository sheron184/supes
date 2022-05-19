<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer; 
		use PHPMailer\PHPMailer\Exception;
		require './mail/src/Exception.php';
		require './mail/src/PHPMailer.php';
		require './mail/src/SMTP.php';
class Users extends CI_Controller{
	public function index(){
		if($this->session->userdata("logged_in")){
			$this->load->view('users/profile');
		}else{
			$this->load->view('users/login');
		}
	}
	public function is_rated(){
		if($this->user_model->is_rated()){
			echo "not_rated";
		}else{
			echo "rated";
		}
	}
	public function mail(){

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Mailer = "smtp";

		$mail->SMTPDebug  = 1;  
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "ssl://smtp.gmail.com";
		$mail->Username   = "sheron@sjtechlead.space";
		$mail->Password   = "maestro@sjtech";

		$mail->IsHTML(true);
		$mail->AddAddress("roykent340@gmail.com");
		$mail->SetFrom("sheron@sjtechlead.space", "sheron jude");
		$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
		$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

		$mail->MsgHTML($content); 
		if(!$mail->Send()) {
		  echo "Error while sending Email.";
		  var_dump($mail);
		} else {
		  echo "Email sent successfully";
		}
	}
	public function rate_hero(){
		//var_dump($this->input->post());die();
		$rate = $this->user_model->rate_hero();
		if(!$rate){
			echo "error";
		}else{
			echo json_encode($rate);
		}
	}
	public function marvelordc(){
		if($this->session->userdata("logged_in")){
			$user = $this->user_model->get_user($this->session->userdata("uniq_id"));
			if(empty($user[0]->marvelordc)){
				$this->load->view('users/marvelordc');
			}else{
				redirect('users/profile');
			}
		}else{
			redirect('users');
		}
	}
	public function add_fan(){
		$this->user_model->add_fan();
		$data = ["marvelordc" => $this->input->post("marvelordc")];
		$this->session->set_userdata($data);
		redirect('users/profile');
	}
	public function profile(){
		$this->load->view('users/profile');
	}
	public function reg(){
		if($this->user_model->check_email()){
			if($this->user_model->create()){
				$this->session->set_flashdata('user_created','Signed up Successfully!');
				redirect('users');
			}	
		}else{
			$this->session->set_flashdata('user_not_created','This email already been used!');
			redirect('users');
		}
	}
	public function login(){
		$logged_in_user = $this->user_model->login();
		if($logged_in_user == "invalid"){
			$this->session->set_flashdata('user_not_created','Invalid email or password');
			redirect("users");
		}else{
			$data = [
				'id' => $logged_in_user[0]->id,
				'uniq_id' => $logged_in_user[0]->uniq_id,
				'email' => $logged_in_user[0]->email,
				'username' => $logged_in_user[0]->username,
				'full_name' => $logged_in_user[0]->full_name,
				'marvelordc' => $logged_in_user[0]->marvelordc,
				'logged_in' => true
			];
			$this->session->set_userdata($data);
			if($logged_in_user->marvelordc == ""){
				redirect('users/marvelordc');
			}else{
				redirect('users/profile');
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
}