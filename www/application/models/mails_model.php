<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mails_Model extends CI_Model {
	
	public function get($config = array()){
        
		if ($config['table']=='mails_out') $field = 'recipient';
        else if ($config['table']=='mails_in') $field = 'sender'; 
		
		if($config['field']=="mail")
			$config['field']= $field;
        $this->db->select("id,$field,theme,DATE_FORMAT(date,'%Y-%m-%d %H:%i') as date");
        $this->db->order_by($config['field'], $config['order']); 
        $query = $this->db->get($config['table'],$config['num'],$config['offset']);
        return $query->result_array();
    }
	public function delete_mails($table,$mails){

		if (is_array($mails)){
			$this->db->where_in('id',$mails);
			$query=$this->db->delete($table);
		}elseif	($mails=="all")
			$query=$this->db-> empty_table($table);
		if (!$this->db->affected_rows())
			$result = 'Error! This row or rows not found';
		else
			$result='';
		return $result;
	}
	public function mail_send($mail_send)
	{
		$this->db->insert('mails_out',$mail_send);
	}
	public function view_mail($table,$id_mail)
	{	
		if ($table=="mails_in")
			$this->db->select('sender,theme,text');
		else if ($table=="mails_out")
			$this->db->select('recipient,theme,text');
		
		$this->db->where('id',$id_mail);
		$query=$this->db->get($table);
		
		return $query->result_array();
	}
}