<?php

$token = filter_input(INPUT_GET, "token");
if (strlen($token) > 0) {
	try {
		$c = curl_init();
		$root = "http://localhost/dgmtv/";
		$url = $root . "rstpswd.php?t=" . $token;
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_HEADER, 0);
		curl_exec($c);
		curl_close($c);
	} catch (Exception $e) {
		echo $e->getTraceAsString();
	}
}
