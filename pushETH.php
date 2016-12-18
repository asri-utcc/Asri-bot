<?php
			$zeth = file_get_contents('https://poloniex.com/public?command=returnTicker');
			$zeth1 = after("BTC_ETH",$zeth);
			$z2 = between ('last":"', '",', $zeth1);
			$zeth1 = after("USDT_ETH",$zeth);
			$z1 = between ('last":"', '",', $zeth1);
			$z1 = number_format((float)$z1, 2, '.', '');
			if ($z1 < 9.5){
				$z = "ETH ตอนนี้ราคา $" . $z1 . PHP_EOL . "หรือ " . $z2 . " btc ค่ะ" . PHP_EOL . "หรือประมาน " . number_format((float)($z1 * 35.5), 2, '.', '') . " บาทค่ะ" . PHP_EOL . "ราคาต่ำมาก จะ sell ก็ระวังหน่อยนะคะ";
			} else{
				$z = "ETH ตอนนี้ราคา $" . $z1 . PHP_EOL . "หรือ " . $z2 . " btc ค่ะ" . PHP_EOL . "หรือประมาน " . number_format((float)($z1 * 35.5), 2, '.', '') . " บาทค่ะ" . PHP_EOL . "ราคาดีหน่อย จะ Buy ก็ระวังหน่อยนะคะ";}


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
