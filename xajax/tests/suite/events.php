<?php
	/**
	 * events.php
	 * 
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("events.php");
	
	if (isset($_GET['debugging']))
		if (0 != $_GET['debugging'])
			$xajax->setFlag("debug", true);
	if (isset($_GET['status']))
		if (0 != $_GET['status'])
			$xajax->setFlag("statusMessages", true);
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
		
		function addHandler($sId, $sHandler) {
			$objResponse = new xajaxResponse();
			$objResponse->addHandler($sId, "click", $sHandler);
			$objResponse->script('if (undefined != xajax.$("handler'.$sHandler.'")) xajax.dom.assign("handler'.$sHandler.'", "outerHTML", "");');
			$objResponse->append('handlers', 'innerHTML', '<div id="handler'.$sHandler.'">*-- '.$sHandler.' (attached)</div>');
			return $objResponse;
		}
		
		function removeHandler($sId, $sHandler) {
			$objResponse = new xajaxResponse();
			$objResponse->removeHandler($sId, "click", $sHandler);
			$objResponse->clear('handler'.$sHandler, 'outerHTML');
			return $objResponse;
		}
	}
	
	$page = new clsPage();
	
	$xajax->registerCallableObject($page);
	$xajax->processRequest();
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Event Handlers</title>
		<?php $xajax->printJavascript('../../') ?>
		<script type="text/javascript">
			function clickHandlerOne() {
				xajax.$('output').innerHTML += 'message from click handler one<br />';
			}
			function clickHandlerTwo() {
				xajax.$('output').innerHTML += 'message from click handler two<br />';
			}
			function clickDetected() {
				xajax.$('output').innerHTML = '* click *<br />';
				if ('undefined' != typeof clickTimeout)
					clearTimeout(clickTimeout);
				clickTimeout = setTimeout('clearClick();', 4000);
				return true;
			}
			function clearClick() {
				xajax.$('output').innerHTML = '';
				clickTimeout = undefined;
			}
		</script>
		<style>
		.clicker {
			padding: 3px;
			display: table;
			border: 1px outset black;
			font-size: large;
			margin-bottom: 10px;
			cursor: pointer;
		}
		.controls {
			margin-top: 6px;
			margin-bottom: 7px;
		}
		.description {
			margin-top: 4px;
			margin-bottom: 4px;
			font-size: small;
			border: 1px solid #999999;
			padding: 3px;
		}
		</style>
	</head>
	<body>
		<h1>Event Handlers</h1>
		
		<div id='clicker' class='clicker' onclick='return clickDetected();'>Click Here</div>
		<div id='handlers' class='handlers'>
		</div>
		
		<form id='mainForm' onsubmit='return false;'>
			<div id='controls' class='controls'>
				<table>
					<tr>
						<td>One: </td>
						<td align='center'>
							<input type='submit' value='Add' 
								onclick='xajax.call("addHandler", { parameters: ["clicker", "clickHandlerOne"] }); return false;' />
						</td>
						<td align='center'>
							<input type='submit' value='Remove' 
								onclick='xajax.call("removeHandler", { parameters: ["clicker", "clickHandlerOne"] }); return false;' />
						</td>
						<td width='100%'></td>
					</tr>
					<tr>
						<td>Two: </td>
						<td align='center'>
							<input type='submit' value='Add' 
								onclick='xajax.call("addHandler", { parameters: ["clicker", "clickHandlerTwo"] }); return false;' />
						</td>
						<td align='center'>
							<input type='submit' value='Remove' 
								onclick='xajax.call("removeHandler", { parameters: ["clicker", "clickHandlerTwo"] }); return false;' />
						</td>
						<td width='100%'></td>
					</tr>
				</table>
			</div>
		</form>
		
		<div id='output'></div>
		
		<div id='description' class='description'>
		This page tests the ability to attach event handlers to DOM objects.  The DIV above labeled 'Click Here' has an onclick
		event that simply appends *click* to the output area.  To attach additional even handlers, click 'Add' for either event
		handler One, Two or Both.  Event handlers attached to the DIV are listed below it.
		</div>
		
	</body>
</html>
