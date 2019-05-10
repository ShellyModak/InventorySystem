<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
class Common_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		//require PHYSICAL_PATH.'smtpmail2/smtpmail/mail.php';
		//echo PHYSICAL_PATH.'smtpmail2/smtpmail/mail.php';die;
		//$this->load->library('mongo_db');
	}
	
    //============get all data with having multiple where clause from table=====//
	function getAllDataWithMultipleWhere($table,$whereArray,$orderBy,$orderType='DESC',$limit='',$start=0,$or_whereArray=array(),$like=array(), $group_by='')
    {
		//**** reference link: https://stackoverflow.com/questions/10538376/multiple-where-condition-codeigniter ****//
		
        $this->db->where($whereArray);
		if(!empty($or_whereArray))
		{
			$this->db->or_where($or_whereArray);
		}
		if(!empty($like))
		{
			$this->db->like($like);
		}
		
		if($group_by != '' || !empty($group_by))
		{
			$this->db->group_by($group_by); 
		}
        $this->db->order_by($orderBy,$orderType);
		if($limit!='' && $start!='')
        {
            $this->db->limit($limit, $start);
        }
		$query = $this->db->get($table);
		
		//echo $this->db->last_query().'<br>';
		
        $result['num_row'] = $query->num_rows();
        $result['result'] = $query->result();
        return $result;
    }
    //============get all data with having multiple where clause from table=====//
        //============get all data with having multiple where clause from table=====//
	function getAllDataWithMultipleWherein($table,$whereArray,$orderBy,$orderType='DESC',$limit='',$start=0,$or_whereArray=array(),$like=array(), $group_by='',$in_id='',$whereinArray=array(),$or_like=array(),$or_in_id='',$or_where_in=array())
    {
		//**** reference link: https://stackoverflow.com/questions/10538376/multiple-where-condition-codeigniter ****//
		
        $this->db->where($whereArray);
		if(!empty($or_whereArray))
		{
			$this->db->or_where($or_whereArray);
		}
		if(!empty($like))
		{
			$this->db->like($like);
		}
		if(!empty($or_like))
		{
			$this->db->or_like($or_like);
		}
		if($group_by != '' || !empty($group_by))
		{
			$this->db->group_by($group_by); 
		}
		if(!empty($whereinArray))
		{
			$this->db->where_in($in_id,$whereinArray);
		}
		if(!empty($or_where_in))
		{
			$this->db->or_where_in($or_in_id,$or_where_in);
		}
        $this->db->order_by($orderBy,$orderType);
		if($limit!='' && $start!='')
        {
            $this->db->limit($limit, $start);
        }
		$query = $this->db->get($table);
		
		//echo $this->db->last_query().'<br>';
		
        $result['num_row'] = $query->num_rows();
        $result['result'] = $query->result();
        return $result;
    }
    //============get all data with having multiple where clause from table=====//
	//===================get all data group by start===========================//
	function getAllDataGroup($table,$whereArray,$orderBy,$orderType='DESC',$limit='',$start=0,$groupBy='')
    {
		//**** reference link: https://stackoverflow.com/questions/10538376/multiple-where-condition-codeigniter ****//
		
        $this->db->where($whereArray);
        $this->db->order_by($orderBy,$orderType);
		$this->db->group_by($groupBy);
		if($limit!='' && $start!='')
        {
            $this->db->limit($limit, $start);
        }
		$query = $this->db->get($table);
		
		//echo $this->db->last_query().'<br>';
		
        $result['num_row'] = $query->num_rows();
        $result['result'] = $query->result();
        return $result;
    }
	//=====================get all data group by end===========================//
	
	//============get all data from table=====//
    function fetchAllData($table,$orderBy,$orderType='DESC')
    {
		$this->db->order_by($orderBy,$orderType);
		$query = $this->db->get($table);
		$result['result'] = $query->result();
		$result['num_row'] = $query->num_rows();
		return $result;
    }
    function edit($id,$table){
        
        $this->db->select('*');
         $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->result();
    }
    //===============insert data===========//
    function insertData($table,$data)
    {
		$insert = $this->db->insert($table,$data);
		if($insert)
		{
			return $this->db->insert_id();
		}
		else
		{
			return 0;
		}
    }
    //==============insert data============//
    
    //=============update details with multiple where =========//
    function updateDetailsWithMultipleWhere($table,$whereArray,$data)
    {
        $this->db->where($whereArray);
        $query = $this->db->update($table,$data);
		//echo $this->db->last_query();die;
        if($query)
        {
            return true;
        }
    }
    //=============update details with multiple where =========//
    
	//===========delete data with multiple where ============//
    function deleteDataWithMultipleWhere($table,$whereArray)
    {
		$this->db->where($whereArray);
		$delete = $this->db->delete($table);
		return true;
    }
    //===========delete data with multiple where ============//

    //======================= create thumbnail start ====================== //
	//public function createThumbnail($source_path,$target_path,$width = '150',$height = '150'){
	public function thumbnail($target_path,$source_path,$Twidth = '150',$Theight = '150',$mode='')
	{
		//return $target_path;
		list($width, $height, $type, $attr) = getimagesize($source_path);
		$per = 75;
		$thumb_w = $width;
		$thumb_h = $height;
		
		//echo 'REQUIRED<br>';
		//echo $Twidth.'<br>';
		//echo $Theight.'<br>';
		
		
		if($thumb_w > $Twidth || $thumb_h > $Theight)
		{
			while($per >= 25)
			{
				if($thumb_w > $thumb_h)
				{
					$chkVarThumb = $Twidth;
					$chkVarOriginal = $thumb_w;
				}
				else
				{
					$chkVarThumb = $Theight;
					$chkVarOriginal = $thumb_h;
				}
				
				//if($thumb_w > $Twidth || $thumb_h > $Theight)
				if($chkVarOriginal > $chkVarThumb)
				{
					$thumb_w = intval(($per * $width) / 100);
					$thumb_h = intval(($per * $height) / 100);
				}
				$per = $per - 25;
			}
		}
		
		//echo 'NEW<br>';
		//echo $thumb_w.'<br>';
		//echo $thumb_h;
		//die();
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
			'width' => $thumb_w,
			'height' => $thumb_h
		);
		$this->load->library('image_lib',$config_manip);
		$this->image_lib->initialize($config_manip);
		
		if (!$this->image_lib->resize())
		{
			//return 0;
			return $this->image_lib->display_errors();
		}
		// clear //
		$this->image_lib->clear();
		return 1;
	}
	//======================== create thumbnail end ======================= //

    /************************* Thumbnail Function - start *************************/
    function thumbnailOLD($fileThumb, $file, $Twidth, $Theight)
    {
	    list($width, $height, $type, $attr) = getimagesize($file);
	    switch($type)
	    {
		    case 1:
		    $img = @ImageCreateFromGIF($file);
		    break;
			
		    case 2:
		    $img = @ImageCreateFromJPEG($file);
		    break;
			
		    case 3:
		    $img = @ImageCreateFromPNG($file);
		    break;
	    }
		
	    $thumb_w = $Twidth;
	    $thumb_h = $Theight;
	    $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		
		$white = imagecolorallocate($thumb, 238, 238, 238);
	    
		// Draw a white rectangle
		imagefilledrectangle($thumb, 0, 0, $thumb_w, $thumb_h, $white);
	    
		if(imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumb_w, $thumb_h, $width, $height))
		{
	    //$thumb = @imagecreatetruecolor($thumb_w, $thumb_h);
	    //
	    //if(@imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y))
	    //{
		    switch($type)
		    {
			    case 1:
			    ImageGIF($thumb,$fileThumb);
			    break;
				
			    case 2:
			    ImageJPEG($thumb,$fileThumb);
			    break;
				
			    case 3:
			    ImagePNG($thumb,$fileThumb);
			    break;
		    }
		    return true;
	    }
    }
	/************************* Thumbnail Function - Ends *************************/

	//================ common mail function ===================//
	function common_mail_function($to,$subject,$body,$sender,$filesData)
	{
		$mail_type = EMAIL_TYPE;
		switch($mail_type)
		{
			case "SMTP":
			return send_mail1($to,$subject,$body,$sender,$filesData);
			break;

			case 'Mail_gun':
            $this->SendMailGun($receiver, $subject, $body);
			break;
		  
			default:
            $header  = 'MIME-Version: 1.0' . "\r\n";
            $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $header .= 'From:info@wordpress-profis.net' . "\r\n" .
                           'Reply-To:info@wordpress-profis.net' . "\r\n" .
                           'X-Mailer: PHP/' . phpversion();
			return mail($to,$subject,$body,$header);
		}
	}
	
	//============== mail gun function ============//
	function SendMail($receiver, $subject, $body)
	{
		$api_key="key-1d6b27610f0aa301805184d6b74172ed";/* Api Key got from https://mailgun.com/cp/my_account */
		$domain ="sandboxb0edb3409af8481fb3d16baff7e58426.mailgun.org";/* Domain Name you given to Mailgun */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		 'from' => 'Lompakko Plus <asiakaspalvelu@cardplus.fi>',
		 'to' => $receiver,
		 'subject' => $subject,
		 'html' => $body
		));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	//============== mail gun function ============//
    
	//=================== get email template details ===================//
	function getEmailTemplate111($emailId, $replace_placeholderArr)
	{
		$finalarray = array();
        
        //======== get template deatils ========//
		$this->db->where('id',$emailId);
		$query = $this->db->get('email_template');
        $emailTemplateArr = $query->result();
		
		$emailSubject = $emailTemplateArr[0]->subject;
		$emailBody = $emailTemplateArr[0]->description;
		//======== get template deatils ========//
		
		//======== get site deatils ========//
		$site_details = $this->getAllData('SiteSetting','id','1','id');
		$sitename = $site_details['result'][0]->site_name;
		$siteurl = $site_details['result'][0]->site_url;
		$contactEmail = $site_details['result'][0]->admin_email;
		$copyr8 = date("Y");
		//======== get site deatils ========//
		
		if($emailId == 1 || $emailId == 6)
		{
			$logo = '<img src="'.base_url().'uploadedImage/AdminLogo/logo.png" style="margin: 20px 0px 20px 50px;"/>';
		}
		else if($emailId == 7)
		{
			$logo = '<img src="'.base_url().'uploadedImage/AdminLogo/logo.png"/>';
		}
		else
		{
			$logo = '<img src="'.base_url().'uploadedImage/AdminLogo/logo.png" style="margin: 0px 0px 0px 5px;"/>';
		}
		
		$logo = '<a href="'.base_url().'">'.$logo.'</a>';
		
		$generalArr = array($contactEmail,$siteurl,$sitename,$logo,$copyr8);
		$finalArray = array_merge($replace_placeholderArr, $generalArr);
		
		$placeholderArr = array('[RECEIVERNAME]','[SENDERNAME]','[RECEIVEREMAIL]','[SENDEREMAIL]','[BODY]','[LINK]','[DATE]','[PROPERTY]','[SUB]','[CONTACTEMAIL]','[SITEURL]','[SITENAME]','[LOGO]','[COPYYEAR]');
		
		$emailSubjectRplc = str_replace($placeholderArr,$finalArray,$emailSubject);
		$emailBodyRplc = str_replace($placeholderArr,$finalArray,$emailBody);
		
        return $emailSubjectRplc.'[ESOLZ]'.$emailBodyRplc.'[ESOLZ]'.$sitename;
    }
	//=================== get email template details ===================//
	
	//=================== get email template details ===================//
	function getEmailTemplate($emailId, $replace_placeholderArr)
	{
		$finalarray = array();
        
        //======== get template deatils ========//
		$this->db->where('id',$emailId);
		$query = $this->db->get('email_template');
        $emailTemplateArr = $query->result();
		
		$emailSubject = $emailTemplateArr[0]->email_title;
		$emailBody = $emailTemplateArr[0]->email_desc;
		//======== get template deatils ========//
		
		//======== get site deatils ========//
		$whereSitesettingsArray = array(
											'id' => '1'
										);
        $site_details = $this->Common_model->getAllDataWithMultipleWhere('SiteSetting',$whereSitesettingsArray,'id');
		$sitename = $site_details['result'][0]->SiteName;
		$siteurl = $site_details['result'][0]->SiteUrl;
		$contactEmail = $site_details['result'][0]->ContactEmail;
		$ecyear = $site_details['result'][0]->EcYear;
		$copyr8 = $ecyear;//date("Y");
		//======== get site deatils ========//
		
		if($emailId == 1 || $emailId == 6)
		{
			$logo = '<img src="'.base_url().'assets/images/logo.png" style="margin: 20px 0px 10px 50px;"/>';
		}
		else if($emailId == 7)
		{
			$logo = '<img src="'.base_url().'assets/images/logo.png"/>';
		}
		else
		{
			$logo = '<img src="'.base_url().'assets/images/logo.png" style="margin: 0px 0px 0px 5px; height: 74px;"/>';
		}
		
		$logo = '<a href="'.base_url().'">'.$logo.'</a>';
		
		$generalArr = array($contactEmail,$siteurl,$sitename,$logo,$copyr8);
		$finalArray = array_merge($replace_placeholderArr, $generalArr);
		
		$placeholderArr = array('[RECEIVERNAME]','[SENDERNAME]','[RECEIVEREMAIL]','[SENDEREMAIL]','[BODY]','[LINK]','[DATE]','[WEBSHOW]','[SUB]','[CONTACTEMAIL]','[SITEURL]','[SITENAME]','[LOGO]','[COPYYEAR]');
		
		$emailSubjectRplc = str_replace($placeholderArr,$finalArray,$emailSubject);
		$emailBodyRplc = str_replace($placeholderArr,$finalArray,$emailBody);
		
        return $emailSubjectRplc.'[ESOLZ]'.$emailBodyRplc.'[ESOLZ]'.$sitename;
    }
	//=================== get email template details ===================//
    
	//============ strip special characters from a string ==============//
	function clean($string)
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens. 
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
    //============ strip special characters from a string ==============//
	
	//============= generate random string ============//
	function generateRandomString($length = 8)
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
    //============= generate random string ============//
    //============= generate new random String for payment transaction id============
    function gen_uuid() {
            return strtoupper(sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        
                // 16 bits for "time_mid"
                mt_rand( 0, 0xffff ),
        
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand( 0, 0x0fff ) | 0x4000,
        
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand( 0, 0x3fff ) | 0x8000,
        
                // 48 bits for "node"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            ));
        }
	//============= generate new random String for payment transaction id============
    //=================== push notification for android ==============//
	
    //=================== push notification for android ==============//
	
	//=================== push notification for android ==============//
	
    //=================== push notification for android ==============//
	
	//========================push notification for ios==============//
	 
	
	
	//================== curl function to connect with appconnect ==========================//
	
	
	
	
	//================== curl function to connect with appconnect ==========================//
	
	//==================curl function for file upload==========================//
	
	//==================curl function for file upload==========================//
	
	function multid_sort($arr, $index) {
		$b = array();
		$c = array();
		foreach ($arr as $key => $value) {
			$b[$key] = $value[$index];
		}
	
		asort($b);
	
		foreach ($b as $key => $value) {
			$c[] = $arr[$key];
		}
	
		return $c;
	}
	
	function detectLoginDeviceType()
	{
		$user_agent     = $_SERVER['HTTP_USER_AGENT'];
       $os_platform    = "Unknown OS Platform";
       $os_array       = array(
                               '/windows phone 8/i'    =>  'Windows Phone 8',
                               '/windows phone os 7/i' =>  'Windows Phone 7',
                               '/windows nt 6.3/i'     =>  'Windows 8.1',
                               '/windows nt 6.2/i'     =>  'Windows 8',
                               '/windows nt 6.1/i'     =>  'Windows 7',
                               '/windows nt 6.0/i'     =>  'Windows Vista',
                               '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                               '/windows nt 5.1/i'     =>  'Windows XP',
                               '/windows xp/i'         =>  'Windows XP',
                               '/windows nt 5.0/i'     =>  'Windows 2000',
                               '/windows me/i'         =>  'Windows ME',
                               '/win98/i'              =>  'Windows 98',
                               '/win95/i'              =>  'Windows 95',
                               '/win16/i'              =>  'Windows 3.11',
                               '/macintosh|mac os x/i' =>  'Mac OS X',
                               '/mac_powerpc/i'        =>  'Mac OS 9',
                               '/linux/i'              =>  'Linux',
                               '/ubuntu/i'             =>  'Ubuntu',
                               '/iphone/i'             =>  'iPhone',
                               '/ipod/i'               =>  'iPod',
                               '/ipad/i'               =>  'iPad',
                               '/android/i'            =>  'Android',
                               '/blackberry/i'         =>  'BlackBerry',
                               '/webos/i'              =>  'Mobile'
                            );
        $found = false;
        $device = '';
        foreach ($os_array as $regex => $value) 
        { 
            if($found)
                break;
            else if (preg_match($regex, $user_agent)) 
            {
                $os_platform = $value;
                $device = !preg_match('/(windows|mac|linux|ubuntu)/i',$os_platform)
                          ?'MOBILE':(preg_match('/phone/i', $os_platform)?'MOBILE':'SYSTEM');
            }
        }
        
		$device = !$device? 'SYSTEM':$device;
		$deviceInfoArr = array('os'=>$os_platform,'device'=>$device);
		return $deviceInfoArr;
	}
	
	/************************* Thumbnail Function - Starts *************************/
    function createThumbs($fileThumb, $file, $Twidth, $Theight, $tag){
        list($width, $height, $type, $attr) = getimagesize($file);

        switch($type)
        {
            case 1:
            $img = @ImageCreateFromGIF($file);
            break;

            case 2:
            $img = @ImageCreateFromJPEG($file);
            break;

            case 3:
            $img = @ImageCreateFromPNG($file);
            break;
        }

        if($tag == "width") //width contraint
        {
            $Theight = round(($height/$width)*$Twidth);
        }
        elseif($tag == "height") //height constraint
        {
            $Twidth = round(($width/$height)*$Theight);
        }
        elseif($tag=="both")
        {
            $Twidth = $Twidth;
            $Theight = $Theight;
        }
        else
        {
              $old_x=imageSX($img);
                $old_y=imageSY($img);

                // next we will calculate the new dimmensions for the thumbnail image
                // the next steps will be taken:
                // 1. calculate the ratio by dividing the old dimmensions with the new ones
                // 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
                // and the height will be calculated so the image ratio will not change
                // 3. otherwise we will use the height ratio for the image
                // as a result, only one of the dimmensions will be from the fixed ones
                if(($old_x>$Twidth)||($old_y>$Theight))
                {
                    $ratio1=$old_x/$Twidth;
                    $ratio2=$old_y/$Theight;
                    if($ratio1>$ratio2)
                    {
                        $thumb_w=$Twidth;
                        $thumb_h=$old_y/$ratio1;
                    }
                    else
                    {
                        $thumb_h=$Theight;
                        $thumb_w=$old_x/$ratio2;
                    }
                }
                else
                {
                    $thumb_h=$old_y;
                    $thumb_w=$old_x;
                }
        }

        $thumb = @imagecreatetruecolor($thumb_w, $thumb_h);

        if(@imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y))
        {
            switch($type)
            {
                case 1:
                ImageGIF($thumb,$fileThumb);
                break;

                case 2:
                ImageJPEG($thumb,$fileThumb);
                break;

                case 3:
                ImagePNG($thumb,$fileThumb);
                break;
            }
            return true;
        }
    }
    function fetch_country()
 {
  $this->db->order_by("country_name", "ASC");
  $query = $this->db->get("country");
  return $query->result();
 }

 function fetch_state($country_id)
 {
  $this->db->where('country_id', $country_id);
  $this->db->order_by('state_name', 'ASC');
  $query = $this->db->get('state');
  $output = '<option value="">Select State</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
  }
  return $output;
 }

 function fetch_city($state_id)
 {
  $this->db->where('state_id', $state_id);
  $this->db->order_by('city_name', 'ASC');
  $query = $this->db->get('city');
  $output = '<option value="">Select City</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
  }
  return $output;
 }
     public function fetch_data($table,$condition=array()){
        if(!empty($condition))
        {
            $this->db->where($condition);
        }
        $query = $this->db->get($table);
        return $query->result();
/************************* Thumbnail Function - Ends *************************/
}
}
?>