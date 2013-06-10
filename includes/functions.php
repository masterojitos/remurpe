<?php
function mo_scape($text){
	if(!get_magic_quotes_gpc()) $text = addslashes($text);
	return trim($text);
}

function mo_unscape($text){
	return htmlspecialchars($text);
}