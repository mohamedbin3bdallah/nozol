<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

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
		parent::__construct();
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
		if(strpos($this->loginuser->privileges, ',svsee,') !== false && in_array('SV',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->id] = $employee->username; }
		$data['preporders'] = $this->Admin_mo->getjoinLeft('services.*,sv_d.id as sv_d_id,sv_d.title as title,langs.title as lang','sv_d',array('services'=>'sv_d.service = services.id','langs'=>'sv_d.code = langs.code'),array());
		if(!empty($data['preporders']))
		{
			for($i=0;$i<count($data['preporders']);$i++)
			{
				//$data['orders'][$data['preporders'][$i]->oid] = new stdClass();
				$data['services'][$data['preporders'][$i]->id]['id'] = $data['preporders'][$i]->id;
				$data['services'][$data['preporders'][$i]->id]['uid'] = $data['preporders'][$i]->uid;
				$data['services'][$data['preporders'][$i]->id]['time'] = $data['preporders'][$i]->time;
				$data['services'][$data['preporders'][$i]->id]['active'] = $data['preporders'][$i]->active;
				$data['services'][$data['preporders'][$i]->id]['items'][$i]['id'] = $data['preporders'][$i]->sv_d_id;
				$data['services'][$data['preporders'][$i]->id]['items'][$i]['lang'] = $data['preporders'][$i]->lang;
				$data['services'][$data['preporders'][$i]->id]['items'][$i]['title'] = $data['preporders'][$i]->title;
			}
		}
		$this->load->view('calenderdate');
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/services',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'services';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',svadd,') !== false && in_array('SV',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['langs'] = $this->Admin_mo->getwhere('langs',array('active'=>'1'));
		if(!empty($data['langs']))
		{
			$this->load->view('headers/service-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/service-add',$data);
			$this->load->view('footers/service-add');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'services';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/services',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/services');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'services';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',svadd,') !== false && in_array('SV',$this->sections))
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$langs = $this->Admin_mo->getwhere('langs',array('active'=>'1')); foreach($langs as $lang) { $mylang[$lang->code] = $lang->title; }
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		//$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]|is_unique[categories.cgtitlear]');
		foreach(set_value('title') as $lang => $title) { $this->form_validation->set_rules('title['.$lang.']', $mylang[$lang] , 'trim|required|max_length[255]'); }
		if($this->form_validation->run() == FALSE)
		{
			$data['system'] = $this->mysystem;
			$data['langs'] = $this->Admin_mo->getwhere('langs',array('active'=>'1'));
			$this->load->view('headers/service-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/service-add',$data);
			$this->load->view('footers/service-add');
			$this->load->view('messages');
		}
		else
		{
			//foreach(set_value('lang') as $lang) { echo $lang; }
			$set_arr = array('uid'=>$this->session->userdata('uid'), 'active'=>set_value('active'), 'time'=>time());
			$id = $this->Admin_mo->set('services', $set_arr);
			if(empty($id))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('services/add', 'refresh');
			}
			else
			{
				foreach(set_value('title') as $lang => $title) { $sv_d = $this->Admin_mo->set('sv_d', array('service'=>$id, 'title'=>$title, 'code'=>$lang)); }
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('services', 'refresh');
			}
		}
		//redirect('services/add', 'refresh');
		}
		else
		{
		$data['title'] = 'services';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',svedit,') !== false && in_array('SV',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['service'] = $this->Admin_mo->getrow('services',array('id'=>$id));
		if(!empty($data['service']))
		{
			$data['langs'] = $this->Admin_mo->getwhere('langs',array('active'=>'1'));
			$sv_ds = $this->Admin_mo->getwhere('sv_d',array('service'=>$id));
			foreach($sv_ds as $sv_d) { $data['sv_ds'][$sv_d->code]['title'] = $sv_d->title; }
			$this->load->view('headers/service-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/service-edit',$data);
			$this->load->view('footers/service-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'services';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/services',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/services');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'services';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
	}
	
	public function editservice($id)
	{
		if(strpos($this->loginuser->privileges, ',svedit,') !== false && in_array('SV',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
				$this->config->set_item('language', $this->loginuser->lang);
				$langs = $this->Admin_mo->getwhere('langs',array('active'=>'1')); foreach($langs as $lang) { $mylang[$lang->code] = $lang->title; }
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			foreach(set_value('title') as $lang => $title) { $this->form_validation->set_rules('title['.$lang.']', $mylang[$lang] , 'trim|required|max_length[255]'); }
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['service'] = $this->Admin_mo->getrow('services',array('id'=>$id));
				$data['langs'] = $this->Admin_mo->getwhere('langs',array('active'=>'1'));
				$sv_ds = $this->Admin_mo->getwhere('sv_d',array('service'=>$id));
				foreach($sv_ds as $sv_d) { $data['sv_ds'][$sv_d->code] = $sv_d->title; }
				$this->load->view('headers/service-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/service-edit',$data);
				$this->load->view('footers/service-edit');
				$this->load->view('messages');
			}
			else
			{
				$update_array = array('uid'=>$this->session->userdata('uid'), 'active'=>set_value('active'), 'time'=>time());
				if($this->Admin_mo->update('services', $update_array, array('id'=>$id)))
				{
					$this->Admin_mo->del('sv_d', array('service'=>$id));
					foreach(set_value('title') as $lang => $title) { $sv_d = $this->Admin_mo->set('sv_d', array('service'=>$id, 'title'=>$title, 'code'=>$lang)); }
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('services', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('services', 'refresh');
		}
		//redirect('services', 'refresh');
		}
		else
		{
		$data['title'] = 'services';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',svdelete,') !== false && in_array('SV',$this->sections))
		{
		$service = $this->Admin_mo->getrow('services', array('id'=>$id));
		if(!empty($service))
		{
			$this->Admin_mo->del('services', array('id'=>$id));
			$this->Admin_mo->del('sv_d', array('service'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('services', 'refresh');
		}
		else
		{
			$data['title'] = 'services';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->load->view('headers/services',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/services');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'services';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/services',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/services');
		$this->load->view('messages');
		}
	}	
}