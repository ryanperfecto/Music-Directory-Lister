<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Music Lister by Ryan Ormrod</title>
	</head>
<body>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('utf-8');

$errors = array();
$include_dir = dirname(__FILE__).'/includes/';

if(file_exists($include_dir.'music-lister.php')) {
	
	include($include_dir.'music-lister.php');
	if(class_exists('MusicDirectory')) {
		$music = new MusicDirectory();  
	    $music->setMusicDirectory('music');
	    $music->setDatabaseDirectory('database');
	    $music->setDatabaseFile('database.csv');
	    $music->setFilters(array('mp3', 'MP3'));
		$music->setIgnores(array('cgi-bin', '.', '..'));
		$music->getMusicListings();
		// HTML OUTPUT
		$music->showMusicDirectory();
	} else {
		$errors[] = 'Unable to location main class';
	}
} else {
	$errors[] = 'Could not find the class file: ' . $include_dir. 'music-lister.php';
}

if(count($errors)>0) { var_dump($errors); }
?>
</body>
</html>
