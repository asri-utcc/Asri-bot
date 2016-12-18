<?php
function get_url_contents($url,$port){
        $crl = curl_init();
        $timeout = 10;
        curl_setopt ($crl, CURLOPT_URL,$url);
		curl_setopt ($crl, CURLOPT_PORT,$port);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        
		if(curl_error($crl)){
			$ret = 'error:' . curl_error($crl);
		}else {
			$ret = curl_exec($crl);
		}
        curl_close($crl);
        return $ret;
}
$x1=0;
while($x1 <= 2) {
	$html = get_url_contents("http://5d69050d538f.sn.mynetname.net",'3333');
	$z1 = substr($html,34,6);
	$x1++;
	if ($z1 !== 'result'){
		sleep(30);
	}	else {
		$x1 = 10;
	}
	
}
$x2=0;
while($x2 <= 2) {
	$html = get_url_contents("http://5d69050d538f.sn.mynetname.net",'3334');
	$z2 = substr($html,34,6);
	$x2++;
	if ($z2 !== 'result'){
		sleep(30);
	}	else {
		$x2 = 10;
	}
	
}
if($x2 !== 10){
$z='เครื่อง asri-rig2 ดับ รีบจัดการด่วน';
$access_token = 'pTEHeInoIt5on143F+kYg6D//GGUbrDcPTFtrXQGFLCVFPa3OZbjVBkug2cTevT0EkeCF68zeILcBXw28aiucQco/qtCf6HgfgxIuJX0Lm9TSV8WV6iQdGa1KXFuOQvQ0dbT1tinCAqfC6B8MrGyxgdB04t89/1O/w1cDnyilFU=';
$userID = 'U57bbd5f3aa4dd14369a6969c281e6652';
$url = 'https://api.line.me/v2/bot/message/push';
$messages = [
				'type' => 'text',
				'text' => $z . PHP_EOL . "ผลลัพธ์ " . $x2
			];
$data = [
				'to' => $userID,
				'messages' => [$messages],
			];
$post = json_encode($data);
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
}
if($x1 !== 10){
$z='เครื่อง darkas888 ดับ รีบจัดการด่วน';
$access_token = 'pTEHeInoIt5on143F+kYg6D//GGUbrDcPTFtrXQGFLCVFPa3OZbjVBkug2cTevT0EkeCF68zeILcBXw28aiucQco/qtCf6HgfgxIuJX0Lm9TSV8WV6iQdGa1KXFuOQvQ0dbT1tinCAqfC6B8MrGyxgdB04t89/1O/w1cDnyilFU=';
$userID = 'U57bbd5f3aa4dd14369a6969c281e6652';
$url = 'https://api.line.me/v2/bot/message/push';
$messages = [
				'type' => 'text',
				'text' => $z . PHP_EOL . "ผลลัพธ์ " . $x1
			];
$data = [
				'to' => $userID,
				'messages' => [$messages],
			];
$post = json_encode($data);
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
}
echo $result;
?>
