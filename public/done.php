<?php
error_reporting(E_ALL);

if(count($_FILES)) {
	$to = __DIR__ . '/../logs/' . intval(1000*microtime(true)) . '.done';
	$tmp = $_FILES['file']['tmp_name'];
	$task = $_POST['transform'];
	file_put_contents($to,"$_GET[id] done ($task) " . print_r($_FILES,1) . "\n" . print_r($_POST,1));

	if($err = $_FILES['file']['error']) {
		header("HTTP/1.1 403 Error");
		if($err == UPLOAD_ERR_INI_SIZE) {
			print "Error UPLOAD_ERR_INI_SIZE";
		} else {
			print "Unknwon error $err processing file";
		}
		exit;
	}

	chmod($tmp,0777);
	rename($tmp,__DIR__ .'/../logs/'.basename($_FILES['file']['name']));
	print "saved $tmp at " . basename($_FILES['file']['name']) . "\n";
	print 'OK';
} else {
	print '<form method="POST">Done:<input type="text" name="done-json"></form>';
}

