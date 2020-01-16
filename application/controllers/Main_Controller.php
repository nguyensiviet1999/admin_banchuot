 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_Model');
	}

	public function index()
	{
		$this->load->view('Main_view');
	}
	public function showChuotTable()
	{
		$view['view'] = 'showChuotTable_view';
		$view['data']=[];
		$this->load->view('Main_view',$view);
	}
	public function DataTableForChuot()
	{
		$table_name = 'chuot';
		$search = $this->input->post('search');
		$length = $this->input->post('length');
		$order = $this->input->post('order');
		$fieldName = $this->input->post('fieldName');
		$start = $this->input->post('start');
		$thamsoGetData = [
			'table_name' =>$table_name,
			'fieldName' => $fieldName,
			'search'=> $search,
			'length'=> $length,
			'order' => $order,
			'start' => $start
		];
		$dataFilterLimit = $this->Main_Model->getDataForDataTable($thamsoGetData);
		$all_row = $this->Main_Model->countAll($table_name);
		$thamsoCountFilter = [
			'table_name' =>$table_name,
			'fieldName' => $fieldName,
			'search'=> $search,
			'length'=> $length,
			'order' => $order,
		];
		$row_filter = $this->Main_Model->countFilter($thamsoCountFilter);
		$dataAjax = [];
		foreach ($dataFilterLimit as $valueData) {
			$dataChildren = [];
			foreach ($fieldName as $valueField) {
				array_push($dataChildren,$valueData[$valueField]);
			}
			array_push($dataChildren,'<a data-machuot="'.$valueData['machuot'].'" class="btn btn-warning sua"><i class="fa fa-pencil"></i></a><a class="btn btn-danger xoa"><i class="fa fa-trash"></i></a>');
			array_push($dataChildren,'<input hidden="" class="machuot" type="text" value="'.$valueData['machuot'].'">');
			array_push($dataAjax, $dataChildren);
		}
		$ajax_dataTableProcessing = array(
			'draw' => intval($this->input->post('draw')),
			'recordsTotal' => $all_row,
			'recordsFiltered' => $row_filter,
			'data' => $dataAjax
		);
		echo json_encode($ajax_dataTableProcessing);
	}
	public function quanLyChuot()
	{
		$view['view'] = 'quanLyChuot_view';
		$view['data']['chuot'] = $this->Main_Model->getDataChuotTable();
		$this->load->view('Main_view',$view);
		
	}
	public function getDataOfTableChuotByID()
	{
		$machuot = $this->input->post('machuot');
		echo json_encode($this->Main_Model->getDataOfTableChuotByID($machuot));
	}
	public function updateData($table_name="")
	{
		$data_sua = $this->input->post('data_sua');
		$data_sua = json_decode($data_sua,true);		
		$dieukien = $this->input->post('dieukien');
		$dieukien = json_decode($dieukien,true);
		$success = $this->Main_Model->updateDataByDieuKienCore($table_name,$dieukien,$data_sua);
		echo $this->notification($success);
	}
	public function getAllDataByTableName()
	{
		$allData = [];
		$table_name = $this->input->post('table_name');
		foreach ($table_name as $value) {
			$allData[$value] = $this->Main_Model->getTableByNameCore($value);
		}
		echo json_encode($allData);
	}
	public function validateInsert()
	{
		$this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('tenchuot', 'Tên chuột', 'required|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('giamuavao', 'Giá mua vào', 'required|greater_than[0]',
        	array(
                'required'      => 'You have not provided %s.',
        	)
    	);
        $this->form_validation->set_rules('soluongtrongkho', 'Số lượng trong kho', 'required|is_natural|greater_than[0]',
        	array(
                'required'      => 'You have not provided %s.',
                'is_natural'     => 'TRường %s bắt buộc nhập số nguyên lớn hơn 0.'
        	)
        );
        if ($this->form_validation->run() == FALSE)
        {
          	echo "<div class='alert alert-danger'>".validation_errors()."</div>";
        }
        else
        {
        	echo "success";
        }
	}
	public function getDataForSelect2()
	{
		$search = $this->input->post('search');
		$table_name = $this->input->post('table_name');
		$fieldData = $this->input->post('fieldData');
		$result = $this->Main_Model->getDataForSelect2($table_name,$search);
		$data = [];
		foreach ($result as $value) {
			$subData = [];
			$subData['id'] = $value[$fieldData[0]];
			$subData['text'] = $value[$fieldData[1]];
			array_push($data, (object)$subData);
		}
		echo json_encode($data);
	}
}

/* End of file Main_Controller.php */
/* Location: ./application/controllers/Main_Controller.php */
