<?php
	/**
	 * css.php
	 * 
	 * xajax test script to test the ability to load and unload CSS files.
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("css.php");
	
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
	
	class clsFunctions {
		function clsFunctions() {
		}
		
		function loadCSS1() {
			global $objResponse;
			$objResponse->includeCSS('css1.css');
			$objResponse->assign('outputDIV', 'innerHTML', 'CSS1 loaded.');
			return $objResponse;
		}
		
		function unloadCSS1() {
			global $objResponse;
			$objResponse->removeCSS('css1.css');
			$objResponse->assign('outputDIV', 'innerHTML', 'CSS1 unloaded.');
			return $objResponse;
		}
		
		function loadCSS2() {
			global $objResponse;
			$objResponse->includeCSS('css2.css');
			$objResponse->assign('outputDIV', 'innerHTML', 'CSS2 loaded.');
			return $objResponse;
		}
		
		function unloadCSS2() {
			global $objResponse;
			$objResponse->removeCSS('css2.css');
			$objResponse->assign('outputDIV', 'innerHTML', 'CSS2 unloaded.');
			return $objResponse;
		}
	}
	
	$functions = new clsFunctions();
	
	$xajax->registerCallableObject($functions);
	$xajax->processRequest();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>xajax Test Suite</title>
		<?php $xajax->printJavascript('../../'); ?>
		<style type='text/css'>
		.initiallyHidden {
			visibility: hidden;
		}
		</style>
	</head>
	<body>
		<button class='loadCSS1' onclick='xajax.call("loadCSS1", { });'>Load CSS1</button><br />
		<button class='unloadCSS1 initiallyHidden' onclick='xajax.call("unloadCSS1", { });'>Unload CSS1</button><br />
		<button class='loadCSS2' onclick='xajax.call("loadCSS2", { });'>Load CSS2</button><br />
		<button class='unloadCSS2 initiallyHidden' onclick='xajax.call("unloadCSS2", { });'>Unload CSS2</button><br />

		<div class='output' id='outputDIV'></div>
	</body>
</html>