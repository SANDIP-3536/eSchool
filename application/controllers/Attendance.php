<?php
	date_default_timezone_set('Asia/Kolkata');
	class Attendance extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(isset($this->session->userdata['school'])){

			}elseif(isset($this->session->userdata['teacher'])) {

			}else{
				redirect('/');
			}
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

			$attend_details['flash']['active'] = $this->session->flashdata('active');
        	$attend_details['flash']['title'] = $this->session->flashdata('title');
        	$attend_details['flash']['text'] = $this->session->flashdata('text');
        	$attend_details['flash']['type'] = $this->session->flashdata('type');
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$attend_details['TCD_details'] = $this->Attendance_model->fetch_class_division_TCDS($employee_school_profile_id,$employee_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['education'] = 'education';
			$nav['header'] = $school_admin[0]['school_report_header'];
			$nav['footer'] = $school_admin[0]['school_report_footer'];
			$nav['education'] = 'education';
			if (isset($this->session->userdata['school'])) {
				$this->load->view('School/school_header', $admin);
        	}elseif (isset($this->session->userdata['teacher'])) {
				$this->load->view('Teacher/teacher_header', $admin);
        	}
        	// echo "<pre>";print_r($nav);die();
			$this->load->view('Attendance/attend_details',$attend_details);
			$this->load->view('Attendance/attend_footer',$nav);
		}

		function fetch_student_acor_SCD()
		{	
			if(isset($this->session->userdata['teacher'])){
				$school_admin = $this->session->userdata('teacher');
			}
			else{
				$school_admin = $this->session->userdata('school');
			}
			$class_id = $_POST['class_id'];
			$date = $_POST['date'];
			$TCD = explode('-',$class_id);
			$fetch['class_id'] = $TCD[0];
			$fetch['division_id'] = $TCD[1];
			$fetch['profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$fetch['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Attendance_model->fetch_student_acor_SCD($fetch,$date);
			if ($data[0]['attend_status'] == null)
			{
				$insert_update_status = 1;	
			}else{
				$insert_update_status = 0;
			}
			$this->session->set_userdata('insert_update_status',$insert_update_status);
			echo json_encode($data);
		}

		function fetch_teacher_acor_SCD()
		{	
			if(isset($this->session->userdata['teacher'])){
				$school_admin = $this->session->userdata('teacher');
			}
			else{
				$school_admin = $this->session->userdata('school');
			}
			$class_id = $_POST['class_id'];
			$TCD = explode('-',$class_id);
			$fetch['class_id'] = $TCD[0];
			$fetch['division_id'] = $TCD[1];
			$fetch['profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$fetch['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Attendance_model->fetch_teacher_acor_SCD($fetch);
			echo json_encode($data);
		}

		function fetch_teacher_acor_TCDS()
		{	
			if(isset($this->session->userdata['teacher'])){
				$school_admin = $this->session->userdata('teacher');
			}
			else{
				$school_admin = $this->session->userdata('school');
			}
			$TCDS_id = $_POST['TCDS_id'];
			$fetch['profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$fetch['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->db->query("SELECT CONCAT(employee_last_name,' ',employee_first_name,' ',employee_middle_name)as teacher_name FROM `teacher_class_division_subject_assgn` join employee on TCDS_employee_profile_id = employee_profile_id where TCDS_id =".$TCDS_id." and TCDS_expiry_date ='9999-12-31' and TCDS_AY_id =".$fetch['AY_id']." and TCDS_school_profile_id =".$fetch['profile_id']."")->result_array();
			echo json_encode($data);
		}

		function add_student_attendance()
		{
			if(isset($this->session->userdata['teacher'])){
				$school_admin = $this->session->userdata('teacher');
			}else if(isset($this->session->userdata['school'])){
				$school_admin = $this->session->userdata('school');
			}

			$all_mark = $this->input->post('all_mark');
			// $row_data = $this->input->post();
			// echo "<pre>";
			// print_r($row_data);die();

			// $insert_update_status = $this->session->userdata('insert_update_status');

			// print_r($all_mark);

			if ($all_mark == "holiday") 
			{
					$attend['attend_status'] = $this->input->post('attend_status');
					$fetch = $this->input->post('class_id');
					$class_division = explode('-',$fetch);
					$attend['class_id'] = $class_division[0];
					$attend['division_id'] = $class_division[1];
					$attend['attend_TCDS_id'] = $this->input->post('TCDS_id');
					$attend['attend_datetime'] = $this->input->post('attend_datetime');
					// echo "<pre>";print_r($attend);die();
					$cnt = count($attend['attend_status']);
					for ($i=0; $i < $cnt; $i++) {	
						$attend_reg['attend_SCD_id'] = $attend['attend_status'][$i];
						$attend_reg['attend_datetime'] = $attend['attend_datetime'].' '.date('H:i:s');
						$attend_reg['attend_TCDS_id'] = $attend['attend_TCDS_id'];
						$attend_reg['attend_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						$attend_reg['attend_AY_id'] = $school_admin[0]['school_AY_id'];
						$attend_reg['attend_status'] = "H";
						// $verify = $this->db->query("SELECT * FROM attendance where attend_SCD_id =".$attend_reg['attend_SCD_id']." and attend_TCDS_id = ".$attend_reg['attend_TCDS_id']." and CAST(attend_datetime as date) = CAST('".$attend_reg['attend_datetime']."' AS DATE) and attend_AY_id =".$attend_reg['attend_AY_id']." and attend_school_profile_id =".$attend_reg['attend_school_profile_id']."")->num_rows();
						// switch ($verify) {
						// 	case '0':
								$this->db->insert('attendance',$attend_reg);
						// }
					}

			}elseif ($all_mark == "weekoff") {
					$attend['attend_status'] = $this->input->post('attend_status');
					$fetch = $this->input->post('class_id');
					$class_division = explode('-',$fetch);
					$attend['class_id'] = $class_division[0];
					$attend['division_id'] = $class_division[1];
					$attend['attend_TCDS_id'] = $this->input->post('TCDS_id');
					$attend['attend_datetime'] = $this->input->post('attend_datetime');
					// echo "<pre>";print_r($attend);die();
					$cnt = count($attend['attend_status']);
					for ($i=0; $i < $cnt; $i++) {	
						$attend_reg['attend_SCD_id'] = $attend['attend_status'][$i];
						$attend_reg['attend_datetime'] = $attend['attend_datetime'].' '.date('H:i:s');
						$attend_reg['attend_TCDS_id'] = $attend['attend_TCDS_id'];
						$attend_reg['attend_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						$attend_reg['attend_AY_id'] = $school_admin[0]['school_AY_id'];
						$attend_reg['attend_status'] = "W";
						// $verify = $this->db->query("SELECT * FROM attendance where attend_SCD_id =".$attend_reg['attend_SCD_id']." and attend_TCDS_id = ".$attend_reg['attend_TCDS_id']." and CAST(attend_datetime as date) = CAST('".$attend_reg['attend_datetime']."' AS DATE) and attend_AY_id =".$attend_reg['attend_AY_id']." and attend_school_profile_id =".$attend_reg['attend_school_profile_id']."")->num_rows();
						// switch ($verify) {
						// 	case '0':
								$this->db->insert('attendance',$attend_reg);
						// }
					}
			}else{
					
					$attend['attend_status'] = $this->input->post('attend_status');
					$fetch = $this->input->post('class_id');
					$class_division = explode('-',$fetch);
					$attend['class_id'] = $class_division[0];
					$attend['division_id'] = $class_division[1];
					$attend['attend_TCDS_id'] = $this->input->post('TCDS_id');
					$attend['attend_datetime'] = $this->input->post('attend_datetime');
					// echo "<pre>";print_r($attend);die();
					$cnt = count($attend['attend_status']);
					for ($i=0; $i < $cnt; $i++) {	
						$attend_reg['attend_SCD_id'] = $attend['attend_status'][$i];
						$attend_reg['attend_datetime'] = $attend['attend_datetime'].' '.date('H:i:s');
						$attend_reg['attend_TCDS_id'] = $attend['attend_TCDS_id'];
						$attend_reg['attend_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						$attend_reg['attend_AY_id'] = $school_admin[0]['school_AY_id'];
						$attend_reg['attend_status'] = "P";
						// $verify = $this->db->query("SELECT * FROM attendance where attend_SCD_id =".$attend_reg['attend_SCD_id']." and attend_TCDS_id = ".$attend_reg['attend_TCDS_id']." and CAST(attend_datetime as date) = CAST('".$attend_reg['attend_datetime']."' AS DATE) and attend_AY_id =".$attend_reg['attend_AY_id']." and attend_school_profile_id =".$attend_reg['attend_school_profile_id']."")->num_rows();
						// switch ($verify) {
						// 	case '0':
								$this->db->insert('attendance',$attend_reg);
						// }
					}
					$SCD_student_id = $this->db->query("SELECT SCD_id from student_class_division_assgn where SCD_class_id=".$attend['class_id']." and SCD_division_id=".$attend['division_id']." and SCD_expiry_date='9999-12-31' and SCD_id not in(SELECT attend_SCD_id FROM attendance where cast(attend_datetime as date)='".$attend['attend_datetime']."' and attend_TCDS_id=".$attend['attend_TCDS_id']." and attend_AY_id=".$school_admin[0]['school_AY_id']." and attend_school_profile_id=".$school_admin[0]['employee_school_profile_id'].")")->result_array();
					$count = count($SCD_student_id);
					for ($i=0; $i < $count; $i++) { 
						$attend_regA['attend_SCD_id'] = $SCD_student_id[$i]['SCD_id'];
						$attend_regA['attend_datetime'] = $attend['attend_datetime'].' '.date('H:i:s');
						$attend_regA['attend_TCDS_id'] = $attend['attend_TCDS_id'];
						$attend_regA['attend_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						$attend_regA['attend_AY_id'] = $school_admin[0]['school_AY_id'];
						$attend_regA['attend_status'] = "A";
						$this->db->insert('attendance',$attend_regA);
					}

			}

			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Attendance Successfully Taken.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Attendance');
		}

		function fetch_att_records()
		{
			if(isset($this->session->userdata['teacher'])){
				$school_admin = $this->session->userdata('teacher');
			}else if(isset($this->session->userdata['school'])){
				$school_admin = $this->session->userdata('school');
			}
			$att['attend_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$att['attend_AY_id'] = $school_admin[0]['school_AY_id'];
			// $att['TCDS_id'] = $_POST['TCDS_att'];
			$att['date'] = $_POST['date_att'];
			$att['class_id'] = $_POST['class_att'];
			$att['div_id'] = $_POST['div_att'];
			$result = $this->Attendance_model->fetch_att_records($att);
			echo json_encode($result);
		}

		function delete_att_record()
		{
			if(isset($this->session->userdata['teacher'])){
				$school_admin = $this->session->userdata('teacher');
			}else if(isset($this->session->userdata['school'])){
				$school_admin = $this->session->userdata('school');
			}
			$att['attend_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$att['attend_AY_id'] = $school_admin[0]['school_AY_id'];
			// $att['TCDS_id'] = $_POST['TCDS_att'];
			$att['date'] = $_POST['date_att'];
			$att['class_id'] = $_POST['class_att'];
			$att['div_id'] = $_POST['div_att'];
			$this->db->query("DELETE FROM `attendance` WHERE DATE_FORMAT(attend_datetime, '%Y-%m-%d') = '".$att['date']."'
								AND attend_SCD_id in (SELECT SCD_id FROM student_class_division_assgn WHERE SCD_class_id = ".$att['class_id']." AND SCD_division_id = ".$att['div_id']." AND SCD_school_profile_id = ".$att['attend_school_profile_id']." AND SCD_AY_id = ".$att['attend_AY_id'].")
								AND attend_AY_id = ".$att['attend_AY_id']." AND attend_school_profile_id = ".$att['attend_school_profile_id']."");
			echo json_encode($att);
		}

		function edit_attendance()
		{
			// $attend_id = $this->input->post('attend_id');
			// $attend_status = $this->input->post('attend_status');
			$attend_id_edit1 = $_POST['attend_id_edit1'];
			$attend_status = $_POST['attend_status'];
			// print_r($attend_id);die();
			$this->db->set('attend_status',$attend_status)->where('attend_id',$attend_id_edit1)->update('attendance');
			// $this->session->set_flashdata('active',1);
   //          $this->session->set_flashdata('title',"Attendance Successfully Updated.");
   //          $this->session->set_flashdata('text',"");
   //          $this->session->set_flashdata('type',"success");
			// redirect('Attendance');
			echo json_encode($attend_status);
		}
		
		function class_name()
		{
			$att['TCDS_id'] = $_POST['TCDS_att'];
			$result = $this->Attendance_model->fetch_class_name_records($att);
			echo json_encode($result);
		}
		function attendance_grid_view()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	}
        	$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];

			$att['class_id'] = $_POST['class_id'];
			$att['division_id'] = $_POST['division_id'];
			$att['selected_month'] = $_POST['selected_month'];
			// $data['student_details'] = $this->db->query("SELECT 
			// 										student_profile_id
			// 										,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as name
			// 										,student_GRN
			// 										,student_DOB
			// 										from student_class_division_assgn
			// 										join student
			// 										on SCD_student_profile_id=student_profile_id
			// 										where SCD_effective_date<=date_format('".$att['selected_month']."','%Y,%m,%d')
			// 										and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y,%m,%d')
			// 										and SCD_school_profile_id=".$employee_school_profile_id."
			// 										and SCD_class_id=".$att['class_id']."
			// 										and SCD_division_id=".$att['division_id']."
			// 										order by student_GRN")->result_array();

			$data['student_details'] = $this->db->query("SELECT data.* 
															,(total-present-absent-holiday-weekly_off) as not_marked
															,(total-holiday-weekly_off) as working_day
															from (select
															student_profile_id
															,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as name
															,student_GRN
															,SCD_Roll_No
															,date_format(student_DOB,'%d-%m-%Y')as student_DOB
															,case when present is NULL then 0 else present end as present
															,case when absent is NULL then 0 else absent end as absent
															,case when holiday is NULL then 0 else holiday end as holiday
															,case when weekly_off is NULL then 0 else weekly_off end as weekly_off
															,DAY(LAST_DAY('".$att['selected_month']."')) as total
															from student_class_division_assgn
															join student
															on SCD_student_profile_id=student_profile_id
															left join (SELECT attend_SCD_id as p,count(*) as present FROM `attendance` where date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m') and attend_school_profile_id=".$employee_school_profile_id." and attend_status='P' group by 1) as present
															on p=SCD_id
															left join (SELECT attend_SCD_id as a,count(*) as absent FROM `attendance` where date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m') and attend_school_profile_id=".$employee_school_profile_id." and attend_status='A' group by 1) as absent
															on a=SCD_id
															left join (SELECT attend_SCD_id as h,count(*) as holiday FROM `attendance` where date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m') and attend_school_profile_id=".$employee_school_profile_id." and attend_status='H' group by 1) as holiday
															on h=SCD_id
															left join (SELECT attend_SCD_id as w,count(*) as weekly_off FROM `attendance` where date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m') and attend_school_profile_id=".$employee_school_profile_id." and attend_status='W' group by 1) as weekly_off
															on w=SCD_id
															where SCD_effective_date<=date_format(LAST_DAY('".$att['selected_month']."'),'%Y-%m-%d')
															and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y-%m-%d')
															and SCD_school_profile_id=".$employee_school_profile_id."
															and SCD_class_id=".$att['class_id']."
															and SCD_division_id=".$att['division_id']."
															order by SCD_Roll_No ASC) as data
															union all
															select
																'77777777' as student_profile_id
																,concat('Total Number of Boys : ',m_count) as name
																,' ' as student_GRN
																,' ' as SCD_Roll_No
																,'~ Present ~' as student_DOB
																,' ' as present
																,' ' as absent
																,' ' as holiday
																,' ' as weekly_off
																,' ' as total
																,' ' as not_marked
																,' ' as working_day
															from 
															(select 
																count(*) as m_count
															from student_class_division_assgn 
															join student
																on SCD_student_profile_id=student_profile_id
															where SCD_effective_date<=date_format(LAST_DAY('".$att['selected_month']."'),'%Y-%m-%d')
															and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y-%m-%d')
															and SCD_school_profile_id=".$employee_school_profile_id."
															and SCD_class_id=".$att['class_id']."
															and SCD_division_id=".$att['division_id']."
																and student_gender='Male'

															) as data1
															union all
															select
																'88888888' as student_profile_id
																,concat('Total Number of Girls : ',g_count) as name
																,' ' as student_GRN
																,' ' as SCD_Roll_No
																,'~ Absent ~' as student_DOB
																,' ' as present
																,' ' as absent
																,' ' as holiday
																,' ' as weekly_off
																,' ' as total
																,' ' as not_marked
																,' ' as working_day
															from 
															(select 
																count(*) as g_count
															from student_class_division_assgn 
															join student
																on SCD_student_profile_id=student_profile_id
															where SCD_effective_date<=date_format(LAST_DAY('".$att['selected_month']."'),'%Y-%m-%d')
															and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y-%m-%d')
															and SCD_school_profile_id=".$employee_school_profile_id."
															and SCD_class_id=".$att['class_id']."
															and SCD_division_id=".$att['division_id']."
																and student_gender='Female'
															) as data2
															union all
															select
																'99999999' as student_profile_id
																,concat('Total Number of Students : ',a_count) as name
																,' ' as student_GRN
																,' ' as SCD_Roll_No
																,'~ Total ~' as student_DOB
																,' ' as present
																,' ' as absent
																,' ' as holiday
																,' ' as weekly_off
																,' ' as total
																,' ' as not_marked
																,' ' as working_day
															from 
															(select 
																count(*) as a_count
															from student_class_division_assgn 
															join student
																on SCD_student_profile_id=student_profile_id
															where SCD_effective_date<=date_format(LAST_DAY('".$att['selected_month']."'),'%Y-%m-%d')
															and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y-%m-%d')
															and SCD_school_profile_id=".$employee_school_profile_id."
															and SCD_class_id=".$att['class_id']."
															and SCD_division_id=".$att['division_id']."
															) as data3
															")->result_array();

			$data['date_details'] = $this->db->query('SELECT date_field as date
										FROM
										(
										    SELECT
										        MAKEDATE(YEAR("'.$att['selected_month'].'"),1) +
										        INTERVAL (MONTH("'.$att['selected_month'].'")-1) MONTH +
										        INTERVAL daynum DAY date_field
										    FROM
										    (
										        SELECT t*10+u daynum
										        FROM
										            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
										            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
										            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
										            UNION SELECT 8 UNION SELECT 9) B
										        ORDER BY daynum
										    ) AA
										) AAA
										WHERE MONTH(date_field) = MONTH("'.$att['selected_month'].'")  
										ORDER BY date_field')->result_array();

			$data['attendance_details'] = $this->db->query("select * from (SELECT date_field as date,SCD_Roll_No,SCD_student_profile_id,case when attend_status is NULL then '-' else  attend_status end as status from (SELECT date_field
																FROM
																(
																    SELECT
																        MAKEDATE(YEAR('".$att['selected_month']."'),1) +
																        INTERVAL (MONTH('".$att['selected_month']."')-1) MONTH +
																        INTERVAL daynum DAY date_field
																    FROM
																    (
																        SELECT t*10+u daynum
																        FROM
																            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
																            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
																            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
																            UNION SELECT 8 UNION SELECT 9) B
																        ORDER BY daynum
																    ) AA
																) AAA
																WHERE MONTH(date_field) = MONTH('".$att['selected_month']."')  
																ORDER BY date_field) as data
															cross join (
																select
																SCD_student_profile_id
																,SCD_Roll_No
																,SCD_id
																,student_GRN
																from student_class_division_assgn
																join student
																on SCD_student_profile_id=student_profile_id
																where DATE_FORMAT('".$att['selected_month']."','%Y-%m')
																between DATE_FORMAT(SCD_effective_date, '%Y-%m') and DATE_FORMAT(SCD_expiry_date, '%Y-%m')
																and SCD_school_profile_id=".$employee_school_profile_id."
																and SCD_class_id=".$att['class_id']."
																and SCD_division_id=".$att['division_id']."
																) as data1
															left join attendance
															on date_field=DATE_FORMAT(attend_datetime, '%Y-%m-%d')
															and attend_SCD_id=SCD_id
															order by SCD_Roll_No,date_field) as data_0

															union all

															select * from (select 
																date_field as date
																,'-' as SCD_Roll_No
																,'77777777' as SCD_student_profile_id
																,case when present_count is NULL then '0' else  present_count end as status
															 from (SELECT date_field
																FROM
																(
																    SELECT
																        MAKEDATE(YEAR('".$att['selected_month']."'),1) +
																        INTERVAL (MONTH('".$att['selected_month']."')-1) MONTH +
																        INTERVAL daynum DAY date_field
																    FROM
																    (
																        SELECT t*10+u daynum
																        FROM
																            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
																            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
																            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
																            UNION SELECT 8 UNION SELECT 9) B
																        ORDER BY daynum
																    ) AA
																) AAA
																WHERE MONTH(date_field) = MONTH('".$att['selected_month']."')  
																ORDER BY date_field) as temp1
                                                                left JOIN (
                                                                SELECT 
                                                                    date_format(attend_datetime,'%Y-%m-%d') as p_date
                                                                    ,count(*) as present_count 
                                                                FROM `attendance` 
                                                                join student_class_division_assgn
                                                                    on SCD_id=attend_SCD_id
                                                                    where attend_status='P' 
																and SCD_school_profile_id=".$employee_school_profile_id."
																and SCD_class_id=".$att['class_id']."
																and SCD_division_id=".$att['division_id']."
                                                                    group by 1 order by 1
                                                                ) as present
                                                                on p_date=date_field
                                                                order by date_field) as data_1
                                                             union all

															select * from (select 
																date_field as date
																,'-' as SCD_Roll_No
																,'88888888' as SCD_student_profile_id
																,case when present_count is NULL then '0' else  present_count end as status
															 from (SELECT date_field
																FROM
																(
																    SELECT
																        MAKEDATE(YEAR('".$att['selected_month']."'),1) +
																        INTERVAL (MONTH('".$att['selected_month']."')-1) MONTH +
																        INTERVAL daynum DAY date_field
																    FROM
																    (
																        SELECT t*10+u daynum
																        FROM
																            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
																            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
																            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
																            UNION SELECT 8 UNION SELECT 9) B
																        ORDER BY daynum
																    ) AA
																) AAA
																WHERE MONTH(date_field) = MONTH('".$att['selected_month']."')  
																ORDER BY date_field) as temp1
                                                                left JOIN (
                                                                SELECT 
                                                                    date_format(attend_datetime,'%Y-%m-%d') as p_date
                                                                    ,count(*) as present_count 
                                                                FROM `attendance` 
                                                                join student_class_division_assgn
                                                                    on SCD_id=attend_SCD_id
                                                                    where attend_status='A' 
																and SCD_school_profile_id=".$employee_school_profile_id."
																and SCD_class_id=".$att['class_id']."
																and SCD_division_id=".$att['division_id']."
                                                                    group by 1 order by 1
                                                                ) as present
                                                                on p_date=date_field
                                                                order by date_field) as data_2
                                                              union all

															select * from (select 
																date_field as date
																,'-' as SCD_Roll_No
																,'99999999' as SCD_student_profile_id
																,case when present_count is NULL then '0' else  present_count end as status
															 from (SELECT date_field
																FROM
																(
																    SELECT
																        MAKEDATE(YEAR('".$att['selected_month']."'),1) +
																        INTERVAL (MONTH('".$att['selected_month']."')-1) MONTH +
																        INTERVAL daynum DAY date_field
																    FROM
																    (
																        SELECT t*10+u daynum
																        FROM
																            (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
																            (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
																            UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
																            UNION SELECT 8 UNION SELECT 9) B
																        ORDER BY daynum
																    ) AA
																) AAA
																WHERE MONTH(date_field) = MONTH('".$att['selected_month']."')  
																ORDER BY date_field) as temp1
                                                                left JOIN (
                                                                SELECT 
                                                                    date_format(attend_datetime,'%Y-%m-%d') as p_date
                                                                    ,count(*) as present_count 
                                                                FROM `attendance` 
                                                                join student_class_division_assgn
                                                                    on SCD_id=attend_SCD_id
                                                                    where attend_status in ('P','A')
																and SCD_school_profile_id=".$employee_school_profile_id."
																and SCD_class_id=".$att['class_id']."
																and SCD_division_id=".$att['division_id']."
                                                                    group by 1 order by 1
                                                                ) as present
                                                                on p_date=date_field
                                                                order by date_field) as data_3
															")->result_array();

			$data['total'] = $this->db->query("select 
												g_type
												,g_count
												,b_count
												,(g_count+b_count) as total
												,working_days
												,(g_count+b_count)/working_days as Average
												FROM (
													Select 
														type as g_type
														,case when g_count is NULL then '0' else g_count end as g_count
													from
													(
														Select
															'Present' as type
														from DUAL
														union all
														Select
															'Absent'  as type
														from DUAL
													) as data_type
													left join
													(
														SELECT
															case 
																when attend_status='P' then 'Present' 
																when attend_status='A' then 'Absent' 
																else '-' 
															end as g_status
															,count(*) as g_count
														FROM `attendance`
														join student_class_division_assgn
															on SCD_id=attend_SCD_id
														JOIN student
														ON student_profile_id=SCD_student_profile_id
														where SCD_effective_date<=date_format(LAST_DAY('".$att['selected_month']."'),'%Y-%m-%d')
														and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y-%m-%d')
														and attend_status in ('P','A')
														and student_gender='Female'
														and date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m')
														and SCD_school_profile_id=".$employee_school_profile_id."
														and SCD_class_id=".$att['class_id']."
														and SCD_division_id=".$att['division_id']."
														group by 1
													)as girl_data
													on g_status=type
												) as girl,
												(
													Select 
														type as b_type
														,case when b_count is NULL then '0' else b_count end as b_count
													from
													(
														Select
															'Present' as type
														from DUAL
														union all
														Select
															'Absent' as type
														from DUAL
													) as data_type
													left join
													(
														SELECT
															case 
																when attend_status='P' then 'Present' 
																when attend_status='A' then 'Absent' 
																else '-' 
															end as b_status
															,count(*) as b_count
														FROM `attendance`
														join student_class_division_assgn
															on SCD_id=attend_SCD_id
														JOIN student
														ON student_profile_id=SCD_student_profile_id
														where SCD_effective_date<=date_format(LAST_DAY('".$att['selected_month']."'),'%Y-%m-%d')
														and SCD_expiry_date>=date_format('".$att['selected_month']."','%Y-%m-%d')
														and attend_status in ('P','A')
														and student_gender='Male'
														and date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m')
														and SCD_school_profile_id=".$employee_school_profile_id."
														and SCD_class_id=".$att['class_id']."
														and SCD_division_id=".$att['division_id']."
														group by 1					
													)as boy_data
													on b_status=type
												) as boy,
												(select (DAY(LAST_DAY('".$att['selected_month']."'))-off_day) as working_days
												from student_class_division_assgn
												join student
												on SCD_student_profile_id=student_profile_id
												join (SELECT attend_SCD_id as p,count(*) as off_day FROM `attendance` where date_format(attend_datetime,'%Y-%m')=date_format('".$att['selected_month']."','%Y-%m') and attend_school_profile_id=".$employee_school_profile_id." and attend_status not in ('P','A') group by 1) as off
												on p=SCD_id
												group by 1) as total_days

												where b_type=g_type")->result_array();

			echo json_encode($data);
		}
	}
?>