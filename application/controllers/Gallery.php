<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");

	class Gallery extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(isset($this->session->userdata['school'])){

			}elseif(isset($this->session->userdata['teacher'])) {

			}else{
				redirect('/');
			}
			$this->load->library('upload');
		}

		function index()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	}
			if(isset($this->session->userdata['direct'])){

				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			}

			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];

			$gallery['image'] = $this->Gallery_model->image_gallery($school_AY_id,$employee_school_profile_id);
			$gallery['Album_name'] = $this->Gallery_model->image_gallery_album($school_AY_id,$employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['gallery'] = 'gallery';

			if (isset($this->session->userdata['school'])) {
				$this->load->view('School/school_header', $admin);
        	}elseif (isset($this->session->userdata['teacher'])) {
				$this->load->view('Teacher/teacher_header', $admin);
        	}
			$this->load->view('Gallery/gallery', $gallery);
			$this->load->view('Gallery/gallery_footer',$nav);
		} 

		function upload_gallery_images()
		{
			if($this->session->userdata('school')) {
				$school_admin = $this->session->userdata('school');
			}else {
				$school_admin = $this->session->userdata('teacher');
			}
			$gallery_album_name = $this->input->post('gallery_name');
		    $cpt = count($_FILES['userfile']['name']);
		    if($cpt != 0){
			    if (!is_dir("./Gallery_images/".$gallery_album_name)) {
					mkdir("./Gallery_images/".$gallery_album_name, 0755);
				}
			}
		    $su_count = 0;
		    $fa_count = 0;
		    $img_status = array();
		    $dataInfo = array();
		    $files = $_FILES;
		    $exists = array();

		    for($i=0; $i<$cpt; $i++)
		    {           
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

		        $filename1 = './Gallery_images/'.$files['userfile']['name'][$i];
		        if(file_exists($filename1))
		        {
		        	$exists[] = $files['userfile']['name'][$i];
		        	$fa_count++;
		        	$img_status['Fails'][]= base_url().'Gallery_images/'.$files['userfile']['name'][$i];
		        }
		        else
		        {
			        $this->upload->initialize($this->set_upload_options($gallery_album_name));
			        $this->load->library('upload','','catalogupload');  // Create custom object for catalog upload
				    $this->catalogupload->initialize($this->small_set_upload_options($gallery_album_name));
			        if($this->upload->do_upload() && $this->catalogupload->do_upload())
			        {
			        	$su_count++;
			        }
			        $dataInfo[] = $this->upload->data();
			        $smalldataInfo[] = $this->catalogupload->data();
			        $img_status['success'][]= base_url().'/Gallery_images/'.$files['userfile']['name'][$i];
		         	$data = array(
				        'gallery_datetime' => date('Y-m-d H:i:s'),
				        'gallery_album_name' => $this->input->post('gallery_name'),
				        'gallery_small' =>   base_url().'Gallery_images/'.$gallery_album_name.'/'.$dataInfo[$i]['file_name'],
				        'gallery_big' =>   base_url().'Gallery_images/'.$gallery_album_name.'/'.$dataInfo[$i]['file_name'],
				        'gallery_effective_date' => date('Y-m-d H:i:s'),
				        'gallery_expiry_date' => '9999-12-31',
				        'gallery_added_by_user' => $school_admin[0]['employee_profile_id'],
				        'gallery_added_by_user_type' => $school_admin[0]['employee_type'],
				        'gallery_AY_id' => $school_admin[0]['school_AY_id'],
				        'gallery_school_profile_id' => $school_admin[0]['employee_school_profile_id'],
				    );
	     			$result_set = $this->Gallery_model->gallery($data);
		        }
		    }
		    // echo "<pre>";
		    // print_r($dataInfo);
		    // print_r($smalldataInfo);die();
		    $this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Gallery Image Added Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('Gallery');
		    // $file_status['fails'] = $fa_count;
		    // $file_status['success'] = $su_count;
		    // echo "data==========";
		    // echo "<pre>";
		    // print_r($dataInfo);
		    // print_r($img_status);
		    // return $img_status;

		}

		private function set_upload_options($gallery_album_name)
		{   
		    $config = array();
		    $config['upload_path'] = './Gallery_images/'.$gallery_album_name.'/';
		    $config['allowed_types'] = 'gif|jpg|png';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $config['encrypt_name']     = TRUE;

		    return $config;
		}

		private function small_set_upload_options($gallery_album_name)
		{   
		    $config = array();
		    $config['upload_path'] = './Gallery_images/'.$gallery_album_name.'/';
		    $config['allowed_types'] = 'gif|jpg|png';
		    $config['max_size'] = '1000';
		    $config['max_width'] = '516';
		    $config['max_height'] = '324';
		    $config['overwrite']     = FALSE;
		    $config['encrypt_name']     = TRUE;

		    return $config;
		}

		public function img_link($image_cat)	
		{ 

			$this->session->set_flashdata('img_cat',$image_cat);
			redirect('gallery/img_link_new');
		}

		public function img_link_new()	
		{ 
			if($this->session->userdata('school')) {
				$school_admin = $this->session->userdata('school');
			}else {
				$school_admin = $this->session->userdata('teacher');
			}
			$data['image_cat'] = $this->session->flashdata('img_cat');
			$gallery['image_cate_name'] = $this->session->flashdata('img_cat');

			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			}
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			
			$data['school_id'] = $school_admin[0]['employee_school_profile_id'];
			$gallery['image'] = $this->Gallery_model->gallery_cat($data);
			$gallery['Album_name'] = $this->Gallery_model->image_gallery_album($school_AY_id,$employee_school_profile_id);
			$gallery['image_cat'] = $this->Gallery_model->image_gallery($school_AY_id,$employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['gallery'] = 'gallery';

			
			$this->load->view('School/school_header',$admin);
			$this->load->view('Gallery/gallery_pic_view', $gallery);
			$this->load->view('Gallery/gallery_footer',$nav);
		}
	}
 ?>