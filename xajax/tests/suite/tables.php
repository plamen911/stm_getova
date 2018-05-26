<?php
	/**
	 * tables.php
	 * 
	 * xajax test script to test xajax response commands that display alert 
	 * messages, prompt dialogs and the confirm_commands.
	 */

	require("../../xajax_core/xajax.inc.php");
	$xajax = new xajax("tables.php");
	
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
	
	require('../../xajax_plugins/xajax_tables.inc.php');
	
	class clsPage {
		function clsPage() {
		}
		
		function generateTable() {
			global $objResponse;
			$objResponse->clear("content", "innerHTML");
			$objResponse->plugin('xajax.ext.tables', 'appendTable', 'theTable', 'content');
			return $objResponse;
		}
		
		function appendRow() {
			global $objResponse;
			$row = time();
			$row = "row_" . $row;
			$id = " id='";
			$id .= $row;
			$id .= "'";
			$objResponse->plugin('xajax.ext.tables', 'appendRow', $row, 'theTable');
			$link = "<a href='#' onclick='xajax.call(\"setRowNumber\", {parameters: [\"{$row}\"]});'>{$row}</a>";
			$objResponse->plugin('xajax.ext.tables', 'assignRow', array($link), $row);
			return $objResponse;
		}
		
		function insertRow($old_row) {
			global $objResponse;
			$row = time();
			$row = "row_" . $row;
			$id = " id='";
			$id .= $row;
			$id .= "'";
			$objResponse->plugin('xajax.ext.tables', 'insertRow', $row, 'theTable', $old_row);
			$link = "<a href='#' onclick='xajax.call(\"setRowNumber\", {parameters: [\"{$row}\"]});'>{$row}</a>";
			$objResponse->plugin('xajax.ext.tables', 'assignRow', array($link), $row);
			return $objResponse;
		}
		
		function replaceRow($old_row) {
			global $objResponse;
			$row = time();
			$row = "row_" . $row;
			$id = " id='";
			$id .= $row;
			$id .= "'";
			$objResponse->plugin('xajax.ext.tables', 'replaceRow', $row, 'theTable', $old_row);
			$link = "<a href='#' onclick='xajax.call(\"setRowNumber\", {parameters: [\"{$row}\"]});'>{$row}</a>";
			$objResponse->plugin('xajax.ext.tables', 'assignRow', array($link), $row);
			$objResponse->clear("RowNumber", "value");
			return $objResponse;
		}
		
		function removeRow($row) {
			global $objResponse;
			$objResponse->plugin('xajax.ext.tables', 'deleteRow', $row);
			$objResponse->clear("RowNumber", "value");
			return $objResponse;
		}
		
		function setRowNumber($row) {
			global $objResponse;
			$objResponse->assign("RowNumber", "value", $row);
			return $objResponse;
		}
		
		function appendColumn() {
			global $objResponse;
			$column = time();
			$column = "column_" . $column;
			$id = " id='";
			$id .= $column;
			$id .= "'";
			$link = "<a href='#' onclick='xajax.call(\"setColumnNumber\", {parameters: [\"{$column}\"]});'>{$column}</a>";
			$objResponse->plugin('xajax.ext.tables', 'appendColumn', array("name"=>$link, "id"=>$column), 'theTable');
			return $objResponse;
		}
		
		function insertColumn($old_column) {
			global $objResponse;
			$column = time();
			$column = "column_" . $column;
			$id = " id='";
			$id .= $column;
			$id .= "'";
			$link = "<a href='#' onclick='xajax.call(\"setColumnNumber\", {parameters: [\"{$column}\"]});'>{$column}</a>";
			$objResponse->plugin('xajax.ext.tables', 'insertColumn', array('id'=>$column, 'name'=>$link), $old_column);
			return $objResponse;
		}
		
		function replaceColumn($old_column) {
			global $objResponse;
			$column = time();
			$column = "column_" . $column;
			$id = " id='";
			$id .= $column;
			$id .= "'";
			$link = "<a href='#' onclick='xajax.call(\"setColumnNumber\", {parameters: [\"{$column}\"]});'>{$column}</a>";
			$objResponse->plugin('xajax.ext.tables', 'replaceColumn', array('id'=>$column, 'name'=>$link), $old_column);
			$objResponse->clear("ColumnNumber", "value");
			return $objResponse;
		}
		
		function removeColumn($column) {
			global $objResponse;
			$objResponse->plugin('xajax.ext.tables', 'deleteColumn', $column);
			$objResponse->clear("ColumnNumber", "value");
			return $objResponse;
		}
		
		function setColumnNumber($column) {
			global $objResponse;
			$objResponse->assign("ColumnNumber", "value", $column);
			return $objResponse;
		}
		
		function setCellValue($row, $column, $value) {
			global $objResponse;
			if (0 == strlen($row) || 0 == strlen($value)) {
				$objResponse->alert("Please select a row and column.");
				return $objResponse;
			}
			$objResponse->plugin('xajax.ext.tables', 'assignCell', $row, $column, $value);
			return $objResponse;
		}
		
		function setCellProperty($row, $column, $property, $value) {
			global $objResponse;
			if (0 == strlen($row) || 0 == strlen($value)) {
				$objResponse->alert("Please select a row and column.");
				return $objResponse;
			}
			$objResponse->plugin('xajax.ext.tables', 'assignCell', $row, $column, array('property'=>$property, 'value'=>$value));
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
		<script type='text/javascript' src='../../xajax_plugins/xajax_tables.js'></script>
		<style>
		table {
			border: 1px solid #8888aa;
		}
		thead {
			background: #bbbbdd;
		}
		tbody {
		}
		tfoot {
			background: #ccccee;
		}
		</style>
	</head>
	<body>
		<a href='#' onclick='xajax.call("generateTable"); return false;'>Generate the table</a>&nbsp;then&nbsp;
		<a href='#' onclick='xajax.call("appendColumn"); return false;'>Append one or more columns</a>&nbsp;then&nbsp;
		<a href='#' onclick='xajax.call("appendRow"); return false;'>Append one or more rows</a><br />
		<br />
		<table>
			<thead>
				<tr>
					<td valign='top'>Click or type a row<br />that is in the table</td>
					<td valign='top'>Click or type a column<br />that is in the table</td>
					<td valign='top'>Select a row and column<br />then enter a value</td>
					<td valign='top'>Select a row and column<br />then select a property and value</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td valign='top'>
						<input id='RowNumber' type='text'><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("removeRow", {parameters:[xajax.$("RowNumber").value]}); return false;'>Remove Row</a><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("replaceRow", {parameters:[xajax.$("RowNumber").value]}); return false;'>Replace Row</a><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("insertRow", {parameters:[xajax.$("RowNumber").value]}); return false;'>Insert Row Before</a><br />
						<br />
					</td>
					<td valign='top'>
						<input id='ColumnNumber' type='text'><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("removeColumn", {parameters:[xajax.$("ColumnNumber").value]}); return false;'>Remove Column</a><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("replaceColumn", {parameters:[xajax.$("ColumnNumber").value]}); return false;'>Replace Column</a><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("insertColumn", {parameters:[xajax.$("ColumnNumber").value]}); return false;'>Insert Column Before</a><br />
						<br />
					</td>
					<td valign='top'>
						<input id='Value' type='text'><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("setCellValue", {parameters:[xajax.$("RowNumber").value, xajax.$("ColumnNumber").value, xajax.$("Value").value]}); return false;'>Set Value</a><br />
						<br />
					</td>
					<td valign='top'>
						<select id='Property'>
						<option value='style.backgroundColor'>Background Color
						<option value='style.padding'>Padding
						<option value='style.border'>Border
						</select><br />
						<input id='PropertyValue' type='text'><br />
						&nbsp;|<br />
						+-&nbsp;<a href='#' onclick='xajax.call("setCellProperty", {parameters:[xajax.$("RowNumber").value, xajax.$("ColumnNumber").value, xajax.$("Property").value, xajax.$("PropertyValue").value]}); return false;'>Set Property</a><br />
						<br />
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<div id='content'>... table goes here ...</div>
	</body>
</html>

