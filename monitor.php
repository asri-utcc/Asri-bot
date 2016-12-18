<?php
$file="https://dry-sea-41725.herokuapp.com/mon.txt";
$file1 = file_get_contents($file);
$linecount = substr_count($file1,',');
for ($i = 0; $i < $linecount; $i++){
	$z = '';
	$mon1 = before(',',$file1);
	$mon1 = after(' ',$mon1);
	$coinMon = before(' ',$mon1);
	$mon1 = after(' ',$mon1);
	$opt = before(' ',$mon1);
	$mon1 = after(' ',$mon1);
	$price = before(' ',$mon1);
	$cur = after(' ',$mon1);
	if ($cur == 'usd'){$coin = 'USDT_' . strtoupper($coinMon);}
	else {$coin = 'BTC_' . strtoupper($coinMon);}
	$zeth = file_get_contents('https://poloniex.com/public?command=returnTicker');
	
	if (between($coin, '{', $zeth) == '":'){
			$zeth1 = after($coin,$zeth);
			$price1 = between ('last":"', '",', $zeth1);
			if ($opt == 'buy'){
				if($price1 > $price*1.025){
					$z = 'ราคาของ ' . strtoupper($coinMon) . 'กำลังพุ่ง ขายได้ขายเลย' . PHP_EOL . strtoupper($coinMon) . 'ราคา ' . $price1 . ' ' . strtoupper($cur);
				}
			} else if ($opt == 'sell'){
				if($price1 > $price*0.975){
					$z = 'ราคาของ ' . strtoupper($coinMon) . 'กำลังลง มีตังค์รีบซื้อเลย' . PHP_EOL . strtoupper($coinMon) . 'ราคา ' . $price1 . ' ' . strtoupper($cur);
				}
			}		
	} else { $z = strtoupper($coinMon) . 'เหรียญนี้ไม่มีในระบบ Poloniex ค่ะ รีบลบออกด่วน';}
	
	if ($z !== ''){
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
	}
	$file1 = after(',',$file1);
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
function isfloat($num) {
    return is_float($num) || is_numeric($num) && ((float) $num != (int) $num);
	};
?>