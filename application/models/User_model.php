<?php 

class User_model extends CI_Model{
	public function create(){
		$pd = $this->input->post();
		$data = [
			'uniq_id' => uniqid(),
			'username' => $pd['username'],
			'email' => $pd['email'],
			'full_name' => $pd['full_name'],
			'password' => $pd['password']
		];
		return $this->db->insert('users',$data);
	}
	public function rate_hero(){
		$post_data = $this->input->post();
		$this->db->where('id',$post_data['id']);
		$q1 = $this->db->get('cb_heros');
		$hero = $q1->result();
		//var_dump($hero);die();
		if(!empty($hero)){
			$old_rate = json_decode($hero[0]->ratings);
			$new_total_rate = $old_rate[0] + $post_data['rate'];
			$new_total_rated_users = $old_rate[1] + 1;
			$new_rate = [$new_total_rate,$new_total_rated_users];
			$new_rate_string = json_encode($new_rate);
			$data = [
				"ratings" => $new_rate_string
			];
			$this->db->where('id',$post_data['id']);
			$this->db->update('cb_heros',$data);

			//add rating to user
			$rate_data = [
				'user_id' => $this->session->userdata('uniq_id'),
				'hero_id' => $post_data['id'],
				"rate" => $post_data['rate']
			];
			$this->db->insert('ratings',$rate_data);
			$return_data = [
				'new_total_rate' => $new_total_rate,
				'new_total_rated_users' => $new_total_rated_users
			];
			return $return_data;
		}else{
			return false;
		} 
	}
	public function is_rated(){
		$this->db->where('user_id',$this->session->userdata('uniq_id'));
		$this->db->where('hero_id',$this->input->post('heroid'));
		$query = $this->db->get('ratings');
		if(empty($query->result())){
			return true;
		}else{
			return false;
		}
	}
	public function check_email(){
		$this->db->where('email',$this->input->post('email'));
		$query = $this->db->get("users");
		$res = $query->result();
		//var_dump($query);die();
		if(empty($res)){
			return true;
		}else{
			return false;
		}
	}
	public function login(){
		$pd = $this->input->post();
		$this->db->where('email',$pd['email']);
		$this->db->where('password',$pd['password']);
		$query = $this->db->get("users");
		$res = $query->result();
		if(empty($res)){
			return "invalid";
		}else{
			return $res;
		}
	}
	public function get_user($id){
		$this->db->where('uniq_id',$id);
		$query = $this->db->get('users');
		return $query->result();
	}
	public function add_fan(){
		$data = [
			"marvelordc" => $this->input->post('marvelordc')
		];
		$this->db->where('uniq_id',$this->session->userdata('uniq_id'));
		return $this->db->update('users',$data);
	}
}