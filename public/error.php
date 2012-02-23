<?php

if(isset($_POST['error-json'])) {
	$to = __DIR__ . '/../logs/' . intval(1000*microtime(true)) . '.error';
	file_put_contents($to,$_POST['error-json']);
	print "OK";
} else {
	print '<form method="POST">Error:<input type="text" name="error-json"></form>';
}

