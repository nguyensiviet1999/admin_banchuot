<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function getTableByNameCore($table_name)
	{
		$this->db->select('*');
		$table_data = $this->db->get($table_name);
		$table_data = $table_data->result_array();
		return $table_data;
	}
	public function insertDataToTableCore($table_name,$data_insert)
	{
		$this->db->insert($table_name, $data_insert);
		return $this->db->insert_id();
	}
	public function deleteDataByDieuKienCore($table_name,$dieukien)
	{
		foreach ($dieukien as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->delete($table_name);
	}
	public function updateDataByDieuKienCore($table_name,$dieukien,$data_sua)
	{
		foreach ($dieukien as $key => $value) {
			$this->db->where($key, $value);
		}
		return $this->db->update($table_name, $data_sua);
	}
}

/* End of file  */
/* Location: ./application/models/ */
