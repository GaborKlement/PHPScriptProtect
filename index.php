<?php

function getString($length) {
	if ($length == null) $length = 5;
	$characters = array_merge(range('A', 'Z'), range(1,9));
	for ($i = 0; $i < $length; $i++) {
		$string.= $characters[array_rand($characters)];
	}		   
	return $string;
}

$dir = "config/";

if (is_dir($dir)) {
	if ($dh = opendir($dir)) {
		while (($file = readdir($dh)) !== false) {
			if (is_file($dir.'/'.$file) && $file != "." && $file != "..") {
				if ($file!=".DS_Store") {
					$originalFile = $file;
				}
			}          			
		}
		closedir($dh);
	}
}

$oldName = $dir.$originalFile;

if (!isset($_COOKIE["protection"])) {
	$newName = $dir.'config_'.getString().'.php';
	rename($oldName, $newName);
	setcookie("protection", $newName, time()+3600, "/");
} else {
	$newName = $oldName;
//	setcookie("protection", null, -1, "/");
}

include($newName);

echo $message;

?>