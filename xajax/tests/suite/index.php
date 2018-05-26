<?php
	/**
	 * xajax test suite
	 *
	 * This file contains a variety of test cases for testing the xajax core
	 * functions, transfer protocol and encapsulation, etc...
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("./index.php");
//	$xajax->setFlag("debug", true);
	
	$objResponse = new xajaxResponse();
	
	class clsPage {
		function clsPage() {
		}
		
		function populateTestSelection() {
			global $objResponse;
			$select = "<select id='selectedTest' name='selectedTest' onchange='showTest();'>";
			$select .= "<option value='./none.php' />--- Select Test ---";
			$select .= "<option value='./alert_confirm.php' />Alert and Confirm Commands";
			$select .= "<option value='./assign_append.php' />Assign and Append";
			$select .= "<option value='./tables.php' />Tables";
			$select .= "<option value='./transport.php' />Transport";
			$select .= "<option value='./delayEvents.php' />Callbacks";
			$select .= "<option value='./events.php' />Events";
			$select .= "<option value='./iframe.php' />iFrame";
			$select .= "<option value='./css.php' />CSS";
			$select .= "</select>";
			$objResponse->assign("testSelection", "innerHTML", $select);
			return $objResponse;
		}
		
		function generateJsFiles() {
			global $xajax;
			global $objResponse;
			$xajax->autoCompressJavascript("../../xajax_js/xajax_core.js", true);
			$xajax->autoCompressJavascript("../../xajax_js/xajax_debug.js", true);
			$xajax->autoCompressJavascript("../../xajax_js/xajax_legacy.js", true);
			sleep(1);
			$objResponse->assign('statusMessage', 'innerHTML', 'xajax javascript files recompressed...');
			$objResponse->script('showTest();');
			$objResponse->script("setTimeout('xajax.\$(\"statusMessage\").innerHTML = \"\";', 4000);");
			return $objResponse;
		}
		
		function selectTest($values) {
			global $objResponse;
			$test = $values['selectedTest'];
			$delimiter = "?";
			if (isset($values['status'])) {
				$test .= $delimiter;
				$test .= "status=1";
				$delimiter = "&";
			}
			if (isset($values['debug'])) {
				$test .= $delimiter;
				$test .= "debugging=1";
				$delimiter = "&";
			}
			if (isset($values['useEncoding'])) {
				$test .= $delimiter;
				$test .= "useEncoding=";
				$test .= $values['useEncoding'];
				$delimiter = "&";
			}
			if (isset($values['htmlEntities'])) {
				$test .= $delimiter;
				$test .= "htmlEntities=";
				$test .= $values['htmlEntities'];
				$delimiter = "&";
			}
			if (isset($values['decodeUTF8'])) {
				$test .= $delimiter;
				$test .= "decodeUTF8=";
				$test .= $values['decodeUTF8'];
				$delimiter = "&";
			}
			
			$objResponse->assign('testFrame', 'src', '');
			$objResponse->assign('testFrame', 'src', $test);
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
		<script type='text/javascript'>
		showTest = function() {
			xajax.call("selectTest", { 
				parameters: [
					xajax.getFormValues("settings")
				] 
			} );
		}
		</script>
		<style>
		#control_panel {
			border: 1px solid #8888aa;
			background: #ddddff;
			padding: 5px;
		}
		#testFrame {
			width: 100%;
			height: 600px;
			border: 1px solid #aa8888;
		}
		#encoding {
			padding: 5px;
			border: 1px dashed #999999;
		}
		#statusMessage {
			padding: 3px;
			color: red;
		}
		</style>
	</head>
	<body onload='xajax.call("populateTestSelection", {});'>
		<form id='settings'>
			<span id='testSelection'></span>
			<a href='#' onclick='var cp = xajax.$("control_panel"); if ("none" != cp.style.display) cp.style.display = "none"; else cp.style.display = "block";'>Toggle Control Panel</a>
			<a href='#' onclick='xajax.call("generateJsFiles", {}); return false;'>Generate compressed JS Files</a>
			<a href='#refresh' onclick='showTest(); return false;'>Refresh Test Page</a>
			<div id='control_panel'>
				<input type='checkbox' id='debug' name='debug' onclick='showTest();'>Enable Debugging<br />
				<input type='checkbox' id='status' name='status' onclick='showTest();'>Enable Status Messages<br />
				<div id='encoding'>
					Encoding: <input type="text" name="useEncoding" value="UTF-8" /><br />
					Output HTML Entities? <input type="radio" name="htmlEntities" value="1" /> Yes <input type="radio" name="htmlEntities" value="0" checked="checked" /> No<br />
					Decode UTF-8 Input? <input type="radio" name="decodeUTF8" value="1" /> Yes <input type="radio" name="decodeUTF8" value="0" checked="checked" /> No<br />
					<input type="submit" value="Set Options" onclick="showTest(); return false;" />
				</div>
				<div id='statusMessage'></div>
			</div>
		</form>
		<iframe id='testFrame' src='./none.php'>
		</iframe>
	</body>
</html>

