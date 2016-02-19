<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mails_Controller extends CI_Controller {
	 
	 private $config_default = array();
	 
	 public function __construct()
    {
		parent::__construct();
        $this->config_default = array(
			"table"=>"mails_in",
			"field"=>"date",
			"order"=>"desc",

			"num"=>4,
			"offset"=>0
		);
    }
	public function index($mails_type='in')
	{
		$this->config_default['table']="mails_".$mails_type;
		
		if($this->config_default['table']=="mails_in")
			$this->title="Входящие";
		elseif ($this->config_default['table']=="mails_out")
			$this->title="Отправленные";
		
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		{
			$this->config_default['order'] = $this->input->post('order');
			$this->config_default['field'] = $this->input->post('field');
			$data=$this->generate_table($this->config_default);
			$this->show('table_view',$data,true);
			exit;
		}
		else  
		{
			$result=$this->generate_table($this->config_default);
			$data['table']=$result['table'];
			$this->show('pages/table_view',$data,false);
		}

	}
	
	private function generate_table($config_set = array())
	{
		if ($config_set['field']=="mail"){
			$mail_class=$config_set['order'];
			$date_class="no";
		}
		elseif($config_set['field']=="date"){
			$date_class=$config_set['order'];
			$mail_class="no";
		}
		
       //pagination
        $mails_type=str_replace("mails_","",$this->config_default['table']);
        $config['base_url'] = base_url().'index.php/mails/'.$mails_type;
		$config['total_rows'] = $this->db->count_all($this->config_default['table']);
		$config['per_page'] = '4'; 

		$config['full_tag_open'] = "<p style='font-weight:bold;'>";
		$config['full_tag_close'] = '</p>';
		$config['first_link'] = 'В начало';
		$config['last_link'] = 'В конец';
		
		$this->pagination->initialize($config); 

        $config_set['num'] = $config['per_page'];
        $config_set['offset'] = $this->uri->segment(3);

		$mails = $this->get($config_set);
		
		//table
		$this->load->library('table');
		
		foreach ($mails as $key => $value){
			$checkbox['item']='<label><input type="checkbox" 
											 class="letter_delete" 
											 name="letter_delete[]" 
											 value="'.$mails[$key]['id'].'">
										<span></span>
								</label>';
			$mails[$key]=$checkbox+$mails[$key];
			unset($mails[$key]['id']);
			$mails[$key]['date']=date_format(date_create($mails[$key]['date']),'d-m-Y H:i');
		}

		$field_order=$this->session->userdata('field_order');	
		$table_style['table_open'] = '<table  class="table table-hover table-striped table_direction"  id="central_content" >';
		$this->table->set_template($table_style);
		
		$state="&#9660;";
		if($config_set['field']=="mail" && $config_set['order']=="asc")
			$state="&#9650;";
		
		if ($config_set['table']=="mails_in")
			$this->table->set_heading('<label><input type="checkbox" class="letter_delete_all"><span></span></label>',
										'Отправитель<span id="mail_order" class="'.$mail_class.'">'.$state.'</span>', 
										'Тема письма', 
										'<label class="'.$date_class.'">Дата получения</label>');
		elseif ($config_set['table']=="mails_out")
			$this->table->set_heading('<label><input type="checkbox" class="letter_delete_all"><span></span></label>',
										'Получатель<span id="mail_order" class="'.$mail_class.'">'.$state.'</span>',
										'Тема письма', 
										'<label  class="'.$date_class.'">Дата отправления</label>');
			
		$generate_table['table']=$this->table->generate($mails); 
		$generate_table['links'] = '<div id="pagination">'.$this->pagination->create_links().'</div>';
        
        return $generate_table;
		
	}
	private function get($config = array()){
		
        $this->load->model('Mails_Model');
        return $this->Mails_Model->get($config);
        
	}
	public function del(){
		
		$mails_for_del=$this->input->post('mails');	
		$this->config_default['table']="mails_".$this->input->post('mails_type');
		
		$this->load->model('Mails_Model');
		$result=$this->Mails_Model->delete_mails($this->config_default['table'],$mails_for_del);
		
		echo $result;
	}
	private function show($page,$data,$state){
		if(!$state){
			$this->load->view('templates/left_view');
			$this->load->view($page,$data);
			$this->load->view('templates/end_view');
		}
		else{
			echo $data['table']; 
			echo $data['links'];
		}	
	}
	public function view_mail($mails_type,$id_mail){
		$this->title="Просмотр письма";
		$table="mails_".$mails_type;
		
		$this->load->model('Mails_Model');
		$mails=$this->Mails_Model->view_mail($table,$id_mail);
		
		if($mails_type=="out"){
			$data['role']="Получатель";
			$_POST['mail_email']=$mails[0]['recipient'];
		}
		elseif ($mails_type=="in"){
			$data['role']="Отправитель";
			$_POST['mail_email']=$mails[0]['sender'];
		}
		
		$_POST['mail_theme']=$mails[0]['theme'];
		$_POST['mail_text']=$mails[0]['text'];
		$data['type_form']="view";
		$this->show('forms/form_view',$data,false);
	}
	public function write_mail(){
		$this->title="Написать письмо";
		
		$data['role']="Получатель";

		if($this->input->post('mail_send')){
			$check=$this->form_validation();
			if($check){
				$mail_send=$this->mail_send();
				if($mail_send){
					
					$this->load->model('Mails_Model');
					$mails=$this->Mails_Model->mail_send($mail_send);
					
					$mail_send_message['message']="Письмо отправлено!";
					$this->show('pages/send_message_view',$mail_send_message,false);
				}
				else{
					$mail_send_message['message']="Письмо не удалось отправить!";
					$this->show('pages/send_message_view',$mail_send_message,false);	
				}
			}
			else
				$this->show('forms/form_view',$data,false);
		}
		else
			$this->show('forms/form_view',$data,false);
	}
	private function form_validation(){
		$this->load->library('form_validation');
		$add_rules=array(
						array(
							'field' => 'mail_email',
							'label' => 'Получатель',
							'rules' => 'trim|required|valid_email'
						),
						array(
							'field' => 'mail_theme',
							'label' => 'Тема письма',
							'rules' => 'trim|required|max_length[100]'
						),
						array(
							'field' => 'mail_text',
							'label' => 'Текст письма',
							'rules' => 'trim|required'
						)
			);
			
		$this->form_validation->set_rules($add_rules);
		$check=$this->form_validation->run();
		return $check;
	}
	private function mail_send(){
		$mail_send['recipient']=$this->input->post('mail_email');
		$mail_send['theme']=$this->input->post('mail_theme');
		$mail_send['date']=date("Y-m-d H:i:s");
		$mail_send['text']=$this->input->post('mail_text');
		
		$this->load->library('email');
		$this->email->from('anastasiia.rashavchenko@gmail.com', 'Stacey');
		$this->email->to($mail_send['recipient']); 
		$this->email->cc($mail_send['recipient']); 
		$this->email->bcc($mail_send['recipient']); 
		$this->email->subject($mail_send['theme']);
		$this->email->message($mail_send['text']);	
		$send=$this->email->send();
		if($send)
			return $mail_send;
		else $send;
	}
}