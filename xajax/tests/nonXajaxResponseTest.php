<?php
require_once("../xajax_core/xajax.inc.php");

function testXajaxResponse()
{
	// Return a xajax response object
	$objResponse = new xajaxResponse();
	$objResponse->assign('DataDiv','innerHTML','Xajax Response Data');
	return $objResponse;
}

function testXmlResponse()
{
	// Return xml data directly to the custom response handler function
	header('Content-type: text/xml; charset="utf-8"');
	return '<?xml version="1.0" encoding="utf-8" ?'.'><root><data>text</data></root>';
}

function testTextResponse()
{
	// return text data directly to the custom response handler function
	return 'text data';
}

$xajax = new xajax();
$xajax->setFlag("debug", true);
$xajax->setFlag("useUncompressedScripts", true);

// Tell xajax to permit registered functions to return data other than xajaxResponse objects
$xajax->setFlag('allowAllResponseTypes', true);

$xajax->registerFunction("testXajaxResponse");
$xajax->registerFunction("testXmlResponse");
$xajax->registerFunction("testTextResponse");

$xajax->processRequest();

$callXmlResponse = new xajaxCall('testXmlResponse');
$callXmlResponse->setResponseProcessor('xmlResponse');

$callTextResponse = new xajaxCall('testTextResponse');
$callTextResponse->setMode('synchronous');
$callTextResponse->setResponseProcessor('textResponse');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Non-xajaxResponse XML and Text Responses Test | xajax Tests</title>
<?php //$xajax->printJavascript("../", array(array("xajax_js/foobar.js", "foobar")))
      $xajax->printJavascript("../") ?>
<script>
// function to handle ajax response text data
function textResponse(objRequest)
{
	xajax.$('DataDiv').innerHTML = objRequest.request.responseText;
	xajax.completeResponse(objRequest);
}
// function to handle ajax response data XML
function xmlResponse(objRequest)
{
	alert(objRequest.request.responseXML.documentElement.nodeName);
	xajax.$('DataDiv').innerHTML = 'non xajax: XML response';
	xajax.completeResponse(objRequest);
}
</script>
</head>
<body>
<h2><a href="index.php">xajax Tests</a></h2>
<h1>Non-xajaxResponse XML and Text Responses Test</h1>

<form id="testForm1" onsubmit="return false;">
<p>
<input type="button" value="xajax" onclick="xajax_testXajaxResponse(); return false;" />
<!-- use xajax.call to call the functions that return data directly and indicate the javascript function
that will handle the response -->
<input type='button' value='xml' onclick='<?php echo $callXmlResponse->generate(); ?>' />
<input type='button' value='text' onclick='<?php echo $callTextResponse->generate(); ?>' />
</p>
</form>

<div id="DataDiv"></div>

</body>
</html>