<?php
			$zeth = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD');
			$zeth1 = substr($zeth,strrpos($zeth, ':') + 1);
			$z1 = strtok($zeth1, '}');
			if ($z1 < 9.5){
				$z = "ขณะนี้ ETH ราคา " . ($z1 * 35.5) . "บาทค่ะ ราคาต่ำมาก ดองไว้ก่อนค่ะ อย่าเพิ่งขาย";
			} else{$z = "ขณะนี้ ETH ราคา " . ($z1 * 35.5) . "บาทค่ะ ราคาดีหน่อย ขายได้ขายเลยคะ";}


$access_token = 'pTEHeInoIt5on143F+kYg6D//GGUbrDcPTFtrXQGFLCVFPa3OZbjVBkug2cTevT0EkeCF68zeILcBXw28aiucQco/qtCf6HgfgxIuJX0Lm9TSV8WV6iQdGa1KXFuOQvQ0dbT1tinCAqfC6B8MrGyxgdB04t89/1O/w1cDnyilFU=';
$userID = 'U57bbd5f3aa4dd14369a6969c281e6652';
$url = 'https://api.line.me/v2/bot/message/push';
$messages = [
				'type' => 'text',
				'text' => $z
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

echo $result;
?>