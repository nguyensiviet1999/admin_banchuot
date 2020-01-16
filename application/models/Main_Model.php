<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Model extends MY_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function getDataForDataTable($thamsoGetData)
	{
		$this->db->select('*');
		$this->db->join('hangsx', 'hangsx.id_hangsx = chuot.id_hangsx', 'inner');
		$this->db->join('nhacungcap', 'nhacungcap.manhacungcap = chuot.manhacungcap', 'inner');
		$this->db->join('loaichuot', 'loaichuot.id_loaichuot = chuot.id_loaichuot', 'inner');
		$this->db->join('kichco', 'kichco.id_kichco = chuot.id_kichco', 'inner');
		if (!empty(($thamsoGetData['search']))) {
			$this->db->like($thamsoGetData['fieldName'][0], $thamsoGetData['search']['value']);
			for ($i = 1; $i < count($thamsoGetData['fieldName']); $i++) {
				$this->db->or_like($thamsoGetData['fieldName'][$i], $thamsoGetData['search']['value']);
			}
		}
		if (!empty($thamsoGetData['order'])) {
			$this->db->order_by($thamsoGetData['fieldName'][$thamsoGetData['order'][0]['column']], $thamsoGetData['order'][0]['dir']);
		}
		$data_filter = $this->db->get($thamsoGetData['table_name'],$thamsoGetData['length'],$thamsoGetData['start']);
		return $data_filter->result_array();
	}
	public function countAll($table_name)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		return $this->db->count_all_results();
	}
	public function countFilter($thamsoCountFilter)
	{
		$this->db->select('*');
		$this->db->from($thamsoCountFilter['table_name']);
		$this->db->join('hangsx', 'hangsx.id_hangsx = chuot.id_hangsx', 'inner');
		$this->db->join('nhacungcap', 'nhacungcap.manhacungcap = chuot.manhacungcap', 'inner');
		$this->db->join('loaichuot', 'loaichuot.id_loaichuot = chuot.id_loaichuot', 'inner');
		$this->db->join('kichco', 'kichco.id_kichco = chuot.id_kichco', 'inner');
		if (!is_null($thamsoCountFilter['search'])) {
			$this->db->like($thamsoCountFilter['fieldName'][0], $thamsoCountFilter['search']['value']);
			for ($i = 1; $i < count($thamsoCountFilter['fieldName']); $i++) {
				$this->db->or_like($thamsoCountFilter['fieldName'][$i], $thamsoCountFilter['search']['value']);
			}
		}
		if (!is_null($thamsoCountFilter['order'])) {
			$this->db->order_by($thamsoCountFilter['fieldName'][$thamsoCountFilter['order'][0]['column']], $thamsoCountFilter['order'][0]['dir']);
		}
		return $this->db->count_all_results();
	}
	public function getDataChuotTable()
	{
		$this->db->select('*');
		$this->db->from('chuot');
		$this->db->join('hangsx', 'hangsx.id_hangsx = chuot.id_hangsx', 'left');
		$this->db->join('nhacungcap', 'nhacungcap.manhacungcap = chuot.manhacungcap', 'left');
		$this->db->join('loaichuot', 'loaichuot.id_loaichuot = chuot.id_loaichuot', 'left');
		$this->db->join('kichco', 'kichco.id_kichco = chuot.id_kichco', 'left');
		$data_filter = $this->db->get();
		return $data_filter->result_array();
	}
	public function getDataOfTableChuotByID($machuot)
	{
		$this->db->select('*');
		$this->db->from('chuot');
		$this->db->where('machuot', $machuot);
		return $this->db->get()->result_array();
	}
	public function getDataForSelect2($table_name,$search)
	{
		$fieldSearch = $table_name;
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->like($fieldSearch, $search, 'BOTH');
		$result = $this->db->get();
		return $result->result_array();
	}
}
