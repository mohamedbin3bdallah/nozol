<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Langs extends CI_Controller {

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
			$this->sections = array();						$this->docs_title = array(				'show' => array(array('selector'=>'.btn-primary','title'=>'add_new_language_button'),array('selector'=>'thead tr','title'=>'sort_table_by_column'),array('selector'=>'input[type="search"]','title'=>'search_any_data_from_table'),array('selector'=>'.files','title'=>'language_translation')),				'add' => array(array('selector'=>'#title','title'=>'title'),array('selector'=>'#code','title'=>'lang'),array('selector'=>'#dir','title'=>'dir')),				'edit' => array(array('selector'=>'#title','title'=>'title'),array('selector'=>'#code','title'=>'lang'),array('selector'=>'#dir','title'=>'dir')),			);
			$sections = $this->Admin_mo->getwhere('sections',array('active'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->id] = $section->code; }
			}
		}
	}

	public function index()
	{
		if(strpos($this->loginuser->privileges, ',lnsee,') !== false && in_array('LN',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->id] = $employee->username; }
		$data['langs'] = $this->Admin_mo->get('langs');				$data['docs_title'] = $this->docs_title['show'];
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/langs',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages',$data);
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',lnadd,') !== false && in_array('LN',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		//$data['users'] = $this->Admin_mo->get('users');				$data['docs_title'] = $this->docs_title['add'];
		$this->load->view('headers/lang-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/lang-add',$data);
		$this->load->view('footers/lang-add');
		$this->load->view('messages',$data);
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',lnadd,') !== false && in_array('LN',$this->sections))
		{
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('code', 'lang:code' , 'trim|required|max_length[2]|is_unique[langs.code]');
		$this->form_validation->set_rules('dir', 'lang:dir' , 'trim|required|max_length[3]');
		$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[100]');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			 $data['system'] = $this->mysystem;			 			 $data['docs_title'] = $this->docs_title['add'];
			$this->load->view('headers/lang-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/lang-add',$data);
			$this->load->view('footers/lang-add');
			$this->load->view('messages',$data);
		}
		else
		{
			if(!is_dir('application/language/'.set_value('code'))) { $create_director = mkdir('application/language/'.set_value('code')); copy('application/language/en/en_lang.php', 'application/language/'.set_value('code').'/'.set_value('code').'_lang.php'); }
			if(!is_dir('system/language/'.set_value('code'))) { $create_director = mkdir('system/language/'.set_value('code')); copy('system/language/en/form_validation_lang.php', 'system/language/'.set_value('code').'/form_validation_lang.php'); }
			$set_arr = array('uid'=>$this->session->userdata('uid'), 'title'=>set_value('title'), 'code'=>set_value('code'),  'dir'=>set_value('dir'), 'active'=>set_value('active'), 'time'=>time());
			$id = $this->Admin_mo->set('langs', $set_arr);
			if(empty($id))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('langs/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('langs', 'refresh');
			}
		}
		//redirect('langs/add', 'refresh');
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',lnedit,') !== false && in_array('LN',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['lang'] = $this->Admin_mo->getrow('langs',array('id'=>$id));
		if(!empty($data['lang']))
		{			$data['docs_title'] = $this->docs_title['edit'];
			$this->load->view('headers/lang-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/lang-edit',$data);
			$this->load->view('footers/lang-edit');
			$this->load->view('messages',$data);
		}
		else
		{
			$data['title'] = 'langs';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/langs',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/langs');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
	
	public function editlang($id)
	{
		if(strpos($this->loginuser->privileges, ',lnedit,') !== false && in_array('LN',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('code', 'lang:code' , 'trim|required|max_length[2]');
			$this->form_validation->set_rules('dir', 'lang:dir' , 'trim|required|max_length[3]');
			$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[100]');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;								$data['docs_title'] = $this->docs_title['edit'];
				$data['lang'] = $this->Admin_mo->getrow('langs',array('id'=>$id));
				$this->load->view('headers/lang-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/lang-edit',$data);
				$this->load->view('footers/lang-edit');
				$this->load->view('messages',$data);
			}
			else
			{
				if($this->Admin_mo->exist('langs','where id <> '.$id.' and code like "'.set_value('code').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('langs/edit/'.$id, 'refresh');
				}
				else
				{
					if(!is_dir('application/language/'.set_value('code'))) { $create_director = mkdir('application/language/'.set_value('code')); copy('application/language/en/en_lang.php', 'application/language/'.set_value('code').'/'.set_value('code').'_lang.php'); }
					if(!is_dir('system/language/'.set_value('code'))) { $create_director = mkdir('system/language/'.set_value('code')); copy('system/language/en/form_validation_lang.php', 'system/language/'.set_value('code').'/form_validation_lang.php'); }
					$update_array = array('uid'=>$this->session->userdata('uid'), 'title'=>set_value('title'), 'code'=>set_value('code'),  'dir'=>set_value('dir'), 'active'=>set_value('active'), 'time'=>time());
					if($this->Admin_mo->update('langs', $update_array, array('id'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('langs', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('langs', 'refresh');
		}
		//redirect('about', 'refresh');
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
	
	public function files($id)
	{
		if(strpos($this->loginuser->privileges, ',lnedit,') !== false && in_array('LN',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['lang'] = $this->Admin_mo->getrow('langs',array('id'=>$id));
		if(!empty($data['lang']))
		{
			$this->load->view('headers/files-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/files-edit',$data);
			$this->load->view('footers/files-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'langs';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/langs',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/langs');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
	
	public function editlangfile($id)
	{
		if(strpos($this->loginuser->privileges, ',lnedit,') !== false && in_array('LN',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			foreach(set_value('title') as $key => $title) { $this->form_validation->set_rules('title['.$key.']', 'lang:'.$key , 'required'); }
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['lang'] = $this->Admin_mo->getrow('langs',array('id'=>$id));
				$this->load->view('headers/files-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/files-edit',$data);
				$this->load->view('footers/files-edit');
				$this->load->view('messages');
			}
			else
			{
				$lang = $this->Admin_mo->getrow('langs',array('id'=>$id));
				$file = fopen('application/language/'.$lang->code.'/'.$lang->code.'_lang.php', 'w', 1);
				$t = '$';
				fwrite($file, '<?php');
				foreach(set_value('title') as $key => $title)
				{
					$text="\n".$t."lang['".$key."'] = '".$title."';";
					fwrite($file, $text); 
				}
				fwrite($file, "\n".'?>'); 
				fclose($file);
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('langs/files/'.$id, 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('langs', 'refresh');
		}
		//redirect('about', 'refresh');
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
	
	public function editvalidationlang($id)
	{
		if(strpos($this->loginuser->privileges, ',lnedit,') !== false && in_array('LN',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			foreach(set_value('title') as $key => $title) { $this->form_validation->set_rules('title['.$key.']', 'lang:'.$key , 'required'); }
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['lang'] = $this->Admin_mo->getrow('langs',array('id'=>$id));
				$this->load->view('headers/files-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/files-edit',$data);
				$this->load->view('footers/files-edit');
				$this->load->view('messages');
			}
			else
			{
				$lang = $this->Admin_mo->getrow('langs',array('id'=>$id));
				$file = fopen('system/language/'.$lang->code.'/form_validation_lang.php', 'w', 1);
				$t = '$';
				fwrite($file, '<?php');
				foreach(set_value('title') as $key => $title)
				{
					$text="\n".$t."lang['".$key."'] = '".$title."';";
					fwrite($file, $text); 
				}
				fwrite($file, "\n".'?>'); 
				fclose($file);
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('langs/files/'.$id, 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('langs', 'refresh');
		}
		//redirect('about', 'refresh');
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',lndelete,') !== false && in_array('LN',$this->sections))
		{
		$lang = $this->Admin_mo->getrow('langs', array('id'=>$id));
		if(!empty($lang))
		{
			$this->Admin_mo->del('langs', array('id'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('langs', 'refresh');
		}
		else
		{
			$data['title'] = 'langs';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->load->view('headers/langs',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/langs');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'langs';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/langs',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/langs');
		$this->load->view('messages');
		}
	}
}