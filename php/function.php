<?php
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function autolink($str, $attributes = array()) {
	$attrs = '';
	foreach ($attributes as $attribute=>$value) {
		$attrs .= " {$attribute}=\"{$value}\"";
	}

	$str = ' '.$str;
	$str = preg_replace('`([^"=\'>])((http|https|ftp|ftps)://[^\s< ]+[^\s<\.)])`i', '$1<a href="$2" rel="external nofollow" '.$attrs.'>$2</a>', $str);
	$str = substr($str, 1);

	return $str;
}

?>