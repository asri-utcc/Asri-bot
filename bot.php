<?php
$access_token = 'pTEHeInoIt5on143F+kYg6D//GGUbrDcPTFtrXQGFLCVFPa3OZbjVBkug2cTevT0EkeCF68zeILcBXw28aiucQco/qtCf6HgfgxIuJX0Lm9TSV8WV6iQdGa1KXFuOQvQ0dbT1tinCAqfC6B8MrGyxgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => text($text)
			];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
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
			
			echo $result . "\r\n";
		}
	}
}
function text($text) {
    $myfile = fopen("listword.txt", "r") or die("Unable to open file!");
	//echo fread($myfile,filesize("webdictionary.txt"));
	//$zTmp = fgets($myfile);	
	
	if (strpos($text, 'eth') !== false) {
			$zeth = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD');
			$zeth1 = substr($zeth,strrpos($zeth, ':') + 1);
			$z1 = strtok($zeth1, '}');
			if ($z1 < 9.5){
				$z = "ETH ตอนนี้ราคา " . ($z1 * 35.5) . "บาทค่ะ ราคาต่ำมาก ดองไว้ก่อนค่ะ อย่าเพิ่งขาย";
			} else{$z = "ETH ตอนนี้ราคา " . ($z1 * 35.5) . "บาทค่ะ ราคาดีหน่อย ขายได้ขายเลยคะ";}
		}
	else if (strpos($text, 'btc') !== false) {
			$zeth = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD');
			$zeth1 = substr($zeth,strrpos($zeth, ':') + 1);
			$z1 = strtok($zeth1, '}');
			if ($z1 < 700){
				$z = "BTC ตอนนี้ราคา " . ($z1 * 35.5) . "บาทค่ะ ราคาต่ำมาก ดองไว้ก่อนค่ะ อย่าเพิ่งขาย";
			} else{$z = "BTC ตอนนี้ราคา " . ($z1 * 35.5) . "บาทค่ะ ราคาดีหน่อย ขายได้ขายเลยคะ";}
		}
	else if (strpos($text, 'check') !== false) {
			$zeth = file_get_contents('http://5d69050d538f.sn.mynetname.net:3333/');
			$zeth1 = substr($zeth,strrpos($zeth, ',') + 1);
			$zeth2 = substr($zeth1,strrpos($zeth1, ',') + 1);
			$zeth3 = substr($zeth2,strrpos($zeth2, '"') + 1);
			$z1 = strtok($zeth3, ';');
			if ($z1 !== ''){
				$z = "ความเร็วของเครื่องขุด darkas888 ตอนนี้คือ " . ($z1 / 1024) . "Mh/s";
			} else{$z = "เครื่อง daraks888 ดับค่ะ";}
		}
	else {
			while (($zTmp = fgets($myfile)) !== false) {
				$first = strtok($zTmp, '.');
				if (strpos($text, $first) !== false) {
					$z = substr($zTmp,strrpos($zTmp, '.') + 1);
					break;
				}else {
					$z = "อาอิชคนสวยไม่ว่างตอบคะ";
				}
			}
	}
	
	
	fclose($myfile);
    return $z;
	}
echo "OK";
?>