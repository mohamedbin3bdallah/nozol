<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertypes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
		parent::__construct();				$this->usertypes = array(1,2,3,4,5);
		$this->mysystem = $this->Admin_mo->getrow('system',array('id'=>'1'));
	    if(!$this->session->userdata('uid'))
	    { 
			redirect('home');
	    }
		else
		{
			$this->loginuser = $this->Admin_mo->getrowjoinLeftLimit('users.*,usertypes.privileges as privileges,langs.dir as dir','users',array('usertypes'=>'users.utid=usertypes.id','langs'=>'users.lang=langs.code'),array('users.id'=>$this->session->userdata('uid')),'');
			$this->sections = array();
			$sections = $this->Admin_mo->getwhere('sections',array('active'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->id] = $section->code; }
			}
		}
	}

	public function index()
	{
		if(strpos($this->loginuser->privileges, ',utsee,') !== false && in_array('UT',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->id] = $employee->username; }
		$data['usertypes'] = $this->Admin_mo->getwhere('usertypes',array('id != '=>'1'));
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/usertypes',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'usertypes';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',utadd,') !== false && in_array('UT',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/usertype-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/usertype-add',$data);
		$this->load->view('footers/usertype-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'usertypes';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',utadd,') !== false && in_array('UT',$this->sections))
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[255]|is_unique[usertypes.title]');
		$this->form_validation->set_rules('privileges[]', 'lang:privileges' , 'trim');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;
			$this->load->view('headers/usertype-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/usertype-add',$data);
			$this->load->view('footers/usertype-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('uid'=>$this->session->userdata('uid'), 'title'=>set_value('title'), 'active'=>set_value('active'), 'time'=>time());
			if(is_array(set_value('privileges'))) $set_arr['privileges'] = ','.implode(',',set_value('privileges')).','; else $set_arr['privileges'] = '';
			$id = $this->Admin_mo->set('usertypes', $set_arr);
			if(empty($id))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('usertypes/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('usertypes', 'refresh');
			}
		}
		//redirect('usertypes/add', 'refresh');
		}
		else
		{
		$data['title'] = 'usertypes';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',utedit,') !== false && in_array('UT',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['usertype'] = $this->Admin_mo->getrow('usertypes',array('id'=>$id));
		if(!empty($data['usertype']))
		{
			$this->load->view('headers/usertype-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/usertype-edit',$data);
			$this->load->view('footers/usertype-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'usertypes';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/usertypes',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/usertypes');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'usertypes';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
	}
	
	public function editusertype($id)
	{
		if(strpos($this->loginuser->privileges, ',utedit,') !== false && in_array('UT',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('privileges[]', 'lang:privileges' , 'trim');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['usertype'] = $this->Admin_mo->getrow('usertypes',array('id'=>$id));
				$this->load->view('headers/usertype-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/usertype-edit',$data);
				$this->load->view('footers/usertype-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('usertypes','where id <> '.$id.' and title like "'.set_value('title').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('usertypes/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('uid'=>$this->session->userdata('uid'), 'title'=>set_value('title'), 'active'=>set_value('active'), 'time'=>time());
					if(is_array(set_value('privileges'))) $update_array['privileges'] = ','.implode(',',set_value('privileges')).','; else $update_array['privileges'] = '';
					if($this->Admin_mo->update('usertypes', $update_array, array('id'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('usertypes', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('usertypes', 'refresh');
		}
		//redirect('usertypes', 'refresh');
		}
		else
		{
		$data['title'] = 'usertypes';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',utdelete,') !== false && $id != '1' && in_array('UT',$this->sections) && !in_array($id,$this->usertypes))
		{
		$usertype = $this->Admin_mo->getrow('usertypes', array('id'=>$id));
		if(!empty($usertype))
		{
			$this->Admin_mo->del('usertypes', array('id'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('usertypes', 'refresh');
		}
		else
		{
			$data['title'] = 'usertypes';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->load->view('headers/usertypes',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/usertypes');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'usertypes';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/usertypes',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/usertypes');
		$this->load->view('messages');
		}
	}
}