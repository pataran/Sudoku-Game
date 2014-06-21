<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('main.php');
class user extends Main{
	public function __construct()
	 {
	 parent::__construct();
	 }

	public function login()
		{
			$this->load->view('hello');
		}

	public function login_process()
		{	
			$data['errors'] = '';

			$data = "";
			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email Address', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		 	
			if($this->form_validation->run() === False)
			{
				$data .= validation_errors();
				
			}
			else
			{
				$data = array( 'email' => $this->input->post('email'),  'password' => $this->input->post('password'),'login_status' => TRUE);
				$this->session->set_userdata('user_session', $data);
				// var_dump($this->session->userdata['user_session']['email']);
				
			}
			echo json_encode($data);
		}

		public function generate_sudoku()
		{
			$this->load->view('sudokugen/example2.php');
		}


		// public function test($difficulty)
		// {	
  //   		 echo $difficulty;
		// }

		public function sudoku_check()
		{
			$data = "";
			$solutionarr = array();
			$answerarr = array();
			$possiblesolution = ($this->input->post());
			// var_dump($possiblesolution);
			$answer = $this->session->userdata('answer');

			foreach($answer as $value)
			{
				$string = strval($value);
				array_push($answerarr, $value);
			}

			foreach($possiblesolution as $key)
			{
				foreach($key as $value)
				{	
					array_push($solutionarr, $value);
				}
			}
			// var_dump($solutionarr);
			// var_dump('answer');
			// var_dump($possiblesolution);
			// $test1 = array('1','2');
			// $test2 = array('1','2');
			// $answer = array_diff($test1, $test2);
			$answer = array_diff($solutionarr, $answerarr);
			
				if(!empty($answer))
				{
				$data['lose'] = "This is not a solution";
				}
				else
				{
				$data['win'] = "CORRECT! Congrats!!";	
				}
				echo json_encode($data);
		}

		public function leaderboard()
		{
			$this->load->view('leaderboard');
		}

		public function sudokufront($difficulty = null)
		{
			$this->load->library('example2');
			$fuckmylife = $this->example2->fuckmylife($difficulty);
			$sudokudata['data'] = $fuckmylife;
			$this->session->set_userdata('answer', $fuckmylife['solution']);
			$this->load->view('sudokufront',$sudokudata);
			// var_dump($sudokudata);
		}

		public function profile()
		{
			$this->load->model('database');
			$user = $this->session->userdata['user_session'];
			$data ="Welcome";

			foreach($this->database->get_user($user) as $info)
			{	
				$data .= $info;	
			}
			echo json_encode($data);
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url('/user/'));
		}

	

		
		public function register_action()
		{
			$data = "";
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name', 'First name', 'required');
			$this->form_validation->set_rules('last_name', 'Last name', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[users.email]');
		 	$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_password_check|matches[repeat_password]');
		 	if($this->form_validation->run() === False)
			{	
				$data .= validation_errors();
				echo json_encode($data);
			}
			else
			{

				$this->load->model('database');
				$this->load->library('encrypt');

				$pass = $this->input->post('password');
				$user = array( 'first_name' => $this->input->post('first_name'), 
						'last_name' => $this->input->post('last_name'), 
						'email' => $this->input->post('email'), 
						'password' => $this->encrypt->encode($pass),
						'register_status' => TRUE);
				// $this->input->post('password')
				

				$this->session->set_userdata('user_session', $user);
				
				$this->database->register_user($user);
				 // var_dump($this->session->userdata['user_session']);
				redirect(base_url('user/profile'));
			}
		}

		public function password_check($str)
		{
	    if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) 
		   {
		     return TRUE;
		   }
	    	$this->form_validation->set_message("password_check", "The %s needs a numeric character");
	    	return FALSE;
		}

	public function index()
	{	
		 $this->load->view('hello.php');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */