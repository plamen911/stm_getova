<?php
	/**
	 * alert_confirm.php
	 * 
	 * xajax test script to test xajax response commands that display alert 
	 * messages, prompt dialogs and the confirm_commands.
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("alert_confirm.php");
	
	if (isset($_GET['debugging']))
		if (0 != $_GET['debugging'])
			$xajax->setFlag("debug", true);
	if (isset($_GET['status']))
		if (0 != $_GET['status'])
			$xajax->setFlag("statusMessages", true);
	if (isset($_GET['hooks']))
		if (0 != $_GET['hooks'])
			$xajax->setFlag("hooksComponent", true);
	if (isset($_GET['useEncoding']))
		$xajax->setCharEncoding($_GET['useEncoding']);
	if (isset($_GET['outputEntities']))
		$xajax->setFlag("outputEntities", $_GET['outputEntities']);	
	if (isset($_GET['decodeUTF8Input']))
		$xajax->setFlag("decodeUTF8Input", $_GET['decodeUTF8Input']);
		
	$objResponse = new xajaxResponse($xajax->getCharEncoding(), $xajax->getFlag("outputEntities"));
	
	class clsPage {
		function clsPage() {
		}
		
		function sendAlert() {
			global $objResponse;
			$objResponse->alert("Message from the php function sendAlert.");
			return $objResponse;
		}
		
		function sendConfirmCommands() {
			global $objResponse;
			$objResponse->confirmCommands(1, 'Do you want to see an alert next?');
			$objResponse->alert("Here is the alert!");
			return $objResponse;
		}
	}
	
	$page = new clsPage();
	
	$xajax->registerCallableObject($page);
	$xajax->processRequest();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>xajax Test Suite</title>
		<?php $xajax->printJavascript('../../'); ?>
	</head>
	<body>
		<a href='#' onclick='xajax.call("sendAlert"); return false;'>Send Alert</a><br />
		<a href='#' onclick='xajax.call("sendConfirmCommands"); return false;'>Send Confirm Commands</a><br />
	</body>
</html>

