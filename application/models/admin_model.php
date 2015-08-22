<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function get_all_product()
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status','1');
		$this->db->order_by('product_id','desc');
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array();
	}
	
	public function save_product()
	{
		$product_id =$this->input->post('product_id');
		$cat_name =$this->input->post('product');
		$cat_desc =$this->input->post('desc');
		
		if(isset($product_id) && $product_id > 0)
			$this->db->update('product',array('product'=>$cat_name,'desc'=>$cat_desc),array('product_id'=>$product_id));
		else
			$this->db->insert('product',array('product'=>$cat_name,'desc'=>$cat_desc));
		
		return true;
	}
	
	public function get_product($product_id)
	{
		$data=array();
		$result = $this->db->get_where('product',array('product_id'=>$product_id,'status'=>'1'));
		if($result->num_rows() > 0)
		{
			$res = $result->first_row();
			$data['product_id'] = $res->product_id;
			$data['desc'] = $res->desc;
			$data['product'] = $res->product;
		}
		return $data;
	}
	
	public function delete_product($product_id)
	{
		$this->db->update('product',array('status'=>'0'),array('product_id'=>$product_id));
		return true;
	}
	
	public function get_all_roles()
	{
		$roles=array();
		$result = $this->db->get_where('roles',array('rid !='=>1));
		if($result->num_rows() > 0)
		{
			foreach($result->result_array() as $r)
			{
				$roles[$r['rid']] = $r['role'];
			}
			return $roles;
		}else
			return array();
	}
	
	public function get_all_users()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('roles','roles.rid=users.rid');
		$this->db->where('users.status','1');
		$this->db->where('users.uid !=',1);
		$this->db->order_by('uid','desc');
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array();
	}
	
	public function save_user()
	{
		$uid =$this->input->post('uid');
		$role =$this->input->post('role');
		$username =$this->input->post('username');
		$password =$this->input->post('pass');
		
		if(isset($uid) && $uid > 0){
			if(strlen($password) > 0)
				$this->db->update('users',array('rid'=>$role,'username'=>$username,'password'=>md5($password),'temp_pwd'=>$password),array('uid'=>$uid));
			else
				$this->db->update('users',array('rid'=>$role,'username'=>$username),array('uid'=>$uid));
		}
		else
			$this->db->insert('users',array('rid'=>$role,'username'=>$username,'password'=>md5($password),'temp_pwd'=>$password,'last_login'=>date('Y-m-d H:i:s')));
		
		return true;
	}
	
	public function get_user($uid)
	{
		$data=array();
		$result = $this->db->get_where('users',array('uid'=>$uid,'status'=>'1'));
		if($result->num_rows() > 0)
		{
			$res = $result->first_row();
			$data['uid'] = $res->uid;
			$data['role'] = $res->rid;
			$data['username'] = $res->username;
			
		}
		return $data;
	}
	
	public function delete_user($uid)
	{
		$this->db->update('users',array('status'=>'0'),array('uid'=>$uid));
		return true;
	}
	
	public function get_all_agency()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('status','1');
		$this->db->where('rid',2);
		$this->db->order_by('uid','desc');
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			foreach($data->result() as $r){
				$agency[$r->uid] = $r->username;
			}
		}else{
			$agency = array();
		}
		
		//print_r($agency); exit;
		return $agency;
	}
	
	public function get_mis_report($data){
	
		$result['id'] = array();
		/** Uploaded Images Count **/
		$sql = "SELECT u.uid, u.username, ui.upload_date FROM uploaded_images ui left join users u on ui.uid = u.uid  WHERE ui.rid = 2 AND ui.status = '1'";
		if($data['agency'] != 0){
			$sql .= " AND ui.uid = ".$data['agency'];
		} 
		$frmdate = $data['from_year'] . '-' . $data['from_month'] . '-01' ; 
		$todate = $data['to_year'] . '-' . $data['to_month'] . '-'.cal_days_in_month(CAL_GREGORIAN, $data['to_month'], $data['to_year']); 
		
		$sql .= ' AND TIMESTAMPDIFF(DAY ,STR_TO_DATE(ui.upload_date, "%Y-%m-%d" ),"'.$todate.'") >= 0 and TIMESTAMPDIFF(DAY ,"'.$frmdate.'",STR_TO_DATE(ui.upload_date, "%Y-%m-%d" )) >= 0'; 
		
		$uploaded = $this->db->query($sql);
		//echo $uploaded->num_rows(); exit;
		if($uploaded->num_rows() > 0){
			//print_r($uploaded->query()); exit;
			foreach($uploaded->result() as $u){
				$uid = $u->uid;
				$date = date('01-m-Y',strtotime($u->upload_date));
				//echo strtotime($date); echo '<br>';
				$result['id'][$date] = $date;
				$result['upload']['month'][$date] = date('F',strtotime($u->upload_date));
				$result['upload']['year'][$date] = date('Y',strtotime($u->upload_date));
				$result['upload']['uid'][$date] = $u->uid;
				$result['upload']['username'][$date] = $u->username;
				$result['upload']['cnt'][$date] = (isset($result['upload']['cnt'][$date])) ? ($result['upload']['cnt'][$date] + 1) : 1;
			}
		}else $result['upload'] = array();
		
		/** Downloaded Images Count **/
		$sql = "SELECT u.uid, u.username, di.date FROM downloaded_images di left join users u on di.uid = u.uid  WHERE di.rid = 2 AND di.status = '1'";
		//print_r($data);
		if($data['agency'] != 0){
			$sql .= " AND di.uid = ".$data['agency'];
		} 
		$frmdate = $data['from_year'] . '-' . $data['from_month'] . '-01' ; 
		$todate = $data['to_year'] . '-' . $data['to_month'] . '-'.cal_days_in_month(CAL_GREGORIAN, $data['to_month'], $data['to_year']); 
		
		$sql .= ' AND TIMESTAMPDIFF(DAY ,STR_TO_DATE(di.date, "%Y-%m-%d" ),"'.$todate.'") >= 0 and TIMESTAMPDIFF(DAY ,"'.$frmdate.'",STR_TO_DATE(di.date, "%Y-%m-%d" )) >= 0'; 
		
		$downloaded = $this->db->query($sql);
		//echo $uploaded->num_rows(); exit;
		if($downloaded->num_rows() > 0){
			
			foreach($downloaded->result() as $u){
				$uid = $u->uid;
				$date = date('01-m-Y',strtotime($u->date));
				//echo strtotime($date); echo '<br>';
				$result['id'][$date] = $date;
				$result['download']['month'][$date] = date('F',strtotime($u->date));
				$result['download']['year'][$date] = date('Y',strtotime($u->date));
				$result['download']['uid'][$date] = $u->uid;
				$result['download']['username'][$date] = $u->username;
				$result['download']['cnt'][$date] = (isset($result['download']['cnt'][$date])) ? ($result['download']['cnt'][$date] + 1) : 1;
			}
		}else $result['download'] = array();
		//exit;
		return $result;
	}

public function get_uploaded_images_by_id($mnth,$year,$uid){
		$nmonth = date('m',strtotime($mnth));
		$this->db->select('users.username,uploaded_images.*,product.product');
		$this->db->from('uploaded_images');
		$this->db->join('product','product.product_id = uploaded_images.product_id');
		$this->db->join('users','uploaded_images.uid = users.uid');
		$this->db->where('uploaded_images.uid',$uid);
		$this->db->where('uploaded_images.status','1');
		$this->db->where('MONTH(uploaded_images.upload_date)',$nmonth);
		$this->db->where('YEAR(uploaded_images.upload_date)',$year);
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array();
	}
	
	
	public function get_updates()
	{
		$display_arr[0]['month'] = date("M-Y");
		$display_arr[1]['month'] = date("M-Y",strtotime("-1 Months"));
		$display_arr[2]['month'] = date("M-Y",strtotime("-2 Months"));
		$display_arr[3]['month'] = date("M-Y",strtotime("-3 Months"));
		$display_arr[4]['month'] = date("M-Y",strtotime("-4 Months"));
		
		$months_arr[0] = date("Y-m");
		$months_arr[1] = date("Y-m",strtotime("-1 Months"));
		$months_arr[2] = date("Y-m",strtotime("-2 Months"));
		$months_arr[3] = date("Y-m",strtotime("-3 Months"));
		$months_arr[4] = date("Y-m",strtotime("-4 Months"));
		
		foreach($months_arr as $k => $month) {
		
		$sql = "SELECT dimg_id FROM downloaded_images WHERE rid = 2 and status = '1'";
		
		$piece = explode('-',$month);
		$frmdate = $month . '-01' ; 
		$todate = $month . '-'.cal_days_in_month(CAL_GREGORIAN, $piece[1], $piece[0]); 
		
		$sql .= ' AND TIMESTAMPDIFF(DAY ,STR_TO_DATE(date, "%Y-%m-%d" ),"'.$todate.'") >= 0 and TIMESTAMPDIFF(DAY ,"'.$frmdate.'",STR_TO_DATE(date, "%Y-%m-%d" )) >= 0'; 
		
		$display_arr[$k]['download'] = $this->db->query($sql)->num_rows();
		
		$sql2 = "SELECT img_id FROM uploaded_images WHERE status = '1'";
		
		$piece = explode('-',$month);
		$frmdate = $month . '-01' ; 
		$todate = $month . '-'.cal_days_in_month(CAL_GREGORIAN, $piece[1], $piece[0]); 
		
		$sql2 .= ' AND TIMESTAMPDIFF(DAY ,STR_TO_DATE(upload_date, "%Y-%m-%d" ),"'.$todate.'") >= 0 and TIMESTAMPDIFF(DAY ,"'.$frmdate.'",STR_TO_DATE(upload_date, "%Y-%m-%d" )) >= 0'; 
		
		$display_arr[$k]['upload'] = $this->db->query($sql2)->num_rows();
		}
		
		return $display_arr;
	}
	
	public function get_top_five_upload_count($month,$year)
	{
		$display_arr =array();
		$sql2 = "SELECT count(*) as imgcount,users.username  FROM uploaded_images join users on users.uid = uploaded_images.uid WHERE .uploaded_images.status = '1'";
		
		
		$frmdate = $year.'-'.$month . '-01' ; 
		$todate = $year.'-'.$month . '-'.cal_days_in_month(CAL_GREGORIAN, $month, $year); 
		
		$sql2 .= ' AND TIMESTAMPDIFF(DAY ,STR_TO_DATE(uploaded_images.upload_date, "%Y-%m-%d" ),"'.$todate.'") >= 0 and TIMESTAMPDIFF(DAY ,"'.$frmdate.'",STR_TO_DATE(uploaded_images.upload_date, "%Y-%m-%d" )) >= 0 group by users.uid order by imgcount desc limit 5'; 
		
		$result = $this->db->query($sql2);
		if($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result_array() as $res)
			{
				$display_arr[$i]['agency'] = $res['username'];
				$display_arr[$i]['count'] = $res['imgcount'];
				$i++;
			}
			
		}
		return $display_arr;
		
		
	}
	
	public function get_top_five_download_count($month,$year)
	{
		$display_arr =array();
		$sql = "SELECT count(*) as imgcount,users.username FROM downloaded_images join users on users.uid = downloaded_images.uid WHERE users.rid = 2 and downloaded_images.status = '1'";
		
		$frmdate = $year.'-'.$month . '-01' ; 
		$todate = $year.'-'.$month . '-'.cal_days_in_month(CAL_GREGORIAN, $month, $year); 
		
		$sql .= ' AND TIMESTAMPDIFF(DAY ,STR_TO_DATE(downloaded_images.date, "%Y-%m-%d" ),"'.$todate.'") >= 0 and TIMESTAMPDIFF(DAY ,"'.$frmdate.'",STR_TO_DATE(downloaded_images.date, "%Y-%m-%d" )) >= 0 group by users.uid order by imgcount desc limit 5'; 
		
		$result = $this->db->query($sql);
		if($result->num_rows() > 0)
		{
			$i=0;
			foreach($result->result_array() as $res)
			{
				$display_arr[$i]['agency'] = $res['username'];
				$display_arr[$i]['count'] = $res['imgcount'];
				$i++;
			}
			
		}
		return $display_arr;
		
		
	}

	public function get_downloaded_images_by_id($mnth,$year,$uid){
		$nmonth = date('m',strtotime($mnth));		
		$this->db->select('users.username,uploaded_images.*,downloaded_images.date,downloaded_images.dimg_id,product.product');
		$this->db->from('downloaded_images');
		$this->db->join('uploaded_images','uploaded_images.img_id = downloaded_images.img_id');
		$this->db->join('product','product.product_id = uploaded_images.product_id');
		$this->db->join('users','uploaded_images.uid = users.uid');
		$this->db->where('uploaded_images.uid',$uid);
		$this->db->where('uploaded_images.status','1');
		$this->db->where('downloaded_images.status','1');
		$this->db->where('MONTH(uploaded_images.upload_date)',$nmonth);
		$this->db->where('YEAR(uploaded_images.upload_date)',$year);
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array(); 
	}

	public function get_all_websites()
	{
		$this->db->select('*');
		$this->db->from('website');
		$this->db->where('status','1');
		$this->db->order_by('web_id','desc');
		$result = $this->db->get();
		if($result->num_rows() > 0)
		{
			return $result->result_array();
		}else
			return array();
	}
	
	public function save_website()
	{
		$web_id =$this->input->post('web_id');
		$web_name =$this->input->post('website');
		$web_url =$this->input->post('website_url');
		$web_desc =$this->input->post('desc');
		
		if(isset($web_id) && $web_id > 0)
			$this->db->update('website',array('website'=>$web_name,'url'=>$web_url,'desc'=>$web_desc),array('web_id'=>$web_id));
		else
			$this->db->insert('website',array('website'=>$web_name,'url'=>$web_url,'desc'=>$web_desc));
		
		return true;
	}
	
	public function get_website($web_id)
	{
		$data=array();
		$result = $this->db->get_where('website',array('web_id'=>$web_id,'status'=>'1'));
		if($result->num_rows() > 0)
		{
			$res = $result->first_row();
			$data['web_id'] = $res->web_id;
			$data['desc'] = $res->desc;
			$data['website_url'] = $res->url;
			$data['website'] = $res->website;
		}
		return $data;
	}
	
	public function delete_website($web_id)
	{
		$this->db->update('website',array('status'=>'0'),array('web_id'=>$web_id));
		return true;
	}

	public function get_settings()
	{
		$data=array();
		$settings =$this->db->get('settings');
		foreach($settings->result() as $setting){

			$data[$setting->meta_key] = $setting->meta_value;
		}
		return $data;
	}

	public function save_settings()
	{
		$email = $this->input->post('admin_email');
		$this->db->update('settings',array('meta_value'=>$email),array('meta_key'=>'admin_email'));
		return true;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */