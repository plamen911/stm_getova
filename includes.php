<?php
require ("config.php");
require ("functions.php");
require ("sqlitedb.php");
require ("convertroman.php");

// Switch to HTTPS
if (!isset($_SERVER['HTTPS']) || 'on' !== strtolower($_SERVER['HTTPS'])) {
    header('Location: ' . SECURE_URL . basename($_SERVER['PHP_SELF']) . ((!empty($_SERVER['QUERY_STRING'])) ? '?' . $_SERVER['QUERY_STRING'] : ''));
    exit();
}

if(in_array(basename($_SERVER['PHP_SELF']), array('login.php', 'acc_login.php'))) {
	ini_set('memory_limit', '64M');
}

my_session_start();

$preff = (preg_match('/^acc_/i', basename($_SERVER['PHP_SELF']))) ? 'acc_' : '';

if (!isset($_SESSION['sess_user_id']) && (!in_array(basename($_SERVER['PHP_SELF']), array($preff.'login.php', 'autocompleter.php')))) {

	if(preg_match('/^popup_/', basename($_SERVER['PHP_SELF']))) {
		echo '<script type="text/javascript">'."\n";
		echo 'parent.location = \'index.php\';'."\n";
		echo '</script>';
	} else {
		$params = (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']!='') ? '?'.$_SERVER['QUERY_STRING'] : '';
		header('Location:'.$preff.'login.php?accessdenied='.urlencode(basename($_SERVER['PHP_SELF']).$params));
	}
	exit();
}

$dbInst = new SqliteDB();
