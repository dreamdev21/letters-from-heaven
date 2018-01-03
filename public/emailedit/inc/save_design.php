<?php
/*
 *
 * An example file that save encoded SVG, PNG and JPG URL and creates an image of it
 *
 */

$site_url = $_SERVER['HTTP_REFERER'];

$site_ref_url = explode('/', $site_url);

$site_url = $site_ref_url[2];

$type = json_decode($_POST['type'], true);

$post_data = json_decode($_POST['object'], true);



if(isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'svg'){

		$result = array();
		$filenames = array();
		foreach ($post_data as $key => $value) {
		
			if(!empty($value) && $value != null){
				

				$destination = dirname(dirname(__FILE__)).'/saved_design/svg/';

				$filename = $key.'design_'.time().'.svg';

				$contant = file_get_contents($value);

				file_put_contents($destination.$filename, $contant);
				$filenames[] = $site_url.'/saved_design/svg/'.$filename;
				
			}
		}

		$result['status'] = true;
		$result['filename'] = $filenames;
		$result['message'] = 'Your designed object has been saved.';

		echo json_encode($result);
				
		//send_design($destination, $filename);

} else if(isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'png'){

		$result = array();
		$filenames = array();
		foreach ($post_data as $key => $value) {

			if(!empty($value) && $value != null){

				

				$destination = dirname(dirname(__FILE__)).'/saved_design/png/';

				$filename = $key.'design_'.time().'.png';

				$contant = file_get_contents($value);

				file_put_contents($destination.$filename, $contant);
				$filenames[] = $site_url.'/saved_design/png/'.$filename;
				
			}
		}

		$result['status'] = true;
		$result['filename'] = $filenames;
		$result['message'] = 'Your design has been saved.';

		echo json_encode($result);

		//send_design($destination, $filename);

} else if(isset($_POST['type']) && !empty($_POST['type']) && $_POST['type'] == 'jpg'){

		$result = array();
		$filenames = array();
		foreach ($post_data as $key => $value) {
			if(!empty($value) && $value != null){
			
				

				$destination = dirname(dirname(__FILE__)).'/saved_design/jpg/';

				$filename = $key.'design_'.time().'.jpg';

				$contant = file_get_contents($value);

				file_put_contents($destination.$filename, $contant);
				$filenames[] = $site_url.'/saved_design/jpg/'.$filename;
				
			}
		}

		$result['status'] = true;
		$result['filename'] = $filenames;
		$result['message'] = 'Your design has been saved.';

		echo json_encode($result);

		//send_design($destination, $filename);

} else{

	$result['status'] = false;
	$result['filename'] = array();
	$result['message'] = 'Something went wrong! Please try again.';

	echo json_encode($result);
}


function send_design($filepath = null, $filename = null){


	$my_file = $filename;
	$my_path = $filepath;
	
	
	$my_name    = "Design Tailor";
	$my_mail    = "no-reply@xxxxxx.com";
	$my_replyto = "no-reply@xxxxxx.com";
	
	
	$to_email   = ''; 
	$my_subject = "Design Tailor :: Saved design";
	$message     = "New design created using design tailor.";
	
	if(!empty($to_email)){
		mail_attachment($my_file, $my_path, $to_email, $my_mail, $my_name, $my_replyto, $my_subject, $message);
	}
}

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	
	    $file = $path.$filename;
	    $file_size = filesize($file);
	    $handle = fopen($file, "r");
	    $content = fread($handle, $file_size);
	    fclose($handle);
	    $content = chunk_split(base64_encode($content));
	    
	    $uid = md5(uniqid(time()));
	    
	    $header = "From: ".$from_name." <".$from_mail.">\r\n";
	    $header .= "Reply-To: ".$replyto."\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	    $header .= "This is a multi-part message in MIME format.\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	    $header .= $message."\r\n\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
	    $header .= "Content-Transfer-Encoding: base64\r\n";
	    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	    $header .= $content."\r\n\r\n";
	    $header .= "--".$uid."--";
	    
	    
	    mail($mailto, $subject, "", $header);
	    
	    
}