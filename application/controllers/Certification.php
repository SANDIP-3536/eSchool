<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Certification extends CI_Controller
	{

		function index()
		{
			if(!isset($this->session->userdata['school']))
			{
				redirect('/');
			} 
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 
			$fee['flash']['active'] = $this->session->flashdata('active');
        	$fee['flash']['title'] = $this->session->flashdata('title');
        	$fee['flash']['text'] = $this->session->flashdata('text');
        	$fee['flash']['type'] = $this->session->flashdata('type');
        	
			$school_admin = $this->session->userdata('school');
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];

			$certification['class'] =  $this->db->query("SELECT * FROM class where class_school_profile_id = ".$employee_school_profile_id." and class_expiry_date='9999-12-31' GROUP BY class_name")->result_array();

			
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['certification'] = 'certification';

			// echo "<pre>"; print_r($certification);die();

			$this->load->view('School/school_header', $admin);
			$this->load->view('Certification/certification',$certification);
			$this->load->view('Certification/certification_footer',$nav);
		}
		function fetch_class_division()
		{
			$school_admin = $this->session->userdata('school');
			$class_id = $_POST['class_id'];
			$school_id = $school_admin[0]['employee_school_profile_id'];
			$data = $this->db->query("SELECT * FROM division where division_class_id =".$class_id." and division_school_profile_id =".$school_id." and division_expiry_date = '9999-12-31' GROUP BY division_name")->result_array();
			echo json_encode($data);
		}
		function fetch_class_division_student()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['class_id'] = $_POST['class_id'];
			$data = $this->db->query("SELECT * FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id where SCD_class_id =".$student['class_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31'")->result_array();
			echo json_encode($data);
		}
		function fetch_division_class_student()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['class_id'] = $_POST['class_id'];
			$student['division_id'] = $_POST['division_id'];
			$data = $this->db->query("SELECT * FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id where SCD_class_id =".$student['class_id']." and SCD_division_id =".$student['division_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31'")->result_array();
			echo json_encode($data);
		}
		function student_bonafide()
		{
			$student_profile_id = $_POST['student_profile_id'];
			$school_admin = $this->session->userdata('school');
			$school_id = $school_admin[0]['employee_school_profile_id'];
			
			$data['bonafide'] = $this->db->query("select student_profile_id,school_profile_id,school_AY_id,AY_name,student_GRN,CONCAT(Student_first_name,' ',student_middle_name,' ',student_last_name) as student_name,student_gender,student_DOB,student_birth_place,parent_profile_id,student_present_town as student_permament_town,student_present_tal as student_permament_tal,student_present_dist as student_permament_dist,student_nationality,CONCAT(parent_first_name,' ',parent_middle_name,' ',parent_last_name) as parent_name ,parent_mobile_number,school_bonafied_certificate_header,school_bonafied_certificate_footer ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name from student 				
										join school on student_school_profile_id=school_profile_id left join parent on parent_student_profile_id=student_profile_id  and parent_type = 1 left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' join academic_year on AY_id = school_AY_id where student_school_profile_id=".$school_id." and student_profile_id=".$student_profile_id."")->result_array();
			$data['date_in_text'] = date("M jS, Y", strtotime($data['bonafide'][0]['student_DOB']));
			$date = explode("-", date('Y-m-d'));
			$data['ref_no'] = "BC/".$data['bonafide'][0]['student_GRN']."-".$data['bonafide'][0]['school_profile_id'].$data['bonafide'][0]['class_id']."/".$date[1]."/".$data['bonafide'][0]['AY_name'];

			$add['ref_no'] = $data['ref_no'];
			$add['student_profile_id'] = $student_profile_id;
			$add['school_id'] = $school_id;
			$this->session->set_userdata('add_bonafide', $add);

			echo json_encode($data);
		}
		function add_bonafide()
		{
			$add = $this->session->userdata('add_bonafide');
			$reg_cnt = $this->db->where('doc_number', $add['ref_no'])->get('document')->num_rows();
			if ($reg_cnt == 0) 
			{
				
				$data1['doc_name'] = "Bonafide";
				$data1['doc_type'] = "1";
				$data1['doc_number'] = $add['ref_no'];
				$data1['doc_file'] = "";
				$data1['doc_effective_date'] = date('Y-m-d');
				$data1['doc_user'] = $add['student_profile_id'];
				$data1['doc_user_type'] = "8";
				$data1['doc_school_profile_id'] = $add['school_id'];

				$this->Student_model->student_document($data1);
			}
			echo json_encode($reg_cnt);
		}
		function student_details_LC()
		{
			$student_profile_id = $_POST['student_profile_id'];
			$school_admin = $this->session->userdata('school');
			$school_id = $school_admin[0]['employee_school_profile_id'];
			
			$data['LC'] = $this->db->query("select student_profile_id,school_profile_id,school_AY_id,AY_name,student_GRN,student_cast,student_sub_cast,student_privious_school_name,student_admission_date,student_progress,student_LC_date,student_LC_reason,student_remark,SCD_effective_date,CONCAT(Student_first_name,' ',student_middle_name,' ',student_last_name) as student_name,student_gender,student_DOB,student_birth_place,parent_profile_id,student_present_town as student_permament_town,student_present_tal as student_permament_tal,student_present_dist as student_permament_dist,student_nationality,student_religion,student_adhar_card_number,student_conduct,CONCAT(parent_first_name,' ',parent_middle_name,' ',parent_last_name) as parent_name ,parent_mobile_number,school_leaving_certificate_header,school_leaving_certificate_footer ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name from student 				
										join school on student_school_profile_id=school_profile_id left join parent on parent_student_profile_id=student_profile_id and parent_type = 2 left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' join academic_year on AY_id = school_AY_id where student_school_profile_id=".$school_id." and student_profile_id=".$student_profile_id."")->result_array();
			// $data['date_in_text'] = date("M jS, Y", strtotime($data['LC'][0]['student_DOB']));
			$date = explode("-", date('Y-m-d'));
			$data['LC_no'] = "LC/".$data['LC'][0]['student_GRN']."/".$data['LC'][0]['AY_name'];
			
			$dob = explode("-", $data['LC'][0]['student_DOB']);
			$data['dob_text'] = date("jS \of F Y", mktime(0,0,0,$dob[1],$dob[2],$dob[0]));

			$add['LC_no'] = $data['LC_no'];
			$add['student_profile_id'] = $student_profile_id;
			$add['school_id'] = $school_id;
			$this->session->set_userdata('add_LC', $add);

			echo json_encode($data);
		}

		function add_LC()
		{
			$add = $this->session->userdata('add_LC');
			$reg_cnt = $this->db->where('doc_number', $add['LC_no'])->get('document')->num_rows();
			if ($reg_cnt == 0) 
			{
			
				$data1['doc_name'] = "Leaving_Certificate";
				$data1['doc_type'] = "1";
				$data1['doc_number'] = $add['LC_no'];
				$data1['doc_file'] = "";
				$data1['doc_effective_date'] = date('Y-m-d');
				$data1['doc_user'] = $add['student_profile_id'];
				$data1['doc_user_type'] = "8";
				$data1['doc_school_profile_id'] = $add['school_id'];

				$this->Student_model->student_document($data1);

				$this->db->query('update student set student_expiry_date = "'.date('Y-m-d').'" where student_profile_id= "'.$add['student_profile_id'].'" ');
				$this->db->query('update student_class_division_assgn set SCD_expiry_date = "'.date('Y-m-d').'" where SCD_student_profile_id= "'.$add['student_profile_id'].'" ');
				$this->db->query('update parent set parent_expiry_date = "'.date('Y-m-d').'" where parent_student_profile_id= "'.$add['student_profile_id'].'" ');
			}
			echo json_encode($reg_cnt);
		}

		function update_LC_details()
		{
			$LC_data['student_profile_id'] = $_POST['student_profile_id'];
			$LC_data['student_privious_school_name'] = $_POST['student_privious_school_name'];
			$LC_data['student_progress'] = $_POST['student_progress'];
			$LC_data['student_conduct'] = $_POST['student_conduct'];
			$LC_data['student_LC_date'] = $_POST['student_LC_date'];
			$LC_data['student_LC_reason'] = $_POST['student_LC_reason'];
			$LC_data['student_remark'] = $_POST['student_remark'];

			// $SCD_data['SCD_effective_date'] = $_POST['class_since_date'];
			// $this->db->set($SCD_data)->where('SCD_student_profile_id',$LC_data['student_profile_id'])->update('student_class_division_assgn', $SCD_data);

			$this->db->set($LC_data)->where('student_profile_id',$LC_data['student_profile_id'])->update('student', $LC_data);
			echo json_encode($LC_data);
		}




	}
		