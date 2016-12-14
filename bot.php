<?php
include('simple_html_dom.php');
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
	
	
	if (strpos($text, 'mon') !== false) {
	if (before(' ', $text) == 'mon' && str_word_count($text) == 4 && (between(' ', ' ', $text) == 'eth' || between(' ', ' ', $text) == 'btc') ){
				/*$myfile1 = fopen("mon.txt", "a+") or die("Unable to open file!");
				fwrite($myfile1, $text);
				fclose($myfile1);*/
				$z = "FN";
			} else {
				$z = "วิธีการใช้คำสั้ง mon คือ" . PHP_EOL . "mon <eth,btc> <buy,sell> price " . ctype_digit (after_last(' ', $text));
				}
		}
	else if (strpos($text, 'eth') !== false) {
			$zeth = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=USD');
			$zeth1 = substr($zeth,strrpos($zeth, ':') + 1);
			$z1 = strtok($zeth1, '}');
			if ($z1 < 9.5){
				$z = "ETH ตอนนี้ราคา $" . $z1 . PHP_EOL . "หรือประมาน " . ($z1 * 35.5) . "บาทค่ะ ราคาต่ำมาก จะ sell ก็ระวังหน่อยนะคะ";
			} else{
				$z = "ETH ตอนนี้ราคา $" . $z1 . PHP_EOL . "หรือประมาน " . ($z1 * 35.5) . "บาทค่ะ ราคาดีหน่อย จะ Buy ก็ระวังหน่อยนะคะ";}
		}
	else if (strpos($text, 'btc') !== false) {
			$zeth = file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD');
			$zeth1 = substr($zeth,strrpos($zeth, ':') + 1);
			$z1 = strtok($zeth1, '}');
			if ($z1 < 700){
				$z = "BTC ตอนนี้ราคา $" . $z1 . PHP_EOL . "หรือประมาน " . ($z1 * 35.5) . "บาทค่ะ ราคาต่ำมาก ดองไว้ก่อนค่ะ อย่าเพิ่งขาย";
			} else{
				$z = "BTC ตอนนี้ราคา $" . $z1 . PHP_EOL . "หรือประมาน " . ($z1 * 35.5) . "บาทค่ะ ราคาดีหน่อย ขายได้ขายเลยคะ";}
		}
	else if (strpos($text, 'check') !== false || strpos($text, 'ขุด') !== false) {
			$z = check();
		}
	else if (strpos($text, 'dwar') !== false || strpos($text, 'เงิน') !== false) {
			$z = dwarfpool();
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
	
   
function  check ()
    {
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
		$tmp = after(',',$tmp);
		$tmp = after('  ',$tmp);
		$z = $z . "----------------------------------------" . PHP_EOL;
		if (before(':',$tmp) == '"workers"'){
			$workers = substr_count($tmp,'{') - 1;
			$z = $z . "แท่นขุดในรายการจำนวน " . $workers . " เครื่อง" . PHP_EOL;
			$tmp = after('{',$tmp);
			$z = $z . "----------------------------------------" . PHP_EOL;
			for ($i = 0 ; $i < $workers ; $i++){
				$worker_name = between('"', '"', $tmp);
				$z = $z . ($i + 1) . " ชื่อ " . $worker_name . PHP_EOL;
				$tmp = after('"alive": ',$tmp);
				if (before(',',$tmp) == 'true'){
					$z = $z . "เครื่องทำงานปกติ" . PHP_EOL ;
				} else {
					$z = $z . "เครื่องดับ" . PHP_EOL ;
					}
				$tmp = after(',',$tmp);
				$hash = between('"hashrate": ', ',', $tmp);
				$z = $z . "HashRate " . $hash . " Mh/s" . PHP_EOL;
				$tmp = after(',',$tmp);
				$tmp = after(',',$tmp);
				$hash = between('"hashrate_calculated": ', ',', $tmp);
				$z = $z . "Hash Calc " . $hash . " Mh/s" . PHP_EOL;
				$tmp = after(',',$tmp);
				$tmp = after(',',$tmp);
				$sec = between('"second_since_submit": ', ',', $tmp);
				$z = $z . "ตรวจสอบล่าสุดเมื่อ " . (int)($sec / 60) . " นาทีที่แล้ว" . PHP_EOL;
				$tmp = after('},',$tmp);
				$z = $z . "----------------------------------------" . PHP_EOL;					
			}
			
		}
		return $z;
   };	
	
function dwarfpool ()
    {
        $unbal = "0 ETH";
			$html = get_url_contents("http://dwarfpool.com/eth/address?wallet=0xe331cae9bde726414985883aa5b5d40abc22c09a");
			$html = after('Earnings',$html);
			$html = substr($html,0,651);
			
			$html = after("badge badge",$html);
			$balance = between ('money">', '</span', $html);
			
			$html = after("badge badge",$html);
			if (strpos($html, 'but') !== true){
				$alpaid = between ('money">', '</span', $html);
			} else {
				$unbal = between ('money">', '</span', $html);
				$html = after("badge badge",$html);
				$alpaid = between ('money">', '</span', $html);
			}
			
			$html = after("badge badge",$html);
			$uncon = between ('money">', '</span', $html);
			
			$html = after("badge badge",$html);
			$e24h = between ('money">', '<br', $html);
			
			
			$html = after('75%;">',$html);
			$btc = between ('Rates ', ' &', $html);
			$usd = between ('; ', ' $', $html);
			$z = "----------------------------------------" . PHP_EOL;
			$z = "ยอดเงินขุดตอนนี้ " . $balance . PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;			
			$z = $z . "ยอดเงินที่ขุดแล้วแต่ยังไม่ได้ " .  $unbal . PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;
			$z = $z . "ยอดเงินที่จ่ายแล้ว " .  $alpaid . PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;
			$z = $z . "ยอดที่ยังไม่ยืนยัน " .  $uncon . PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;
			$z = $z . "ยอดในรอบ24ชม. " .  $e24h . PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;
			$z = $z . "ราคาเป็น BTC " .  $btc . " BTC" .  PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;
			$z = $z . "ราคาเป็น USD " .  $usd . " $" .  PHP_EOL;
			$z = $z . "----------------------------------------" . PHP_EOL;
        return $z;
    };
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
function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}
echo "OK";
?>