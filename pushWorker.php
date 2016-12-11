<?php
function get_url_contents($url){
        $crl = curl_init();
        $timeout = 10;
        curl_setopt ($crl, CURLOPT_URL,$url);
		curl_setopt ($crl, CURLOPT_PORT,'3333');
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

$html = get_url_contents("http://5d69050d538f.sn.mynetname.net");
echo $html;

?>