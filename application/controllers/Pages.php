<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',pgsee,') !== false && in_array('PG',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->id] = $employee->username; }				$data['pages'] = $this->Admin_mo->getjoinLeft('pages.*,langs.title as lang','pages',array('langs'=>'pages.code = langs.code'),array());
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/pages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',pgadd,') !== false && in_array('PG',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['langs'] = $this->Admin_mo->getwhere('langs', array('active'=>'1'));
		$this->load->view('headers/page-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/page-add',$data);
		$this->load->view('footers/page-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',pgadd,') !== false && in_array('PG',$this->sections))
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('lang', 'lang:lang' , 'trim|required|max_length[2]');
		$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[255]');				$this->form_validation->set_rules('desc', 'lang:desc' , 'required');				if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) $this->form_validation->set_rules('img', 'lang:image' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;						$data['langs'] = $this->Admin_mo->getwhere('langs', array('active'=>'1'));
			$this->load->view('headers/page-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/page-add',$data);
			$this->load->view('footers/page-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('uid'=>$this->session->userdata('uid'), 'code'=>set_value('lang'), 'url'=>str_replace(' ','_',set_value('title')), 'title'=>set_value('title'), 'desc'=>htmlspecialchars_decode(set_value('desc')), 'active'=>set_value('active'), 'time'=>time());						if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) { $set_arr['img'] = $this->uploadimg('img',$this->config->item('pages_folder'),$this->config->item('pages_thumb_folder'),mt_rand()); };
			$id = $this->Admin_mo->set('pages', $set_arr);
			if(empty($id))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('pages/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('pages', 'refresh');
			}
		}
		//redirect('pages/add', 'refresh');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',pgedit,') !== false && in_array('PG',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$data['page'] = $this->Admin_mo->getrow('pages',array('id'=>$id));
		if(!empty($data['page']))
		{			$data['langs'] = $this->Admin_mo->getwhere('langs', array('active'=>'1'));
			$this->load->view('headers/page-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/page-edit',$data);
			$this->load->view('footers/page-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'pages';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/pages',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/pages');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}
	
	public function editpage($id)
	{
		if(strpos($this->loginuser->privileges, ',pgedit,') !== false && in_array('PG',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('lang', 'lang:lang' , 'trim|required|max_length[2]');
			$this->form_validation->set_rules('title', 'lang:title' , 'trim|required|max_length[255]');					$this->form_validation->set_rules('desc', 'lang:desc' , 'required');					if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) $this->form_validation->set_rules('img', 'lang:image' , 'callback_imageSize|callback_imageType');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['page'] = $this->Admin_mo->getrow('pages',array('id'=>$id));								$data['langs'] = $this->Admin_mo->getwhere('langs',array('active'=>'1'));
				$this->load->view('headers/page-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/page-edit',$data);
				$this->load->view('footers/page-edit');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('pages','where id <> '.$id.' and title like "'.set_value('title').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('pages/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('uid'=>$this->session->userdata('uid'), 'code'=>set_value('lang'), 'url'=>str_replace(' ','_',set_value('title')), 'title'=>set_value('title'), 'desc'=>htmlspecialchars_decode(set_value('desc')), 'active'=>set_value('active'), 'time'=>time());					if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) { $update_array['img'] = $this->uploadimg('img',$this->config->item('pages_folder'),$this->config->item('pages_thumb_folder'),mt_rand()); if($update_array['img'] != '' && set_value('oldimg') != '' && file_exists($this->config->item('pages_folder').set_value('oldimg'))) unlink($this->config->item('pages_folder').set_value('oldimg')); if($update_array['img'] != '' && set_value('oldimg') != '' && file_exists($this->config->item('pages_thumb_folder').set_value('oldimg'))) unlink($this->config->item('pages_thumb_folder').set_value('oldimg')); }

					if($this->Admin_mo->update('pages', $update_array, array('id'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('pages', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('pages', 'refresh');
		}
		//redirect('pages', 'refresh');
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',pgdelete,') !== false && in_array('PG',$this->sections))
		{
		$page = $this->Admin_mo->getrow('pages', array('id'=>$id));
		if(!empty($page))
		{
			$this->Admin_mo->del('pages', array('id'=>$id));						if($page->img != '' && file_exists($this->config->item('pages_folder').$page->img)) unlink($this->config->item('pages_folder').$page->img);			if(file_exists($this->config->item('pages_thumb_folder').$page->img)) unlink($this->config->item('pages_thumb_folder').$page->img);
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('pages', 'refresh');
		}
		else
		{
			$data['title'] = 'pages';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
			$this->config->set_item('language', $this->loginuser->lang);
			$this->load->view('headers/pages',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/pages');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'pages';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->loginuser->lang, $this->loginuser->lang);
		$this->config->set_item('language', $this->loginuser->lang);
		$this->load->view('headers/pages',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/pages');
		$this->load->view('messages');
		}
	}		public function imageSize()	{		if ($_FILES['img']['size'] > 1024000)		{			//$this->form_validation->set_message('imageSize', 'يجب ان يكون حجم الصورة 1 ميجا او اقل');			return FALSE;		}		else		{			return TRUE;		}	}	public function imageType()	{		if (!in_array(strtoupper(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)),array('JPG','JPEG','PNG','JIF','BMP','TIF')))		{			//$this->form_validation->set_message('imageType', 'يجب ان يكون نوع الملف المرفوع واحد من هذه الانواع : JPG,JPEG,PNG,JIF,BMP,TIF');			return FALSE;		}		else		{			return TRUE;		}	}	public function uploadimg($inputfilename,$image_director,$image_director_thumb,$newname)	{		$file_extn = pathinfo($_FILES[$inputfilename]['name'], PATHINFO_EXTENSION);		if(!is_dir($image_director)) $create_image_director = mkdir($image_director);		$name = $newname.".".$file_extn;		if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.$name))		{			if($image_director_thumb != '')			{				$this->load->library('Resize');				$this->resize->construct($image_director.$name);				$this->resize->resizeImage(275, 275, 'exact');				$this->resize->saveImage($image_director_thumb.$name, 100);			}			return $name;		}		else return '';	}
}