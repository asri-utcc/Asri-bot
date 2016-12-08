<?php
$access_token = 'pTEHeInoIt5on143F+kYg6D//GGUbrDcPTFtrXQGFLCVFPa3OZbjVBkug2cTevT0EkeCF68zeILcBXw28aiucQco/qtCf6HgfgxIuJX0Lm9TSV8WV6iQdGa1KXFuOQvQ0dbT1tinCAqfC6B8MrGyxgdB04t89/1O/w1cDnyilFU=';
$userID = 'U57bbd5f3aa4dd14369a6969c281e6652';
$url = 'https://api.line.me/v2/bot/message/push';
$messages = [
				'type' => 'text',
				'text' => "Asslamualaikum"
			];
$data = [
				'to' => $replyToken,
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

echo $result;
?>