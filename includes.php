<?php
require("config.php");
require("functions.php");
require("sqlitedb.php");
require("convertroman.php");

if (isset($_SERVER['SERVER_ADMIN']) && 'webmaster@hipokrat.net' == $_SERVER['SERVER_ADMIN']) {
    // Switch to HTTPS
    if (!isset($_SERVER['HTTPS']) || 'on' !== strtolower($_SERVER['HTTPS'])) {
        header('Location: ' . SECURE_URL . basename($_SERVER['PHP_SELF']) . ((!empty($_SERVER['QUERY_STRING'])) ? '?' . $_SERVER['QUERY_STRING'] : ''));
        exit();
    }
}

if (in_array(basename($_SERVER['PHP_SELF']), array('login.php', 'acc_login.php'))) {
    ini_set('memory_limit', '64M');
}

my_session_start();

$preff = (preg_match('/^acc_/i', basename($_SERVER['PHP_SELF']))) ? 'acc_' : '';

if (!isset($_SESSION['sess_user_id']) && (!in_array(basename($_SERVER['PHP_SELF']), array($preff . 'login.php', 'autocompleter.php')))) {

    if (preg_match('/^popup_/', basename($_SERVER['PHP_SELF']))) {
        echo '<script type="text/javascript">' . "\n";
        echo 'parent.location = \'index.php\';' . "\n";
        echo '</script>';
    } else {
        $params = (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') ? '?' . $_SERVER['QUERY_STRING'] : '';
        header('Location:' . $preff . 'login.php?accessdenied=' . urlencode(basename($_SERVER['PHP_SELF']) . $params));
    }
    exit();
}

$dbInst = new SqliteDB();

// Require the idiorm file
require('idiorm.php');
// Connect to the demo database file
ORM::configure('sqlite:./db/stm.db');

$added_by = $modified_by = $updated_by = (isset($_SESSION['sess_user_id'])) ? $_SESSION['sess_user_id'] : 0;
$added_by_txt = $modified_by_txt = $updated_by_txt = (isset($_SESSION['sess_fname'])) ? $dbInst->checkStr($_SESSION['sess_fname'] . ' ' . $_SESSION['sess_lname']) : '';
$added_on = $modified_on = $updated_on = date('Y-m-d H:i:s');
$added_from_ip = $updated_from_ip = (isset($_SERVER['REMOTE_ADDR'])) ? $dbInst->checkStr($_SERVER['REMOTE_ADDR']) : $_SERVER['REMOTE_ADDR'];
