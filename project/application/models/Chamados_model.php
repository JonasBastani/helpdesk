<?php 

class Chamados_model extends CI_Model {

	public function __construct() {
		parent:: __construct();
		$this->load->database();
		$this->load->library("session");
		
	}

	public function get_data($id, $select = NULL)
	{
		if (!empty($select))
		{
			$this->db->select($select);
		}
		$this->db->from("chamados");
		$this->db->where("chamado_id", $id);
		return $this->db->get();
	}

	public function insert($data)
	{
		$this->db->insert("chamados", $data);
	}

	public function update($id, $data)
	{
		$this->db->where("chamado_id", $id);
		$this->db->update("chamados", $data);
	}

	public function desative_active($id, $data)
	{
		$this->db->where("chamado_id", $id);
		$this->db->update("chamados", $data);
	}

	public function dalete($id, $select = NULL)
	{

		$this->db->where("chamado_id", $id);
		$this->db->delete("chamados");
	}

	public function is_duplicated($field, $value, $id = NULL)
	{
		if (!empty($id))
		{
			$this->db->where("chamado_id <>", $id);			
		}
		$this->db->from("chamados");
		$this->db->where($field, $value);
		// return $this->db->get()->num_rows() > 0;
		if ($this->db->get()->num_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
 

	// fução PRIVADA para passar os parãmetros exigidos pelo DataTable, sem retorno
	private function _get_datatable() 
	{
		$column_search = array("chamado_id", "problema", "setor");
		$column_order = array("chamado_id","id_user_id", "data_criacao", "problema", "tipo", "setor", "prioridade", "status", "");
		$search = NULL;
		if ($this->input->post("search"))
		{
			$search = $this->input->post("search")["value"];
		}
		$order_column = NULL;
		$order_dir = NULL;
		$order = $this->input->post("order");
		if (isset($order))
		{
			$order_column = $order[0]["column"];
			$order_dir = $order[0]["dir"];
		}

		//$filtro =  $this->input->get("status_sl");


		$user = $this->session->userdata("user_id");
		$this->load->model("users_model");
		$permissao = $this->users_model->get_user_permissao($user);

		if($permissao == 0)
		{
			
			$this->db->from("chamados")
			->where("id_user_id", $user);
			
			
		}
		else
		{
			$this->db->from("chamados");
			
			
		}
		if(isset($search))
		{
			$first = TRUE;
			foreach ($column_search as $field) {
				if($first)
				{
					// começando um agrupamento de like
					$this->db->group_start();
					$this->db->like($field, $search);
					$first = FALSE;
				}
				else
				{
					$this->db->or_like($field, $search);
				}
			}
				
			
			if(!$first)
			{
				$this->db->group_end();
			}
		}

		if(isset($order))
		{
			$this->db->order_by($column_order[$order_column], $order_dir);
		}
	}


	// função para passar parametros de quantidade de linhas da tabela, além de retornar resultado
	public function get_datatable()
	{
		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$this->_get_datatable();
		if (isset($length) && $length != -1)
		{
			$this->db->limit($length, $start);
		}

		return  $this->db->get()->result();
		  
	}




	// função para calcular a quantidade de campos que foram filtrados e dar retorno as
	public function records_filtered()
	{
		$this->_get_datatable();

		return $this->db->get()->num_rows();
	}

	// função que retorna o número total de resultados
	public function records_total()
	{
		$this->db->from("chamados");
		return $this->db->count_all_results();
	}

}



