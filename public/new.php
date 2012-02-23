<?php

$input_id = substr(sha1(rand()),0,5);
$input_id = 'key';
//$input_id = 'pdf';

$base = 'http://' . $_SERVER['HTTP_HOST'];
$post = array(
	'done_url' => $base . '/done.php?id=' . $input_id,
	'error_url' => $base . '/error.php?id=' . $input_id,
	'progress_url' => $base . '/progress.php?id=' . $input_id,
	'input_url' => $base . '/input.php?id=' . $input_id,
	'customer_id' => 0,
	'transforms' => 'slowreverse,reverse',
	'transforms' => 'reverse,say',
	//	'transforms' => 'slowestreverse,slowerreverse,slowreverse,reverse',
);

if($input_id == 'key') {
	$post['transforms'] = 'keynotetojpg,keynotetopdf';
	//$post['transforms'] = 'keynotetojpg';
}
if($input_id == 'pdf') {
	$post['transforms'] = 'pdftoocrpdf';
}

$to = __DIR__ . '/../logs/' . intval(1000*microtime(true)) . '.new';
file_put_contents($to,"$input_id created new");

$post_to = 'http://convertallthethings.local/api/v1/createjob';
$ch = curl_init($post_to);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
print "<pre>$result</pre>";
print "<hr>";
print "<pre>";
var_dump(curl_getinfo($ch));
print "</pre>";
