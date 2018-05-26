<?php
	/**
	 * alert_confirm.php
	 * 
	 * xajax test script to test delay event functions that are fired when the
	 * server takes long enough (or too long, in the case of the abort function).
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("delayEvents.php");
	
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
		
		function shortDelay($sleepTimes) {
			global $objResponse;
			foreach ($sleepTimes AS $sleepTime)
				sleep($sleepTime);
			$objResponse->append('log', 'innerHTML', 'Message from server: Request completed before abort.<br />');
			$objResponse->call('finished', $sleepTimes);
			return $objResponse;
		}
		
		function mediumDelay($sleepTimes) {
			global $objResponse;
			foreach ($sleepTimes AS $sleepTime)
				sleep($sleepTime);
			$objResponse->append('log', 'innerHTML', 'Message from server: Request completed before abort.<br />');
			$objResponse->call('finished', $sleepTimes);
			return $objResponse;
		}
		
		function longDelay() {
			global $objResponse;
			sleep(15);
			$objResponse->append('log', 'innerHTML', 'Message from server: Request completed before abort.<br />');
			return $objResponse;
		}
		
		function shortDelayS() {
			global $objResponse;
			sleep(5);
			$objResponse->append('log', 'innerHTML', 'Message from server: Request completed before abort.<br />');
			$objResponse->setReturnValue('shortDelayS');
			return $objResponse;
		}
		
		function mediumDelayS() {
			global $objResponse;
			sleep(9);
			$objResponse->append('log', 'innerHTML', 'Message from server: Request completed before abort.<br />');
			$objResponse->setReturnValue('mediumDelayS');
			return $objResponse;
		}
		
		function longDelayS() {
			global $objResponse;
			sleep(15);
			$objResponse->append('log', 'innerHTML', 'Message from server: Request completed before abort.<br />');
			$objResponse->setReturnValue('longDelayS');
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
		<script type='text/Javascript'>
		xajax.callback.global.onRequest = function() {
			xajax.$('log').innerHTML += 'global onRequest event fired<br />';
		}
		xajax.callback.global.onResponseDelay = function() {
			xajax.$('log').innerHTML += 'global onResponseDelay event fired<br />';
		}
		xajax.callback.global.onExpiration = function() {
			xajax.$('log').innerHTML += 'global onExpiration event fired<br />';
		}
		xajax.callback.global.beforeResponseProcessing = function() {
			xajax.$('log').innerHTML += 'global beforeResponseProcessing event fired<br />';
		}
		xajax.callback.global.onFailure = function() {
			xajax.$('log').innerHTML += 'global onFailure event fired<br />';
		}
		xajax.callback.global.onRedirect = function() {
			xajax.$('log').innerHTML += 'global onRedirect event fired<br />';
		}
		xajax.callback.global.onSuccess = function() {
			xajax.$('log').innerHTML += 'global onSuccess event fired<br />';
		}
		xajax.callback.global.onComplete = function() {
			xajax.$('log').innerHTML += 'global onComplete event fired<br />';
		}
		
		local = {};
		local.callback = xajax.callback.create(360, 12000);
		local.callback.onRequest = function() {
			xajax.$('log').innerHTML += 'local onRequest event fired<br />';
		}
		local.callback.onResponseDelay = function() {
			xajax.$('log').innerHTML += 'local onResponseDelay event fired<br />';
		}
		local.callback.onExpiration = function(oRequest) {
			xajax.$('log').innerHTML += 'local onExpiration event fired<br />';
			xajax.abortRequest(oRequest);
		}
		local.callback.beforeResponseProcessing = function() {
			xajax.$('log').innerHTML += 'local beforeResponseProcessing event fired<br />';
		}
		local.callback.onFailure = function() {
			xajax.$('log').innerHTML += 'local onFailure event fired<br />';
		}
		local.callback.onRedirect = function() {
			xajax.$('log').innerHTML += 'local onRedirect event fired<br />';
		}
		local.callback.onSuccess = function() {
			xajax.$('log').innerHTML += 'local onSuccess event fired<br />';
		}
		local.callback.onComplete = function() {
			xajax.$('log').innerHTML += 'local onComplete event fired<br />';
		}
		
		local.callback2 = xajax.callback.create(6000, 15000);
		local.callback2.onResponseDelay = function() {
			xajax.$('log').innerHTML += 'local.callback2 onResponseDelay event fired<br />';
		}
		local.callback2.onComplete = function() {
			xajax.$('log').innerHTML += 'local.callback2 onComplete event fired<br />';
		}
		
		function finished(aValues) {
			var newText = [];
			if ('object' == typeof (aValues)) {
				if (0 < aValues.length) {
					newText.push('Received array: ');
					for (var i=0; i < aValues.length; ++i) {
						if (0 < i)
							newText.push(', ');
						newText.push(aValues[i]);
					}
				}
				newText.push('Received object: ');
				var i = 0;
				for (var key in aValues) {
					if (aValues[key]) {
						if (0 < i)
							newText.push(', ');
						newText.push(key);
						newText.push(":");
						newText.push(aValues[key]);
					}
					++i;
				}
			}
			newText.push(' Done.<br />');
			xajax.$('log').innerHTML = xajax.$('log').innerHTML + newText.join('');
		}
		</script>
	</head>
	<body>
		<table>
			<tbody>
				<tr>
					<td valign='top' width='150px'>
Asynchronous:<br />
<a href='#' onclick='xajax.call("shortDelay", {parameters: [{a:1, b:2, c:"&amp;amp;nbsp;two>", "0":1}], callback: local.callback}); return false;'>Short Delay</a><br />
<a href='#log' onclick='xajax.call("mediumDelay", { parameters: [[1,2,3,3]], callback: [local.callback, local.callback2], onRequest: function() { xajax.$("log").innerHTML += "explicit callback onRequest called<br />"; }, returnValue: true });'>Medium Delay</a><br />
<a href='#' onclick='xajax.call("longDelay", {callback: local.callback}); return false;'>Long Delay</a><br />
					</td>
					<td valign='top' width='450px'>
Synchronous:<br />
(note: due to the nature of synchronous calls, xajax is not able to<br />
abort the request; only the browser can abort the request based on<br />
the browsers time-out settings)<br />
<a href='#' onclick='var oRet = xajax.call("shortDelayS", {callback: local.callback, mode: "synchronous"}); alert(oRet); return false;'>Short Delay</a><br />
<a href='#log' onclick='var oRet = xajax.call("mediumDelayS", {callback: local.callback, mode: "synchronous"}); return oRet == "mediumDelayS";'>Medium Delay</a><br />
<a href='#' onclick='var oRet = xajax.call("longDelayS", {callback: local.callback, mode: "synchronous"}); alert(oRet); return false;'>Long Delay</a><br />
					</td>
				</tr>
			</tbody>
		</table>
		<div id='log'></div>
	</body>
</html>

