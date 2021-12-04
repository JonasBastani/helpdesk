<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_usuario extends CI_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->library("session");
	}

	public function index()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}
		else
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}
		//$this->load->view('login');
	}

	

	public function ajax_save_user()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("users_model");

		$data = $this->input->post();

		

		if (empty($data["email"]))
		{
			$json["error_list"]["#email"] = "Email do usuário é obrigatório";
		}
		else
		{
			if($this->users_model->is_duplicated("email", $data["email"], $data["user_id"]))
			{
				$json["error_list"]["#email"] = "Email já existente na base de dados!";
			}
		}

		if (empty($data["nome_completo"]))
		{
			$json["error_list"]["#nome_completo"] = "O nome completo é obrigatório";
		}

		if(empty($data["senha"]))
		{
			$json["error_list"]["#senha"] = "Senha é obrigatório!";
		}
		else
		{
			if ($data["senha"] != $data["senha_confirma"])
			{
				$json["error_list"]["#senha"] = "";
				$json["error_list"]["#senha_confirma"] = "As senhas não conferem!";
			}
		}

		if(empty($data["permissao"]))
		{
			$json["error_list"]["#permissao"] = "Permissão é obrigatório!";
		}
		else
		{
			if ($data["permissao"] == "Administrador") {
			$data["permissao"] = 2;
			}
			else if ($data["permissao"] == "Suporte") {
			$data["permissao"] = 1;
			}
			else if ($data["permissao"] == "Usuário") {
			$data["permissao"] = 0;
			}
		}

		

		if (!empty($json["error_list"]))
		{
			$json["status"] = 0;
		}
		else
		{
			$data["senha_hash"] = password_hash($data["senha"], PASSWORD_DEFAULT);
			// retirando os campos senha e confirmar senha do $data
			unset($data["senha"]);
			unset($data["senha_confirma"]);

			if(empty($data["user_id"]))
			{
				$data["ativo"] = 1;
				$this->users_model->insert($data);
			}
			else
			{
				$user_id = $data["user_id"];
				unset($data["user_id"]);
				$this->users_model->update($user_id, $data);
			}

		}

		echo json_encode($json);

	}

	public function ajax_get_user_data()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();


		$this->load->model("users_model");
		
		$user_id = $this->input->post("user_id");
		$data = $this->users_model->get_data($user_id)->result_array()[0];
		$json["input"]["user_id"] = $data["user_id"];
		$json["input"]["nome_completo"] = $data["nome_completo"];
		$json["input"]["email"] = $data["email"];
		if($data["permissao"] == 2)
		{
			$json["input"]["permissao"] = "Administrador";
		}
		else if($data["permissao"] == 1)
		{
			$json["input"]["permissao"] = "Suporte";
		}
		else if($data["permissao"] == 0)
		{
			$json["input"]["permissao"] = "Usuário";
		}
		//$json["input"]["permissao"] =  $data["permissao"];
		//$json["input"]["senha"] = $data["senha_hash"];
		//$json["input"]["senha_confirma"] = $data["senha_hash"];
		$json["input"]["ativo"] = $data["ativo"];

		echo json_encode($json);

	}



	public function ajax_list_user()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$this->load->model("users_model");
		$dados = $this->users_model->get_datatable();
		// $usuarios = array("user" => $dados);

		$data = array();
		foreach ($dados as $usuario) {
		
			$row = array();
			$row[] = $usuario->user_id;
			$row[] = $usuario->nome_completo;
			$row[] = $usuario->email;


			if($usuario->permissao == 0)
			{
				$row[] = "Usuário";
			}
			else if($usuario->permissao == 1)
			{
				$row[] = "Suporte";
			}
			else if($usuario->permissao == 2)
			{
				$row[] = "Administrador";
			}
			if ($usuario->ativo == 1) {
				$row[] = "Ativo";
				$row[] = '<div  class="acoes form-row">
						<a  style="cursor: pointer;" title="Clique para editar usuário" class="btn-edit-user" id="btn-edit-user" user_id="'.$usuario->user_id.'"><p><i class="tim-icons icon-pencil"></i></p></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a style="cursor: pointer;" title="Clique para desativar usuário" class="btn-desative-user" user_id="'.$usuario->user_id.'"><p><i class="tim-icons icon-trash-simple"></i></p></a>
					</div>';
			}
			else if ($usuario->ativo == 0) {
				$row[] = "Desativado";
				$row[] = '<div class="acoes form-row">
						<a style="cursor: pointer;" type="click"title="Clique para editar usuário" class="btn-edit-user" user_id="'.$usuario->user_id.'"><p><i class="tim-icons icon-pencil"></p></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a style="cursor: pointer;" title="Clique para reativar usuário" class="btn-active-user" user_id="'.$usuario->user_id.'"><p><i class="tim-icons icon-double-left"></i></p></a>
					</div>';
			}
			

			$data[] =  $row;

		}


		$json = array(
				"draw" => $this->input->post("draw"),
				"recordsTotal" => $this->users_model->records_total(),
				"recordsFiltered" => $this->users_model->records_filtered(),
				"data" => $data
		);

		echo json_encode($json);


	}


	// Fução para importar imagem do chamado
	public function ajax_import_image()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}
		$config["upload_path"] = "./tmp/";
		$config["allowed_types"] = "gif|png|jpg";
		$config["overwrite"] = TRUE;

		// carregando biblioteca do codeignaiter para upload de imagens passado o config como parâmetro
		$this->load->library("upload", $config);


		$json = array();
		$json["status"] = 1;

		//se o campo do js NAO foi passado
		if(!$this->upload->do_upload("image_file"))
		{
			$json["status"] = 0;
			//mostrando erro gerenciado pela própria biblioteca
			$json["error"] = $this->upload->display_errors("","");

		}
		else
		{
			//o upload pode ser no máximo de 1MB
			if($this->upload->data()["file_size"] <= 1024)
			{
				$file_name = $this->upload->data()["file_name"];
				$json["imagem_path"] = base_url() . "tmp/" . $file_name;
				$json["imagem_path_list"] = base_url() . "tmp/" . $file_name;
			}
			else
			{
				$json["status"] = 0;
				$json["error"] = "Arquivo não deve ser maior que 1MB!";
			}
		}

		echo json_encode($json);
	}

	// Função para salvar chamados

	public function ajax_save_chamado()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("users_model");
		$this->load->model("chamados_model");

		$data = $this->input->post();
		unset($data["contesta"]);


		if (empty($data["problema"]))
		{
			$json["error_list"]["#problema"] = "Problema é obrigatório";
		}

		if (empty($data["setor"]))
		{
			$json["error_list"]["#setor"] = "Setor é obrigatório";
		}

		if(empty($data["tipo"]))
		{
			$json["error_list"]["#tipo"] = "Tipo é obrigatório!";
		}

		if(empty($data["urgencia"]) ||  empty($data["impacto"]))
		{
			if (empty($data["urgencia"])) {
				$json["error_list"]["#urgencia"] = "Urgência é obrigatório!";
			}
			if(empty($data["impacto"]))
			{
				$json["error_list"]["#impacto"] = "Impacto é obrigatório!";
			}
			
		}
		else
		{
			$urgencia = NULL;
			$impacto = NULL;
			if($data["urgencia"] == "Baixa")
			{
				$urgencia = 1;
			}
			else if($data["urgencia"] == "Média")
			{
				$urgencia = 2;
			}
			else if($data["urgencia"] == "Alta")
			{
				$urgencia = 3;
			}
			else if($data["urgencia"] == "Altíssima")
			{
				$urgencia = 4;
			}
			else
			{
				$json["error_list"]["#urgencia"] = "Valor de urgencia é inválido!";
			}

			if($data["impacto"] == "Baixo")
			{
				$impacto = 1;
			}
			else if($data["impacto"] == "Médio")
			{
				$impacto = 2;
			}
			else if($data["impacto"] == "Alto")
			{
				$impacto = 3;
			}
			else if($data["impacto"] == "Altíssimo")
			{
				$impacto = 4;
			}
			else
			{
				$json["error_list"]["#impacto"] = "Valor de impacto é inválido!";
			}
			if (isset($urgencia) && isset($impacto)) {
				$prioridade = $urgencia + $impacto;

				if($prioridade <= 3)
				{
					$data["prioridade"] = 4;
				}
				else if($prioridade > 3 && $prioridade < 6)
				{
					$data["prioridade"] = 3;
				}
				else if($prioridade > 5 && $prioridade < 8)
				{
					$data["prioridade"] = 2;
				}
				else if($prioridade == 8)
				{
					$data["prioridade"] = 1;
				}
			}
			
			
			

		}

		if (!empty($json["error_list"]))
		{
			$json["status"] = 0;
		}
		else
		{	
			// verificando se foi adicionada uma imagem
			if (!empty($data["imagem"])) {
				// passando o nome do arquivo para $file_name
				$file_name = basename($data["imagem"]);
				// pegando camiso fisico do arquivo no sistema
				$old_path = getcwd() . "/tmp/" . $file_name;
				// passando novo caminho fisico do arquivo no sistema
				$new_path = getcwd() . "/public/images/chamados/" . $file_name;
				rename($old_path, $new_path);

				$data["imagem"] = "/public/images/chamados/" . $file_name;
			}
			else
			{
				unset($data["imagem"]);
			}

			// retirando os campos urgencia e impacto do $data


			if(empty($data["chamado_id"]))
			{
				$data["id_user_id"] = $this->session->userdata("user_id");
				date_default_timezone_set('America/Sao_Paulo');
				$data["data_criacao"] = date('Y-m-d H:i:s');
				$data["status"] = 1;

				$this->chamados_model->insert($data);
			}
			else
			{
				$chamado_id = $data["chamado_id"];
				unset($data["chamado_id"]);
				$this->chamados_model->update($chamado_id, $data);
			}

		}

		echo json_encode($json);

	}


public function ajax_contesta_chamado()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("users_model");
		$this->load->model("chamados_model");

		$data = $this->input->post();

		if (empty($data["contesta"]))
		{
			$json["error_list"]["#problema"] = "Contestação é obrigatório";
		}


		if (!empty($json["error_list"]))
		{
			$json["status"] = 0;
		}
		else
		{	

			$chamado_id = $data["chamado_id_contesta"];
			$data["status"] = 5;
			unset( $data["chamado_id_contesta"]);
			$this->chamados_model->update($chamado_id, $data);


		}

		echo json_encode($json);

	}

	

	public function ajax_list_chamado()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$this->load->model("chamados_model");
		$chamados = $this->chamados_model->get_datatable();
		// $usuarios = array("user" => $dados);

		$data = array();
		foreach ($chamados as $chamado) {
		
			$row = array();
			$row[] = $chamado->chamado_id;
			$row[] = $chamado->id_user_id;
	   		$row[] = date("d/m/Y H:i:s", strtotime($chamado->data_criacao));
	   		$row[] = $chamado->problema;
	   		$row[] = $chamado->tipo;
	   		$row[] = $chamado->setor;



			if($chamado->prioridade == 1)
			{
				$row[] = "Altíssima";
			}
			else if($chamado->prioridade == 2)
			{
				$row[] = "Alta";
			}
			else if($chamado->prioridade == 3)
			{
				$row[] = "Média";
			}
			else if($chamado->prioridade == 4)
			{
				$row[] = "Baixa";
			}

			
			if ($chamado->status == 1) {
				$row[] = "Aberto";
				$row[] = '<div  class="acoes form-row">
							&nbsp;&nbsp;&nbsp;&nbsp;<a  style="cursor: pointer;"  class="btn-ver-chamado" title="Clique para ver detalhes" id="btn-visualizar-chamado" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-paper"></i></p></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a style="cursor: pointer;" class="btn-fecha_chamado" title="Clique para marcar chamado como resolvido" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-check-2"></i></p></a>
						</div>';
			}
			else if ($chamado->status == 2) {
				$row[] = "Em andamento";
				$row[] = '<div  class="acoes form-row">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  style="cursor: pointer;"  class="btn-ver-chamado" title="Clique para ver detalhes" id="btn-visualizar-chamado" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-paper"></i></p></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a style="cursor: pointer;" class="btn-fecha_chamado" title="Clique para marcar chamado como resolvido" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-check-2"></i></p></a>

						</div>';
			}
			else if ($chamado->status == 3) {
				$row[] = "Concluído";
				$row[] = '<div  class="acoes form-row">
							<a  style="cursor: pointer;"  class="btn-ver-chamado" title="Clique para ver detalhes" id="btn-visualizar-chamado" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-paper"></i></p></a>&nbsp;&nbsp;
							<a  style="cursor: pointer;"  class="btn-contesta" title="Clique para contestar conclusão" id="btn-edit-chamado" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-alert-circle-exc"></i></p></a>&nbsp;&nbsp;
							<a style="cursor: pointer;" class="btn-fecha_chamado" title="Clique para marcar chamado como resolvido" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-check-2"></i></p></a>
							
						</div>';
			}
			else if ($chamado->status == 4) {
				$row[] = "Resolvido";
				$row[] = '<div class="acoes form-row">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  style="cursor: pointer;"  class="btn-ver-chamado" title="Clique para ver detalhes" id="btn-visualizar-chamado" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-paper"></i></p></a>
						</div>';
			}
			else if ($chamado->status == 5) {
				$row[] = "Contestado";
				$row[] =  '<div  class="acoes form-row">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  style="cursor: pointer;"  class="btn-ver-chamado" title="Clique para ver detalhes" id="btn-visualizar-chamado" chamado_id="'.$chamado->chamado_id.'"><p><i class="tim-icons icon-paper"></i></p></a>
						</div>';
			}
			

			$data[] =  $row;

		}


		$json = array(
				"draw" => $this->input->post("draw"),
				"recordsTotal" => $this->chamados_model->records_total(),
				"recordsFiltered" => $this->chamados_model->records_filtered(),
				"data" => $data
		);

		echo json_encode($json);


	}

	public function ajax_get_chamado_data()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();


		$this->load->model("chamados_model");
		
		$chamado_id = $this->input->post("chamado_id");
		$data = $this->chamados_model->get_data($chamado_id)->result_array()[0];
		$json["input"]["chamado_id"] = $data["chamado_id"];
		$json["input"]["problema"] = $data["problema"];
		$json["input"]["setor"] = $data["setor"];
		$json["input"]["status"] = $data["status"];
		$json["input"]["tipo"] = $data["tipo"];
		$json["input"]["urgencia"] = $data["urgencia"];
		$json["input"]["impacto"] = $data["impacto"];
		$json["input"]["descricao"] = $data["descricao"];

		$json["img"]["imagem"] = base_url() .$data["imagem"];


		echo json_encode($json);

	}

	public function ajax_get_chamado_data_contesta()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();


		$this->load->model("chamados_model");
		
		$chamado_id = $this->input->post("chamado_id");
		$data = $this->chamados_model->get_data($chamado_id)->result_array()[0];
		$json["input"]["chamado_id_contesta"] = $data["chamado_id"];


		echo json_encode($json);

	}

	public function ajax_get_chamado_detalhes()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();


		$this->load->model("chamados_model");
		
		$chamado_id = $this->input->post("chamado_id");
		$data = $this->chamados_model->get_data($chamado_id)->result_array()[0];
		$json["input"]["numero_list"] = $data["chamado_id"];
		$json["input"]["problema_list"] = $data["problema"];
		$json["input"]["setor_list"] = $data["setor"];
		$json["input"]["responsavel_list"] = $data["id_user_id"];
		$json["input"]["data_abertura_list"] = date("d/m/Y H:i:s", strtotime($data["data_criacao"]));
		if (isset($data["data_fechamento"])) {
			$json["input"]["data_solucao_list"] = date("d/m/Y H:i:s", strtotime($data["data_fechamento"]));
		}		
		$json["input"]["tipo_list"] = $data["tipo"];
		$json["input"]["urgencia_list"] = $data["urgencia"];
		$json["input"]["impacto_list"] = $data["impacto"];
		$json["input"]["contesta_list"] = $data["contesta"];
		if ($data["prioridade"] == 1) {
			$json["input"]["prioridade_list"] = "Altíssima";
		}
		else if ($data["prioridade"] == 2) {
			$json["input"]["prioridade_list"] = "Alta";
		}
		else if ($data["prioridade"] == 3) {
			$json["input"]["prioridade_list"] = "Média";
		}
		else if ($data["prioridade"] == 4) {
			$json["input"]["prioridade_list"] = "Baixa";
		}

		if ($data["status"] == 1) {
			$json["input"]["status_list"] = "Aberto";
		}
		else if ($data["status"] == 2) {
			$json["input"]["status_list"] = "Em andamento";
		}
		else if ($data["status"] == 3) {
			$json["input"]["status_list"] = "Concluído";
		}
		else if ($data["status"] == 4) {
			$json["input"]["status_list"] = "Resolvido";
		}
		else if ($data["status"] == 5) {
			$json["input"]["status_list"] = "Contestado";
		}
		
		$json["input"]["descricao_list"] = $data["descricao"];
		$json["a"]["link_img"] = $data["imagem"];

		$json["img"]["imagem"] = base_url() .$data["imagem"];


		echo json_encode($json);

	}

	public function ajax_fecha_chamado()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["input"] = array();
		$data = array();
		$data["status"] = 4;
		$data["data_fechamento"] = date('Y-m-d H:i:s');

		$this->load->model("chamados_model");
		
		$chamado_id = $this->input->post("chamado_id");
		$this->chamados_model->update($chamado_id, $data);

		echo json_encode($json);

	}

	public function ajax_concluir_chamado()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("Voce nao tem permissao para acessar este ambiente!");
		}

		$json = array();
		$json["input"] = array();
		$data = array();
		$data["status"] = 3;

		$this->load->model("chamados_model");
		
		$chamado_id = $this->input->post("chamado_id");
		$this->chamados_model->update($chamado_id, $data);

		echo json_encode($json);

	}





}
