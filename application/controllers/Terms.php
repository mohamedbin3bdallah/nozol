<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',tmsee,') !== false && in_array('TM',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->id] = $employee->username; }				$data['terms'] = $this->Admin_mo->getjoinLeft('terms.*,langs.title as lang','terms',array('langs'=>'terms.code = langs.code'),array());
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/terms',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'terms';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',tmadd,') !== false && in_array('TM',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['langs'] = $this->Admin_mo->getwhere('langs', array('active'=>'1'));
		$this->load->view('headers/term-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/term-add',$data);
		$this->load->view('footers/term-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'terms';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',tmadd,') !== false && in_array('TM',$this->sections))
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('lang', 'lang:lang' , 'trim|required|max_length[2]|is_unique[terms.code]');
		$this->form_validation->set_rules('desc', 'lang:desc' , 'required');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;						$data['langs'] = $this->Admin_mo->getwhere('langs', array('active'=>'1'));
			$this->load->view('headers/term-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/term-add',$data);
			$this->load->view('footers/term-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('uid'=>$this->session->userdata('uid'), 'code'=>set_value('lang'), 'desc'=>htmlspecialchars_decode(set_value('desc')), 'active'=>set_value('active'), 'time'=>time());
			$id = $this->Admin_mo->set('terms', $set_arr);
			if(empty($id))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('terms/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('terms', 'refresh');
			}
		}
		//redirect('terms/add', 'refresh');
		}
		else
		{
		$data['title'] = 'terms';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',tmedit,') !== false && in_array('TM',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['term'] = $this->Admin_mo->getrow('terms',array('id'=>$id));
		if(!empty($data['term']))
		{			$data['langs'] = $this->Admin_mo->getwhere('langs', array('active'=>'1'));
			$this->load->view('headers/term-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/term-edit',$data);
			$this->load->view('footers/term-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'terms';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/terms',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/terms');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'terms';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
	}
	
	public function editterm($id)
	{
		if(strpos($this->loginuser->privileges, ',tmedit,') !== false && in_array('TM',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('lang', 'lang:lang' , 'trim|required|max_length[2]');
			$this->form_validation->set_rules('desc', 'lang:desc' , 'required');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['term'] = $this->Admin_mo->getrow('terms',array('id'=>$id));								$data['langs'] = $this->Admin_mo->getwhere('langs',array('active'=>'1'));
				$this->load->view('headers/term-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/term-edit',$data);
				$this->load->view('footers/term-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('terms','where id <> '.$id.' and code like "'.set_value('lang').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'codeexist';
					redirect('terms/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('uid'=>$this->session->userdata('uid'), 'code'=>set_value('lang'), 'desc'=>htmlspecialchars_decode(set_value('desc')), 'active'=>set_value('active'), 'time'=>time());

					if($this->Admin_mo->update('terms', $update_array, array('id'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('terms', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('terms', 'refresh');
		}
		//redirect('terms', 'refresh');
		}
		else
		{
		$data['title'] = 'terms';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',tmdelete,') !== false && in_array('TM',$this->sections))
		{
		$term = $this->Admin_mo->getrow('terms', array('id'=>$id));
		if(!empty($term))
		{
			$this->Admin_mo->del('terms', array('id'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('terms', 'refresh');
		}
		else
		{
			$data['title'] = 'terms';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->load->view('headers/terms',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/terms');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'terms';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/terms',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/terms');
		$this->load->view('messages');
		}
	}
}