<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8" />
<title><?=SITE_NAME?></title>
<link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
<!--
#navbar {
	margin-top:-5px;
}
-->
</style>
<!--[if IE]>
<style type="text/css">
#navbar {
	margin-top:-4px;
	padding-top:4px;
}
</style>
<![endif]-->
<script type="text/javascript" src="js/RegExpValidate.js"></script>
<!-- http://jquery.com/demo/thickbox/ -->
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript" src="js/thickbox/thickbox.js"></script>
<link rel="stylesheet" href="js/thickbox/thickbox.css" type="text/css" media="screen" />
<?php if(isset($echoJS)) echo $echoJS; ?>
<script type="text/javascript">
//<![CDATA[
function stripTable(tableid) {
	// Strip table
	$("#"+tableid+" tr:even").addClass("alternate");
	// Hightlight table rows
	$("#"+tableid+" tr").not(".notover").hover(function() {
		$(this).addClass("over");
	},function() {
		$(this).removeClass("over");
	});
}
function removeLine(childID) {
	theChild = document.getElementById(childID);
	theChild.parentNode.removeChild(theChild);
	return false;
}
$(document).ready(function() {
	if($.browser.msie) {
		$("input[type='text']:disabled,textarea:disabled,select:disabled").css("background-color", "#EEEEEE");
		$(":checkbox").css("border","none");
	}
	<?php
	if('login.php' == basename($_SERVER['PHP_SELF']) && (file_exists('upd.xml') || file_exists('upd.php'))) {
		echo 'document.getElementById("errmsg").innerHTML="Актуализация на системата. Моля, изчакайте...";';
		echo 'document.getElementById("errmsg").style.visibility="visible";';
		echo 'xajax_updData();';
		echo 'DisableEnableForm(true);';
	}
	if(isset($_SESSION['sess_exp_days'])) {
		// Show popup
		echo "tb_show('Списък на договорите, изтичащи след $_SESSION[sess_exp_days] дни','popup_exp_contracts.php?exp_days=$_SESSION[sess_exp_days]&amp;".SESS_NAME.'='.session_id()."&amp;KeepThis=true&amp;TB_iframe=true&amp;height=480&amp;width=790&amp;modal=true',0);";
		unset($_SESSION['sess_exp_days']);
	}
	?>
});
//]]>
</script>
</head>
<body>
<?php if(isset($_SESSION['sess_user_level'])) { /* User is logged-in */ ?>
<div align="right" style="padding-right:8px;" id="loggedinfo">Потребител: <?=(('demo' == $_SESSION['sess_user_name'])?$_SESSION['sess_fname']:HTMLFormat($_SESSION['sess_fname'].' '.$_SESSION['sess_lname']))?>&nbsp;</div>
<div id="contentWrapper">
  <div id="navbar">
    <ul>
      <li class="<?=((in_array(basename($_SERVER['PHP_SELF']), array('firms.php', 'firm_info.php')))?'active':'adminmenu')?>"><a href="firms.php" title="Списък на отделните фирми">Фирми</a></li>
      <li class="<?=((basename($_SERVER['PHP_SELF'])=='official_data.php')?'active':'adminmenu')?>"><a href="official_data.php">Служебни данни</a></li>
      <?php if('1' == SHOW_ACCOUNTING_APP) { ?><li class="adminmenu"><a href="acc_payments.php">Счетоводна програма</a></li><?php } ?>
      <li class="adminmenu"><a href="login.php?logout=1">Изход</a></li>
    </ul>
  </div>
  <?php } else { /* User is NOT logged-in */ ?>
<script type="text/javascript">
//<![CDATA[
function triggerLogin(e) { //e is event object passed from function invocation
	var code;
	if (!e) var e = window.event;
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	if(code == 13){ //if generated character code is equal to ascii 13 (if enter key)
		xajax_login(xajax.getFormValues('frmLogin'));
		//DisableEnableForm(true); //submit the form
		return false;
	}
	else{
		return true;
	}
}
$(function() {
	$("#user_name").focus();
});
//]]>
</script>
<div align="right" style="padding-right:8px;visibility:hidden;height:40px;" id="loggedinfo">&nbsp;</div>
<div id="contentWrapper">
  <?php } ?>
  <div id="contentinner" align="center"> <br clear="all" />