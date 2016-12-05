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
			$z='';
			$zeth = file_get_contents('http://dwarfpool.com/eth/api?wallet=0xe331cae9bde726414985883aa5b5d40abc22c09a&email=asri.utcc@gmail.com');
			$tmp = after(':',$zeth);
			$zeth1 = before(',',$tmp);
			$tmp = after(':',$tmp);
			$zeth1 = before(',',$tmp);
			$z = "ความเร็วรวมทั้งหมด" . $zeth1 . " Mh/s" . PHP_EOL;
			$tmp = after(':',$tmp);
			$zeth1 = before(',',$tmp);
			$z = $z . "ความเร็วรวมคำนวน" . $zeth1 . " Mh/s" . PHP_EOL;
			$tmp = after(':',$tmp);
			$zeth1 = before(',',$tmp);
			$z = $z . "ความเร็วรวมคำนวน" . $tmp . PHP_EOL;
			//$zeth2 = substr($zeth1,strrpos($zeth1, ',') + 1);
			//$zeth3 = substr($zeth2,strrpos($zeth2, '"') + 1);
			//$z1 = strtok($zeth3, ';');
			/*if ($zeth1 !== ''){
				//$z = "ความเร็วของเครื่องขุด darkas888 ตอนนี้คือ " . ($z1 / 1024) . "Mh/s";
				$z = $zeth1;
			} else{$z = "เครื่อง daraks888 ดับค่ะ";}*/
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
	
function after ($this, $inthat)
    {
        if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat,$this)+strlen($this));
    };

function after_last ($this, $inthat)
    {
        if (!is_bool(strrevpos($inthat, $this)))
        return substr($inthat, strrevpos($inthat, $this)+strlen($this));
    };

function before ($this, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $this));
    };

function before_last ($this, $inthat)
    {
        return substr($inthat, 0, strrevpos($inthat, $this));
    };

function between ($this, $that, $inthat)
    {
        return before ($that, after($this, $inthat));
    };

function between_last ($this, $that, $inthat)
    {
     return after_last($this, before_last($that, $inthat));
    };

// use strrevpos function in case your php version does not include it
function strrevpos($instr, $needle)
{
    $rev_pos = strpos (strrev($instr), strrev($needle));
    if ($rev_pos===false) return false;
    else return strlen($instr) - $rev_pos - strlen($needle);
};
echo "OK";
?>