<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
 
//$_POST['token_id'] = รหัส token
//$_POST['string'] = ข้อความ
//สองอย่างนี้ต้องมีเสมอ
if(!empty($_POST['token_id']) && !empty($_POST['string'])){
$token = $_POST['token_id'];
$str = $_POST['string']; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

if(!empty($_POST['image_url'])){
	$image_url = $_POST['image_url'];
}else{
	$image_url = '';
}

if(!empty($_POST['stickerPkg']) && !empty($_POST['stickerPkg'])){
	$stickerPkg = $_POST['stickerPkg'];
	$stickerId = $_POST['stickerId'];
}else{
	$stickerPkg = '';
	$stickerId = '';
}
 
	$res = notify_message($str,$token,$image_url,$stickerPkg,$stickerId);
	print_r($res);


	function notify_message($message,$token,$image_url='',$stickerPkg='',$stickerId=''){
	 $queryData = array(
	            		'message' => $message,
						);
		if($image_url!=''){
			$queryData ['imageThumbnail']=$image_url;
		    $queryData ['imageFullsize']=$image_url;
		            		
							
		}
		if($stickerPkg!='' && $stickerId!=''){
			$queryData ['stickerPackageId']=$stickerPkg;
		    $queryData ['stickerId']=$stickerId;
		            		
							
		}
					
	 $queryData = http_build_query($queryData,'','&');
	 $headerOptions = array( 
	         'http'=>array(
	            'method'=>'POST',
	            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
	                      ."Authorization: Bearer ".$token."\r\n"
	                      ."Content-Length: ".strlen($queryData)."\r\n",
	            'content' => $queryData
	            
	         ),
	 );
	 $context = stream_context_create($headerOptions);
	 $result = file_get_contents(LINE_API,FALSE,$context);
	 $res = json_decode($result);
	 return $res;
	}

}
?>
