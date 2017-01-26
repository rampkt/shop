<?php
class dashboard
{
	private $db;
	
	public function __construct() {
		global $db;
		$this->db = $db;
	}
	
	public function totalCount() {
		$result = array();
		$result['country'] = $this->db->fetch_field("countries", "1", "COUNT(id) AS cnt");
		$result['state'] = $this->db->fetch_field("states", "1", "COUNT(id) AS cnt");
		$result['city'] = $this->db->fetch_field("cities", "1", "COUNT(id) AS cnt");
		
		return $result;
	}
	public function cms($cont) {
		//$result = array();
		$qry_scroll = $this->db->fetch_array($this->db->query("SELECT * FROM cms WHERE id='1'"));
		return $qry_scroll[$cont];
	}
	public function getsetting($id) {
		if($id > 0) {
			$qry = $this->db->query("SELECT * FROM settings WHERE id='".$id."'");
			$row = $this->db->fetch_array($qry);
			
			return $row;
			
		}
		return false;
	}
}
?>