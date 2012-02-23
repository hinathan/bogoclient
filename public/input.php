<?php

if(!isset($_GET['id'])) {
	header("HTTP/1.1 404 Not Found");
}

if($_GET['id'] == 'key') {
	header("Content-Type: application/octet-stream");
	fpassthru(fopen(__DIR__ . '/test.key',"r"));
} else if($_GET['id'] == 'pdf') {
		header("Content-Type: application/pdf");
		fpassthru(fopen(__DIR__ . '/test.pdf',"r"));
} else {
	header("Content-Type: text/plain");
	$input = sha1($_GET['id']);
	print $input;
}

$to = __DIR__ . '/../logs/' . intval(1000*microtime(true)) . '.input';
file_put_contents($to,"$_GET[id] vended input: $input");
