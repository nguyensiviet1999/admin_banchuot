<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function notification($success)
	{
		if ($success) {
			return $success;
		}
		else{
			return 'Thất bại';
		}
	}
	public function insertToTable($table_name="")
	{
		$data_insert = $this->input->post('datatable');
		$data_insert = json_decode($data_insert,true);
		$id_insert = $this->Main_Model->insertDataToTableCore($table_name,$data_insert);
		echo $this->notification($id_insert);
	}
	public function deleteData($table_name="")
	{
		$dieukien = $this->input->post('dieukien');
		$dieukien = json_decode($dieukien,true);
		$success = $this->Main_Model->deleteDataByDieuKienCore($table_name,$dieukien);
		echo $this->notification($success);
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */
