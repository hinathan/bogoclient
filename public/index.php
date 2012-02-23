<?php

print '<link rel="stylesheet" href="/css/master.css" type="text/css" media="screen" title="no title" charset="utf-8">';

$n = 100;
$info = glob(__DIR__ . '/../logs/*.*');
rsort($info);
$slice = array_slice($info,0,$n);
foreach($slice as $path) {
	if(preg_match('/\.output/',$path)) {
		continue;
	}
	$end = preg_replace('/.+\.(\w+)$/','\1',$path);
	$ts = preg_replace('/[^\d]/','',basename($path));
	$date = date('Y-m-d H:i:s',$ts/1000) . sprintf('.%03d',$ts%1000);
	$content = file_get_contents($path);
	print "<div class=\"$end\">$date: ". htmlentities($content) . "</div>";
}
