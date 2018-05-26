<?php
require('../../xajax_core/xajax.inc.php');

$xajax = new xajax();

	class clsFunctions {
		function clsFunctions() {
		}
		
		function confirm($seconds) {
			sleep($seconds);
			$objResponse = new xajaxResponse();
			$objResponse->append('outputDIV', 'innerHTML', '<br />confirmation from theFrame.php call');
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
		<title>xajax Test iFrame</title>
		<?php $xajax->printJavascript('../../'); ?>
	</head>
	<body>
		<div>This is the iframe</div>
		<div id='outputDIV'></div>
	</body>
</html>
