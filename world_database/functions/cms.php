<?php
class cms
{
	private $db = '';
	public $file = array();
	public $id = '';
	
	public function __construct() {
		global $db;
		$this->db = $db;
		$this->country='88';
	}
		
	public function contactussave() {
		
			
			$result = $this->db->query("INSERT INTO roo_contactus (name,email,subject, message, ipaddr, date_added) VALUES ('".$this->name."','".$this->email."', '".$this->subject."','".$this->message."', '".$this->ipaddr."','".DATETIME24H."')");
			if($result) {
				
				return true;
			} else {
				
				return false;
			}
		
		return false;
	}
	
	
	public function advertisesave() {
		
		    if($this->email_status=='1')
			{
				$org_filename = $this->resume['name'];
				$extn = pathinfo($org_filename, PATHINFO_EXTENSION);
				$path = DOCUMENT_PATH . "uploads/resume/";
				$filehash = randomString(20);
			   $filename = $filehash .".". $extn;
				$destination = $path . $filename;
				@move_uploaded_file($this->resume['tmp_name'], $destination);
				
				$result = $this->db->query("INSERT INTO roo_advertise_request (email_status,filename,experience,email,alternate_email,alternate_mobile,qualification,aadhar_no,dob,cdob,contact_person, mobile,address1,address2,country,state,city,pincode, ipaddr, date_added,status) VALUES ('1','".$filename."','".$this->experience."','".$this->email."', '".$this->aemail."','".$this->amobile."','".$this->qualification."','".$this->aadhar."','".$this->dob."','".$this->cdob."','".$this->contact_person."','".$this->mobile."','".$this->address1."','".$this->address2."','".$this->country."','".$this->state."','".$this->city."','".$this->pincode."', '".$this->ipaddr."','".DATETIME24H."','0')");
				
			}else{	
		
			
			$result = $this->db->query("INSERT INTO roo_advertise_request (email_status,company_name,email,contact_person, mobile,address1,address2,country,state,city,pincode, ipaddr, date_added,status) VALUES ('0','".$this->companyname."','".$this->email."', '".$this->contact_person."','".$this->mobile."','".$this->address1."','".$this->address2."','".$this->country."','".$this->state."','".$this->city."','".$this->pincode."', '".$this->ipaddr."','".DATETIME24H."','0')");
			}
			if($result) {
				
				return true;
			} else {
				
				return false;
			}
		
		return false;
	}
	
	
	public function getcms($id,$field) {
		if($id > 0) {
			$qry = $this->db->query("SELECT * FROM roo_cms WHERE id='".$id."'");
			$row = $this->db->fetch_array($qry);
			
			return $row[$field];
			
		}
		return false;
	}
	
	public function getsetting($id,$field) {
		if($id > 0) {
			$qry = $this->db->query("SELECT * FROM roo_settings WHERE id='".$id."'");
			$row = $this->db->fetch_array($qry);
			
			return $row[$field];
			
		}
		return false;
	}
	
	public function getoperator() {
		
		     $code="<option value=''>Select Operator</option>";
			$qry = $this->db->query("SELECT * FROM roo_mobile_operator where status='0'");
			$count=$this->db->num_rows($qry);
			$i=1;
			if($count>0)
			{
			while($row = $this->db->fetch_array($qry))
			{
			
			$code.="<option value='".$row['operator_code']."'>".$row['operator_name']."</option>";
			 
			$i++;
			}
			echo $code;
			}
			return false;
	}
	
}
?>