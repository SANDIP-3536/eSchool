<?php 

	class Timetable extends CI_Controller
	{
		function index_old()
		{
			if(!isset($this->session->userdata['school'])){
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$nav['flash']['active'] = $this->session->flashdata('active');
        	$nav['flash']['title'] = $this->session->flashdata('title');
        	$nav['flash']['text'] = $this->session->flashdata('text');
        	$nav['flash']['type'] = $this->session->flashdata('type');
        	
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
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$TT['class_details'] =  $this->Timetable_model->fetch_class($employee_school_profile_id);
            $TT['school_report_header'] = $school_admin[0]['school_report_header'];
            $TT['school_report_footer'] = $school_admin[0]['school_report_footer'];
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['education'] = 'education';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Timetable/timetable',$TT);
			$this->load->view('Timetable/timetable_footer',$nav);
		}
		function index()
		{
			if(!isset($this->session->userdata['school'])){
				redirect('/');
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
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$TT['class_details'] =  $this->Timetable_model->fetch_class($employee_school_profile_id);
            $TT['school_report_header'] = $school_admin[0]['school_report_header'];
            $TT['school_report_footer'] = $school_admin[0]['school_report_footer'];
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['education'] = 'education';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Timetable/test',$TT);
			$this->load->view('Timetable/test_footer',$nav);
		}


		function fetch_class_division()
		{
			$school_admin = $this->session->userdata('school');
			$class['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$class['class_id'] = $_POST['class_id'];
			$data = $this->Timetable_model->fetch_class_division($class);
			echo json_encode($data);
		}

		function fetch_class_division_subject()
		{
			$school_admin = $this->session->userdata('school');
			$subject['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['class_id'] = $_POST['class_id'];
			$subject['division'] = $_POST['division'];
			$data = $this->Timetable_model->fetch_class_division_subject($subject);
			echo json_encode($data);
		}

		function fetch_teacher()
		{
			$school_admin = $this->session->userdata('school');
			$subject['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$subject['subject_id'] = $_POST['subject_id'];
			$subject['class_name'] = $_POST['class_name'];
			$subject['division'] = $_POST['division'];
			$data = $this->Timetable_model->fetch_teacher($subject);
			echo json_encode($data);
		}

		function add_time()
		{
			$school_admin = $this->session->userdata('school');
			$data2['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data2['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['tt_school_profile_id'] = $data2['employee_school_profile_id'];
			$data['tt_AY_id'] = $data2['school_AY_id'];
			$data['tt_effective_date'] = date('Y/m/d');

			$class_name = $this->input->post('class_name');
			$data['tt_division_id'] = $this->input->post('division');
			$days = $this->input->post('days');
			$type = $this->input->post('type');
			$tt_start_time = $this->input->post('tt_start_time');
			$tt_end_time = $this->input->post('tt_end_time');
			// echo "<pre>";
			// print_r($days);
			// print_r($type);
			// print_r($tt_start_time);
			// print_r($tt_end_time);die();

			// $chk_break = $this->db->query('SELECT * FROM `timetable` 
			// 								WHERE tt_TCDS_id = "-1" 
			// 								AND tt_AY_id ="'.$data['tt_AY_id'].'" 
   //                                          AND tt_expiry_date="9999-12-31" 
   //                                          AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" 
			// 								AND tt_division_id="'.$data['tt_division_id'].'"')->num_rows();
			// if ($chk_break == 0) 
			// {
			// 	$break['tt_school_profile_id'] = $data['tt_school_profile_id'];
			// 	$break['tt_AY_id'] = $data['tt_AY_id'];
			// 	$break['tt_effective_date'] = $data['tt_effective_date'];
			// 	$break['tt_division_id'] = $data['tt_division_id'];
			// 	$break['tt_start_time'] = $this->input->post('tt_break_start_time');
			// 	$break['tt_end_time'] = $this->input->post('tt_breake_end_time');

			// 	for ($k = 0; $k < 6 ; $k++) 
			// 	{ 
			// 		$break['tt_day'] = $k+1;
			// 		$break['tt_TCDS_id'] = "-1";

			// 		$reg_cnt1 = $this->db->query('SELECT * FROM `timetable` 
	  //                                           WHERE tt_day="'.$break['tt_day'].'" 
	  //                                           AND tt_AY_id ="'.$break['tt_AY_id'].'" 
	  //                                           AND tt_expiry_date="9999-12-31" 
	  //                                           AND tt_school_profile_id="'.$break['tt_school_profile_id'].'" 
			// 									AND tt_division_id="'.$break['tt_division_id'].'" 
	  //                                           and("'.$break['tt_start_time'].'" between tt_start_time and ADDTIME(tt_end_time,"-00:01:00") 
	  //                                               or "'.$break['tt_end_time'].'" between ADDTIME(tt_start_time,"00:01:00") and tt_end_time 
	  //                                               or tt_end_time between ADDTIME("'.$break['tt_start_time'].'","00:01:00")   and "'.$break['tt_end_time'].'" 
	  //                                               or tt_start_time between "'.$break['tt_start_time'].'" and ADDTIME("'.$break['tt_end_time'].'","-00:01:00"))')->num_rows();
			// 			if ($reg_cnt1 == 0) 
			// 			{
			// 				$this->Timetable_model->insert_timetable($break);
			// 				$result = "1";
			// 			}else
			// 			{
			// 				$result = "0";
			// 			}
			// 	}
					
			// }


			for ($i=0; $i < count($days) ; $i++) 
			{ 
				if ($days[$i] == 'Monday') 
				{
					$data['tt_day'] = '1';
				}
				if ($days[$i] == 'Tuesday') 
				{
					$data['tt_day'] = '2';
				}
				if ($days[$i] == 'Wednesday') 
				{
					$data['tt_day'] = '3';
				}
				if ($days[$i] == 'Thursday') 
				{
					$data['tt_day'] = '4';
				}
				if ($days[$i] == 'Friday') 
				{
					$data['tt_day'] = '5';
				}
				if ($days[$i] == 'Saturday') 
				{
					$data['tt_day'] = '6';
				}
				if ($days[$i] == 'Sunday') 
				{
					$data['tt_day'] = '7';
				}
				// echo "<pre>"; print_r($type[$i]);die();
				for ($j=0; $j < count($tt_start_time) ; $j++) 
				{ 
					if ($type[$j] == "2") 
					{
						$data['tt_TCDS_id'] = "-1";
					}
					if ($type[$j] == "1") 
					{
						$data['tt_TCDS_id'] = 0;
					}
					$data['tt_start_time'] = $tt_start_time[$j];
					$data['tt_end_time'] = $tt_end_time[$j];

					$reg_cnt = $this->db->query('SELECT * FROM `timetable` 
                                            WHERE tt_day="'.$data['tt_day'].'" 
                                            AND tt_AY_id ="'.$data['tt_AY_id'].'" 
                                            AND tt_expiry_date="9999-12-31" 
                                            AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" 
											AND tt_division_id="'.$data['tt_division_id'].'" 
                                            and("'.$data['tt_start_time'].'" between tt_start_time and ADDTIME(tt_end_time,"-00:01:00") 
                                                or "'.$data['tt_end_time'].'" between ADDTIME(tt_start_time,"00:01:00") and tt_end_time 
                                                or tt_end_time between ADDTIME("'.$data['tt_start_time'].'","00:01:00")   and "'.$data['tt_end_time'].'" 
                                                or tt_start_time between "'.$data['tt_start_time'].'" and ADDTIME("'.$data['tt_end_time'].'","-00:01:00"))')->num_rows();
					if ($reg_cnt == 0) 
					{
						$this->Timetable_model->insert_timetable($data);
						$result = "1";
					}else
					{
						$result = "0";
					}
				}
			}
			redirect('Timetable');
		}
		function chk_break()
		{
			$school_admin = $this->session->userdata('school');
			$data2['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data2['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['tt_school_profile_id'] = $data2['employee_school_profile_id'];
			$data['tt_AY_id'] = $data2['school_AY_id'];
			$data['tt_effective_date'] = date('Y/m/d');
			$data['tt_division_id'] = $_POST['division'];

			$chk_break = $this->db->query('SELECT * FROM `timetable` 
											WHERE tt_TCDS_id = "-1" 
											AND tt_AY_id ="'.$data['tt_AY_id'].'" 
                                            AND tt_expiry_date="9999-12-31" 
                                            AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" 
											AND tt_division_id="'.$data['tt_division_id'].'"')->num_rows();

			if ($chk_break == 0) 
			{
				$result = "1";
			}else
			{
				$result = "0";
			}
			echo json_encode($result);

		}
		function chk_entry()
		{
			$school_admin = $this->session->userdata('school');
			$data2['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data2['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['tt_school_profile_id'] = $data2['employee_school_profile_id'];
			$data['tt_AY_id'] = $data2['school_AY_id'];
			$data['tt_effective_date'] = date('Y/m/d');
			$data['tt_division_id'] = $_POST['division'];

			$chk_break = $this->db->query('SELECT * FROM `timetable` 
											WHERE  tt_AY_id ="'.$data['tt_AY_id'].'" 
                                            AND tt_expiry_date="9999-12-31" 
                                            AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" 
											AND tt_division_id="'.$data['tt_division_id'].'"')->num_rows();

			if ($chk_break == 0) 
			{
				$result = "1";
			}else
			{
				$result = "0";
			}
			echo json_encode($result);

		}

		function add_timetable()
		{
			$data3['tt_id'] = $_POST['tt_id'];
			$data3['tt_TCDS_id'] = "0";
			$this->db->set($data3)->where('tt_id',$data3['tt_id'] )->update("timetable", $data3);
			
			$school_admin = $this->session->userdata('school');
			$data2['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data2['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['tt_school_profile_id'] = $data2['employee_school_profile_id'];
			$data['tt_AY_id'] = $data2['school_AY_id'];
			$data['tt_effective_date'] = date('Y/m/d');
			
			// $data['days'] = $_POST['days'];
			$data['tt_day'] = $_POST['tt_day'];
			$data2['class_name'] = $_POST['class_name'];
			$data2['division'] = $_POST['division'];

			$data['tt_id'] = $data3['tt_id'];
			$data2['subject_name'] = $_POST['subject_name'];
			$data2['teacher_name'] = $_POST['teacher_name'];
			$data['tt_start_time'] = $_POST['tt_start_time'];
			$data['tt_end_time'] = $_POST['tt_end_time'];
			$type = $_POST['type'];

			if ($type == "2") 
			{
				$data['tt_TCDS_id'] = "-1";
			}
			if ($type == "1") 
			{
				$data['tt_TCDS_id'] = $this->Timetable_model->fetch_TCDS_id($data2);
			}


            $reg_cnt = $this->db->query('SELECT * FROM `timetable` 
                                            WHERE tt_day="'.$data['tt_day'].'" 
                                            AND tt_AY_id ="'.$data['tt_AY_id'].'" 
                                            AND tt_expiry_date="9999-12-31" 
                                            AND tt_TCDS_id != 0 
                                            AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" 
                                            and tt_TCDS_id in 
                                                ( 
                                                    SELECT a.TCDS_id 
                                                    FROM teacher_class_division_subject_assgn as a,
                                                    teacher_class_division_subject_assgn as b 
                                                    where a.TCDS_employee_profile_id = b.TCDS_employee_profile_id 
                                                    and a.TCDS_AY_id="'.$data['tt_AY_id'].'" 
                                                    and a.TCDS_expiry_date="9999-12-31" 
                                                    and b.TCDS_id= "'.$data['tt_TCDS_id'].'" 
                                                union
                                                    SELECT TCDS_id 
                                                    FROM teacher_class_division_subject_assgn 
                                                    where TCDS_class_id="'.$data2['class_name'].'" 
                                                    and TCDS_division_id="'.$data2['division'].'" 
                                                    and TCDS_AY_id= "'.$data['tt_AY_id'].'" 
                                                    and TCDS_expiry_date="9999-12-31"
                                                ) 
                                            and(tt_TCDS_id != 0  and "'.$data['tt_start_time'].'" between tt_start_time and ADDTIME(tt_end_time,"-00:01:00") 
                                                or "'.$data['tt_end_time'].'" between ADDTIME(tt_start_time,"00:01:00") and tt_end_time 
                                                or tt_end_time between ADDTIME("'.$data['tt_start_time'].'","00:01:00")   and "'.$data['tt_end_time'].'" 
                                                or tt_start_time between "'.$data['tt_start_time'].'" and ADDTIME("'.$data['tt_end_time'].'","-00:01:00"))')->num_rows();
            
            // $reg_cnt = $this->db->query('SELECT * FROM `timetable` WHERE tt_day="'.$data['tt_day'].'" AND tt_AY_id ="'.$data['tt_AY_id'].'" AND tt_expiry_date="9999-12-31" AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" and tt_TCDS_id in ( SELECT a.TCDS_id FROM teacher_class_division_subject_assgn as a,teacher_class_division_subject_assgn as b where a.TCDS_employee_profile_id = b.TCDS_employee_ profile_id and a.TCDS_AY_id="'.$data['tt_AY_id'].'" and a.TCDS_expiry_date="9999-12-31" and b.TCDS_id= "'.$data['tt_TCDS_id'].'" ) and("'.$data['tt_start_time'].'" between tt_start_time and ADDTIME(tt_end_time,"-00:01:00") or "'.$data['tt_end_time'].'" between ADDTIME(tt_start_time,"00:01:00")  and tt_end_time or tt_end_time between ADDTIME("'.$data['tt_start_time'].'","00:01:00")   and "'.$data['tt_end_time'].'" or tt_start_time between "'.$data['tt_start_time'].'" and ADDTIME("'.$data['tt_end_time'].'","-00:01:00"))')->num_rows();
			// $reg_cnt = $this->db->query('SELECT * FROM `timetable` WHERE tt_day = "'.$data['tt_day'].'" AND tt_AY_id = "'.$data['tt_AY_id'].'" AND tt_expiry_date = "9999-12-31" AND tt_school_profile_id = "'.$data['tt_school_profile_id'].'" and tt_TCDS_id in (SELECT TCDS_id FROM teacher_class_division_subject_assgn where TCDS_class_id="'.$data2['class_name'].'" and TCDS_division_id="'.$data2['division'].'" and TCDS_AY_id= "'.$data['tt_AY_id'].'" and TCDS_expiry_date="9999-12-31") and ("'.$data['tt_start_time'].'" between tt_start_time and tt_end_time or "'.$data['tt_end_time'].'" between tt_start_time and tt_end_time or tt_end_time between "'.$data['tt_start_time'].'" and "'.$data['tt_end_time'].'" or tt_start_time between "'.$data['tt_start_time'].'" and "'.$data['tt_end_time'].'")')->num_rows();
			// $reg_cnt = $this->db->query('SELECT * FROM `timetable` WHERE tt_TCDS_id = '.$data['tt_TCDS_id'].' AND tt_day = '.$data['tt_day'].' AND tt_start_time = '.$data['tt_start_time'].' AND tt_end_time = '.$data['tt_end_time'].' AND tt_AY_id = '.$data['tt_AY_id'].' AND tt_expiry_date = "9999-12-31" AND tt_school_profile_id = '.$data['tt_school_profile_id'].' ')->num_rows();
			// $reg_cnt = $this->db->where('tt_TCDS_id', $data['tt_TCDS_id'])->where('tt_day', $data['tt_day'])->where('tt_start_time', $data['tt_start_time'])->where('tt_end_time', $data['tt_end_time'])->where('tt_AY_id', $data['tt_AY_id'])->where('tt_expiry_date ="9999-12-31"')->where('tt_school_profile_id', $data['tt_school_profile_id'])->get('timetable')->num_rows();
			if ($reg_cnt == 0) 
			{
				// // $this->Timetable_model->insert_timetable($data);
				$this->db->set($data)->where('tt_id',$data['tt_id'] )->update("timetable", $data);
				$result = "1";
			}else
			{
				$result = "0";
			}
			

			echo json_encode($result);
			// echo "<pre>";
			// print_r($data);die();
		}

		function add_timetable_new()
		{
			$school_admin = $this->session->userdata('school');
			$data2['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data2['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['tt_school_profile_id'] = $data2['employee_school_profile_id'];
			$data['tt_AY_id'] = $data2['school_AY_id'];
			$data['tt_effective_date'] = date('Y/m/d');
			
			// $data['days'] = $_POST['days'];
			$data['tt_day'] = $_POST['tt_day'];
			$data2['class_name'] = $_POST['class_name'];
			$data2['division'] = $_POST['division'];
			$data['tt_division_id'] = $_POST['division'];

			$data2['subject_name'] = $_POST['subject_name'];
			$data2['teacher_name'] = $_POST['teacher_name'];
			$data['tt_start_time'] = $_POST['tt_start_time'];
			$data['tt_end_time'] = $_POST['tt_end_time'];
			$type1 = $_POST['type1'];

			if ($type == "2") 
			{
				$data['tt_TCDS_id'] = "-1";
			}
			if ($type == "1") 
			{
				$data['tt_TCDS_id'] = $this->Timetable_model->fetch_TCDS_id($data2);
			}

            $reg_cnt = $this->db->query('SELECT * FROM `timetable` 
                                            WHERE tt_day="'.$data['tt_day'].'" 
                                            AND tt_AY_id ="'.$data['tt_AY_id'].'" 
                                            AND tt_expiry_date="9999-12-31" 
                                            AND tt_TCDS_id != 0 
                                            AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" 
                                            and tt_TCDS_id in 
                                                ( 
                                                    SELECT a.TCDS_id 
                                                    FROM teacher_class_division_subject_assgn as a,
                                                    teacher_class_division_subject_assgn as b 
                                                    where a.TCDS_employee_profile_id = b.TCDS_employee_profile_id 
                                                    and a.TCDS_AY_id="'.$data['tt_AY_id'].'" 
                                                    and a.TCDS_expiry_date="9999-12-31" 
                                                    and b.TCDS_id= "'.$data['tt_TCDS_id'].'" 
                                                union
                                                    SELECT TCDS_id 
                                                    FROM teacher_class_division_subject_assgn 
                                                    where TCDS_class_id="'.$data2['class_name'].'" 
                                                    and TCDS_division_id="'.$data2['division'].'" 
                                                    and TCDS_AY_id= "'.$data['tt_AY_id'].'" 
                                                    and TCDS_expiry_date="9999-12-31"
                                                ) 
                                            and(tt_TCDS_id != 0 AND ("'.$data['tt_start_time'].'" between tt_start_time and ADDTIME(tt_end_time,"-00:01:00") 
                                                or "'.$data['tt_end_time'].'" between ADDTIME(tt_start_time,"00:01:00") and tt_end_time 
                                                or tt_end_time between ADDTIME("'.$data['tt_start_time'].'","00:01:00")   and "'.$data['tt_end_time'].'" 
                                                or tt_start_time between "'.$data['tt_start_time'].'" and ADDTIME("'.$data['tt_end_time'].'","-00:01:00")))')->num_rows();
            
            // $reg_cnt = $this->db->query('SELECT * FROM `timetable` WHERE tt_day="'.$data['tt_day'].'" AND tt_AY_id ="'.$data['tt_AY_id'].'" AND tt_expiry_date="9999-12-31" AND tt_school_profile_id="'.$data['tt_school_profile_id'].'" and tt_TCDS_id in ( SELECT a.TCDS_id FROM teacher_class_division_subject_assgn as a,teacher_class_division_subject_assgn as b where a.TCDS_employee_profile_id = b.TCDS_employee_ profile_id and a.TCDS_AY_id="'.$data['tt_AY_id'].'" and a.TCDS_expiry_date="9999-12-31" and b.TCDS_id= "'.$data['tt_TCDS_id'].'" ) and("'.$data['tt_start_time'].'" between tt_start_time and ADDTIME(tt_end_time,"-00:01:00") or "'.$data['tt_end_time'].'" between ADDTIME(tt_start_time,"00:01:00")  and tt_end_time or tt_end_time between ADDTIME("'.$data['tt_start_time'].'","00:01:00")   and "'.$data['tt_end_time'].'" or tt_start_time between "'.$data['tt_start_time'].'" and ADDTIME("'.$data['tt_end_time'].'","-00:01:00"))')->num_rows();
			// $reg_cnt = $this->db->query('SELECT * FROM `timetable` WHERE tt_day = "'.$data['tt_day'].'" AND tt_AY_id = "'.$data['tt_AY_id'].'" AND tt_expiry_date = "9999-12-31" AND tt_school_profile_id = "'.$data['tt_school_profile_id'].'" and tt_TCDS_id in (SELECT TCDS_id FROM teacher_class_division_subject_assgn where TCDS_class_id="'.$data2['class_name'].'" and TCDS_division_id="'.$data2['division'].'" and TCDS_AY_id= "'.$data['tt_AY_id'].'" and TCDS_expiry_date="9999-12-31") and ("'.$data['tt_start_time'].'" between tt_start_time and tt_end_time or "'.$data['tt_end_time'].'" between tt_start_time and tt_end_time or tt_end_time between "'.$data['tt_start_time'].'" and "'.$data['tt_end_time'].'" or tt_start_time between "'.$data['tt_start_time'].'" and "'.$data['tt_end_time'].'")')->num_rows();
			// $reg_cnt = $this->db->query('SELECT * FROM `timetable` WHERE tt_TCDS_id = '.$data['tt_TCDS_id'].' AND tt_day = '.$data['tt_day'].' AND tt_start_time = '.$data['tt_start_time'].' AND tt_end_time = '.$data['tt_end_time'].' AND tt_AY_id = '.$data['tt_AY_id'].' AND tt_expiry_date = "9999-12-31" AND tt_school_profile_id = '.$data['tt_school_profile_id'].' ')->num_rows();
			// $reg_cnt = $this->db->where('tt_TCDS_id', $data['tt_TCDS_id'])->where('tt_day', $data['tt_day'])->where('tt_start_time', $data['tt_start_time'])->where('tt_end_time', $data['tt_end_time'])->where('tt_AY_id', $data['tt_AY_id'])->where('tt_expiry_date ="9999-12-31"')->where('tt_school_profile_id', $data['tt_school_profile_id'])->get('timetable')->num_rows();
			if ($reg_cnt == 0) 
			{
				$this->Timetable_model->insert_timetable($data);
				// $this->db->set($data)->where('tt_id',$data['tt_id'] )->update("timetable", $data);
				$result = "1";
			}else
			{
				$result = "0";
			}
			

			echo json_encode($result);
			// echo "<pre>";
			// print_r($data);die();
		}

		function show_timetable()
		{
			$school_admin = $this->session->userdata('school');
			$data['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['class_name'] = $_POST['class_name'];
			$data['division'] = $_POST['division'];

			$data1['timetable'] = $this->db->query('SELECT tt_id,tt_day,tt_start_time,tt_end_time,tt_division_id,tt_TCDS_id,employee_first_name,employee_last_name,subject_name,class_name,division_name,AY_name FROM `timetable` LEFT JOIN teacher_class_division_subject_assgn ON tt_TCDS_id = TCDS_id  AND TCDS_class_id = '.$data['class_name'].' AND TCDS_division_id = '.$data['division'].' AND TCDS_AY_id = '.$data['school_AY_id'].' AND TCDS_expiry_date = "9999-12-31" AND TCDS_school_profile_id = '.$data['employee_school_profile_id'].' LEFT JOIN employee ON TCDS_employee_profile_id=employee_profile_id LEFT JOIN subject ON subject_id = TCDS_subject_id LEFT join division on tt_division_id = division_id LEFT join class ON division_class_id = class_id  LEFT join academic_year on AY_id = tt_AY_id WHERE tt_school_profile_id = '.$data['employee_school_profile_id'].' AND tt_expiry_date = "9999-12-31" AND tt_AY_id = '.$data['school_AY_id'].' AND tt_division_id = '.$data['division'].' ORDER BY tt_day,cast(tt_start_time as time) ASC')->result_array();
			// $data1['timetable'] = $this->Timetable_model->fetch_timetable($data);
			echo json_encode($data1);
		}

		function teacher_timetable()
		{
			if(!isset($this->session->userdata['teacher']))
			{
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$school_admin = $this->session->userdata('teacher');
			// echo "<pre>";print_r($school_admin);die();
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

			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['education'] = 'timetable';

			$nav['first_name'] = $admin['first_name'];
			$nav['last_name'] = $admin['last_name'];
			$nav['AY_name'] = $admin['AY_name'];
			// $employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			// $data['school_AY_id'] = $school_admin[0]['school_AY_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			
			// $TT['lesson'] = $this->Lesson_model->teacher_lesson_details($data);
			$TT['class_details'] =  $this->Timetable_model->fetch_class_teacher($employee_profile_id);
			// print_r($TT);die();

			$this->load->view('Teacher/teacher_header', $admin);
			$this->load->view('Timetable/teacher_timetable',$TT);
			$this->load->view('Teacher/teacher_footer',$nav);
		}
		function fetch_class_division_teacher()
		{
			$school_admin = $this->session->userdata('teacher');
			$class['employee_profile_id'] = $school_admin[0]['employee_profile_id'];
			$class['class_id'] = $_POST['class_id'];
			$data = $this->Timetable_model->fetch_class_division_teacher($class);
			echo json_encode($data);
		}
		function show_timetable_teacher()
		{
			$school_admin = $this->session->userdata('teacher');
			$data['employee_profile_id'] = $school_admin[0]['employee_profile_id'];
			$data['school_AY_id'] = $school_admin[0]['school_AY_id'];
			// $data['class_name'] = $_POST['class_name'];
			// $data['division'] = $_POST['division'];

			$data1['timetable'] = $this->Timetable_model->fetch_timetable_teacher($data);
			echo json_encode($data1);
		}
		public function delete_day_time_table()
		{
			$tt_id = $_POST['day_time_table_id'];
			$this->db->query("DELETE FROM `timetable` where tt_id = ".$tt_id."");
		}
		public function delete_timetable()
		{
			$tt_division_id = $_POST['division'];
			$this->db->query("DELETE FROM `timetable` where tt_division_id = ".$tt_division_id."");
		}
		public function day_time_table_id()
		{
			$tt_id = $_POST['day_time_table_id'];
			$data = $this->db->query("SELECT * FROM `timetable` where tt_id = ".$tt_id."")->row();

			echo json_encode($data);
		}


	}
 ?>