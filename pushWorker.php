<?php
function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
		curl_setopt ($crl, CURLOPT_PORT,'3333');
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}

$html = get_url_contents("http://54d69050d538f.sn.mynetname.net");
if ($html !== null){
	echo $html;
	} else {
		echo 'cannot check';
	}
?>