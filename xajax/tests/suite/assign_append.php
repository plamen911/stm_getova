<?php
	/**
	 * alert_confirm.php
	 * 
	 * xajax test script to test xajax response commands that display alert 
	 * messages, prompt dialogs and the confirm_commands.
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("assign_append.php");
	
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
		
		function sendAssignInnerHTML() {
			global $objResponse;
			$objResponse->assign("content", "innerHTML", "Message from the php function sendAssignInnerHTML.");
			return $objResponse;
		}
		
		function sendAssignStyleBackground($color) {
			global $objResponse;
			$objResponse->assign("content", "style.backgroundColor", $color);
			return $objResponse;
		}
		
		function sendAssignOuterHTML() {
			global $objResponse;
			$objResponse->assign("content", "innerHTML", "<div id=\"ImStaying\">This div should appear and remain here.</div><div id=\"ReplaceMe\">This div should appear then disappear.</div><div id=\"ImNotGoing\">This div should appear and remain here also.</div>");
			$objResponse->assign("ReplaceMe", "outerHTML", "<div id=\"TheReplacement\">Successfully replaced the old element with this element via outerHTML</div>");
			return $objResponse;
		}
		
		function sendAppendInnerHTML() {
			global $objResponse;
			$objResponse->append("content", "innerHTML", "<div>This div should be appended to the end.</div>");
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
		<style>
		#content {
			border: 1px solid #555555;
		}
		</style>
	</head>
	<body>
		<a href='#' onclick='xajax.call("sendAssignInnerHTML"); return false;'>Update Content via an assign on the innerHTML property.</a><br />
		Update style.background property via assign: 
		<a href='#' onclick='xajax.call("sendAssignStyleBackground", {parameters: ["#ff8888"]}); return false;'>Red</a>
		<a href='#' onclick='xajax.call("sendAssignStyleBackground", {parameters: ["#88ff88"]}); return false;'>Green</a>
		<a href='#' onclick='xajax.call("sendAssignStyleBackground", {parameters: ["#8888ff"]}); return false;'>Blue</a>
		<a href='#' onclick='xajax.call("sendAssignStyleBackground", {parameters: ["#ffffff"]}); return false;'>White</a>
		<br />
		<a href='#' onclick='xajax.call("sendAssignOuterHTML"); return false;'>Test an update using the outerHTML property.</a><br />
		<br />
		<a href='#' onclick='xajax.call("sendAppendInnerHTML"); return false;'>Test an append using the innerHTML property.</a><br />
		<br />
		<div id='content'>This content has not been modified, click an option above to execute a test.</div>
	</body>
</html>

