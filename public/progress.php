<?php

if(isset($_POST['progress-json'])) {
	$to = __DIR__ . '/../logs/' . intval(1000*microtime(true)) . '.progress';
	file_put_contents($to,"$_GET[id] progress: " . stripslashes($_POST['progress-json']));
	print "OK";
} else {
	print '<form method="POST">Progress:<input type="text" name="progress-json"></form>';
}

