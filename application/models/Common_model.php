<?php
class Common_Model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function insertData($table, $data)
	{
		$query = $this->db->insert($table, $data);
		if ($query) {
			return $this->db->insert_id();
		} else {
			return "0";
		}
	}

    public function updateData($table, $cond, $data)
	{
		$this->db->where($cond);
		$res = $this->db->update($table, $data);
		if ($res) {
			return 1;
		} else {
			return 0;
		}
	}

    public function getDataWhere($table, $select, $where)
	{
		$query = $this->db->select($select)->from($table)->where($where)->get();
		return ($query->num_rows() > 0) ? $query->row_array() : 0;
	}

	public function getAllDataWhere($table, $select, $where, $key = "", $orderBy = "desc")
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		if (isset($key) && !empty($key)) {
			$this->db->order_by($key, $orderBy);
		}
		$query = $this->db->get();
		return ($query->num_rows() > 0) ? $query->result_array() : 0;
	}
    
}
?>