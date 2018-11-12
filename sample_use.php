<?php
/*
endpoint : http://bookingbillboard.com/API/merge
Function : This api will combine 2 images picture into 1 picture. This API will Combine
picture of your design/poster/images into the photo of billboard with perfect perspective.

parameter required:
username : to using this API, please sign up , your username is your email
privatekey :when you sign up, you would be received privatekey

sourceimage : Pic if format JPG or PNG, this is your design/poster/photo. Put url link of your images/design/poster/photo
destinationimage : Photo of billboard, put url link for photo

x1 : coordinat Top Left for x position
y1 : coordinat Top Left for y position

x2 : coordinat Top Right for x position
y2 : coordinat Top Right for y position

x3 : coordinat Bottom Left for x position
y3 : coordinat Bottom Left for y position

x4 : coordinat Bottom Right for x position
y4 : coordinat Bottom Right for y position

width : Width of your destination image in pixel
height : Heigth of your destination image in pixel

z : value is 0 or -1. if your destination image is PNG transaparent, use -1 otherwise use 0.
g
*/
$url = 'http://BookingBillboard.com/API/merge/index.php';
$username = "kukuhtw@gmail.com";
$privatekey = "privatekey";
$sourceimage = "http://BookingBillboard.com/API/sample/sample_banner.png"; // you can change this images
$destinationimage = "http://BookingBillboard.com/API/sample/template5.jpg"; // you can change this images too

//top left
$x1 = "298";
$y1 = "36";

//top right	
$x2 = "669";
$y2 = "232";

//bottom left
$x3 = "301";
$y3 = "290";

//bottom right
$x4 = "702";
$y4 = "408";

$width = 750; // in pixel
$height =565;// in pixel

$z = 0;

//create a new cURL resource

//echo '<pre>url:'.$url.'</pre>';

//setup request to send json via POST
$fields = array(
    'username' => $username,
    'privatekey' => $privatekey,
	'sourceimage' => $sourceimage,
	'destinationimage' => $destinationimage,
	'x1' => $x1,
	'y1' => $y1,
	'x2' => $x2,
	'y2' => $y2,
	'x3' => $x3,
	'y3' => $y3,
	'x4' => $x4,
	'y4' => $y4,
	'width' => $width,
	'height' => $height,
	'z' => $z,
		
);

$payload = json_encode(array($fields));
	//echo '<pre>payload:'.$payload.'</pre>';

	
	$fields_string="";
	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	//echo '<pre>fields_string:'.$fields_string.'</pre>';
	
	//echo '<pre>fields:'.$fields.'</pre>';

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	$content = curl_exec($ch);
	$content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content);
	
	echo '<pre>'.$content.'</pre>';
/*
{"succeed":false,"description":"","errormessage":"Sorry, Invalid Credential for username : "}
*/
	
	curl_close($ch);

	$json = json_decode($content, true);
	$succeed = $json['succeed'];
	$filenameoutput = $json['filenameoutput'];
	$description = $json['description'];
	$errormessage = $json['errormessage'];



//echo '<pre>succeed:'.$succeed.'</pre>';
echo '<pre>filenameoutput:'.$filenameoutput.'</pre>';
//echo '<pre>description:'.$description.'</pre>';
//echo '<pre>errormessage:'.$errormessage.'</pre>';

?>

