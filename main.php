<?php
$text = plugin_load("renderer", "text");
// Try to render with text plugin first
if (!@$_REQUEST["do"] && $text != null) {
	header("Content-Type: text/plain");
	$id = $_SERVER["QUERY_STRING"];
	$id = str_replace("/", ":", $id);
	$id = str_replace("id=", "", $id);
	$file = wikiFN($id);
	$str = p_cached_output($file,'text');	
	echo $str;
} else
if (!@$_REQUEST["do"]) {
	header("Content-Type: text/plain");
	ob_start();
	tpl_content(false);
	$str = ob_get_contents();
	ob_end_clean();
	$str = trim(strip_tags($str));
	echo $str;
} else {
	tpl_content(false);
}
?>