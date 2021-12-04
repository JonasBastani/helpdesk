<?php 

class Users_model extends CI_Model {

	public function __construct() {
		parent:: __construct();
		$this->load->database();
		
	}

	public function get_user_data($email) {
		$this->db
			->select("user_id, email, senha_hash, nome_completo, permissao, ativo")
			->from("usuarios")
			->where("email", $email);

		$result = $this->db->get();

		if ($result->num_rows() > 0)
		{
			return $result->row();
		}
		else
		{
			return NULL;	
		}
	}

	public function get_user_permissao($user_id) {
		$this->db
			->select("permissao")
			->from("usuarios")
			->where("user_id", $user_id);

		$result = $this->db->get();

		if ($result->num_rows() > 0)
		{
			return $result->row()->permissao;
		}
		else
		{
			return NULL;	
		}
	}

	public function get_user_nome($user_id) {
		$this->db
			->select("nome_completo")
			->from("usuarios")
			->where("user_id", $user_id);

		$result = $this->db->get();

		if ($result->num_rows() > 0)
		{
			return $result->row();
		}
		else
		{
			return NULL;	
		}
	}

	public function get_data($id, $select = NULL)
	{
		if (!empty($select))
		{
			$this->db->select($select);
		}
		$this->db->from("usuarios");
		$this->db->where("user_id", $id);
		return $this->db->get();
	}

	public function insert($data)
	{
		$this->db->insert("usuarios", $data);
	}

	public function update($id, $data)
	{
		$this->db->where("user_id", $id);
		$this->db->update("usuarios", $data);
	}

	public function desative_active($id, $data)
	{
		$this->db->where("user_id", $id);
		$this->db->update("usuarios", $data);
	}

	public function dalete($id, $select = NULL)
	{

		$this->db->where("user_id", $id);
		$this->db->delete("usuarios");
	}

	public function is_duplicated($field, $value, $id = NULL)
	{
		if (!empty($id))
		{
			$this->db->where("user_id <>", $id);			
		}
		$this->db->from("usuarios");
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
		$column_search = array("user_id","nome_completo");
		$column_order = array("user_id","nome_completo", "", "permissao", "ativo", "");
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

		$this->db->from("usuarios");
		if(isset($search))
		{
			$first = TRUE;
			foreach ($column_search as $field) {
				if($first)
				{
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


	// função para passar parametros de quantidade de linhas da tabela, além de retornar resultado  .dcd
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
		$this->db->from("usuarios");
		return $this->db->count_all_results();
	}

}



