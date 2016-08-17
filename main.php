<?php
$text = plugin_load("renderer", "text");
// Try to render with text plugin first
if (!@$_REQUEST["do"] && $text != null) {
	$id = $_SERVER["QUERY_STRING"];
	$id = str_replace("/", ":", $id);
	$id = str_replace("id=", "", $id);
	$file = wikiFN($id);
	$str = p_cached_output($file,'text');
	$contentType = "text/plain";
	if (isset($GLOBALS["contentType"])) {
		$contentType = $GLOBALS["contentType"];
	}
	if (!headers_sent()) header("Content-Type: $contentType");
	echo $str;
} else
if (!@$_REQUEST["do"]) {
	ob_start();
	tpl_content(false);
	$str = ob_get_contents();
	ob_end_clean();
	$str = trim(strip_tags($str));
	$contentType = "text/plain";
	if (isset($GLOBALS["contentType"])) {
		$contentType = $GLOBALS["contentType"];
	}
	if (!headers_sent()) header("Content-Type: $contentType");
	echo $str;
} else {
	include(__DIR__ . "/editor.php");
}
?>