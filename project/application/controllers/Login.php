<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	

	public function __construct() {
		parent:: __construct();
		$this->load->library("session");
	}

	/*public function get_permissao()
	{
		$permissao = null;
		if ($this->session->userdata("user_id")) {
			$user_id = $this->session->userdata("user_id");
			$this->load->model("users_model");
			$result = $this->users_model->get_user_permissao($user_id);
			$permissao = $result->permissao;			
		}
		return $permissao;
	}*/

	public function index()
	{
		
		if ($this->session->userdata("user_id"))
		{
			$user_id = $this->session->userdata("user_id");
			$this->load->model("users_model");
			$result = $this->users_model->get_user_permissao($user_id);
			$permissao = $result;
			
			if($permissao == 2)
			{
				$data = array
				(
				"styles" => array
					(
						"dataTables.bootstrap.min.css",
						"datatables.min.css"
					),
				"scripts" => array
					(	
						/*"sweetalert2.all.min.js",					
						"dataTables.bootstrap.min.js",
						"datatables.min.js",*/
						"util.js",
						"adm.js"
					),
					"user_id" => $this->session->userdata("user_id"),
					"nome_completo" => $this->users_model->get_user_nome($user_id)->nome_completo
				);
				$this->template->show("home_adm.php", $data);
			}
			else if($permissao == 1)
			{
				$data = array
				(
				"styles" => array
					(
						"dataTables.bootstrap.min.css",
						"datatables.min.css"
					),
				"scripts" => array
					(	
						/*"sweetalert2.all.min.js",					
						"dataTables.bootstrap.min.js",
						"datatables.min.js",*/
						"util.js",
						"suporte.js"
					),
					"user_id" => $this->session->userdata("user_id"),
					"nome_completo" => $this->users_model->get_user_nome($user_id)->nome_completo
				);
				$this->template->show("home_suporte.php", $data);
			}
			else if($permissao == 0)
			{
				$data = array
				(
				"styles" => array
					(
						"dataTables.bootstrap.min.css",
						"datatables.min.css"
					),
				"scripts" => array
					(	
						/*"sweetalert2.all.min.js",					
						"dataTables.bootstrap.min.js",
						"datatables.min.js",*/
						"util.js",
						"usuario.js"
					),
					"user_id" => $this->session->userdata("user_id"),
					"nome_completo" => $this->users_model->get_user_nome($user_id)->nome_completo
				);
				$this->template->show("home_usuario.php", $data);
			}

			
		}
		else
		{
			
			$data = array
			(
				"scripts" => array
					(
						"util.js",
						"login.js"
					)
			);
			//$this->template->show('login');
			$this->load->view('login', $data);
			//$this->load->model("users_model");
			//print_r($this->users_model->get_user_data("jonasbastani1999@gmail.com"));
		}
	}

	public function logoff()
	{
		$this->session->sess_destroy();
		header("Location:" . base_url() . "login");
	}

	public function ajax_login()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}


		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		//$email = $this->request->getVar('email');
		$email = $this->input->post("email");
		//$email = "joao";
		$senha = $this->input->post("senha");

		if (empty($email))
		{

			$json["status"] = 0;
			$json["error_list"]["#email"] = "<center>Email não pode ser vazio!</center>";	
		}

		else
		{
			$this->load->model("users_model");
			$result = $this->users_model->get_user_data($email);
			if ($result) 
			{

				$json["ativo"] = $result->ativo;
				
				if ($json["ativo"] == 1) {
					$user_id = $result->user_id;
					$senha_hash = $result->senha_hash;
					if (password_verify($senha, $senha_hash)) {
						$this->session->set_userdata("user_id", $user_id);
					}

					else 
					{
						$json["status"] = 0;
					}
				}
				else
				{
					$json["status"] = 0;
				}

				
				
			}

			else 
				{
					$json["status"] = 0;
				}
			if ($json["status"] == 0) {
				$json["error_list"]["#btn-login"] = "<center>Usuário e/ou senha incorretos!</center>";
			}
		}

		echo json_encode($json);	


	}
	

}