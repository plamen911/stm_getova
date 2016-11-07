<?php
// http://localhost/stm2008/hipokrat/w_mchkup.php?firm_id=228&date_from=01.01.2007&date_to=31.12.2008&offline=1
require('includes.php');

$offline = (isset($_GET['offline']) && $_GET['offline'] == '1') ? 1 : 0;

$firm_id = (isset($_GET['firm_id']) && is_numeric($_GET['firm_id'])) ? intval($_GET['firm_id']) : 0;
$f = $dbInst->getFirmInfo($firm_id);
if(!$f) {
	die('Липсва индентификатор на фирмата!');
}
$s = $dbInst->getStmInfo();

$stm_name = preg_replace('/\<br\s*\/?\>/', '', $s['stm_name']);

$dbInst->makeAllMkbUpperCase();

$sickonly = (isset($_GET['sickonly'])) ? intval($_GET['sickonly']) : 1;

if(!isset($_GET['date_from']) || trim($_GET['date_from']) == '') {
	$y = date('Y') - 1;
	$date_from = date('Y-m-d H:i:s', mktime(0,0,0,1,1,$y));
	$date_to = date('Y-m-d H:i:s', mktime(23,59,59,12,31,$y));
} else {
	$d = new ParseBGDate();
	if($d->Parse($_GET['date_from']))
	$date_from = $d->year.'-'.$d->month.'-'.$d->day.' 00:00:00';
	else
	$date_from = '';
	if($d->Parse($_GET['date_to']))
	$date_to = $d->year.'-'.$d->month.'-'.$d->day.' 23:59:59';
	else
	$date_to = '';
	if($date_from == '' || $date_to == '') {
		$y = date('Y') - 1;
		$date_from = date('Y-m-d H:i:s', mktime(0,0,0,1,1,$y));
		$date_to = date('Y-m-d H:i:s', mktime(23,59,59,12,31,$y));
	}
}

$dt = substr($date_to, 0, 10);
list($last_year, $last_month, $last_day) = explode('-', $dt);

$unchecked = 'unchecked.gif';
$checked = 'checked.gif';
$imgpath = "https://" . ((isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'])) . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/img/";

if(!$offline) {
	$firm_name = str_replace(' ', '_', $f['firm_name']);
	$firm_name = str_replace('"', '', $firm_name);
	$firm_name = str_replace('\'', '', $firm_name);
	$firm_name = str_replace('”', '', $firm_name);
	$firm_name = str_replace('„', '', $firm_name);
	$firm_name = str_replace('_-_', '_', $firm_name);

	$period = str_replace(', ', '_', $dbInst->extractYear($date_from, $date_to));
	$period = str_replace(' и ', '_', $period);

	require_once("cyrlat.class.php");
	$cyrlat = new CyrLat;
	$filename = 'Spravka_ZVN_'.$cyrlat->cyr2lat($period.'_'.$firm_name).'.doc';

	header("Pragma: public");
	header("Content-Disposition: attachment; filename=\"$filename\";");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	//header("Cache-Control: private", false);
	header("Content-Type: application/octet-stream");
	//header("Content-type: application/msword;");
	//$imgpath = str_replace('/','\\',str_replace(basename($_SERVER['PHP_SELF']),'',$_SERVER["SCRIPT_FILENAME"])).'img\\';
}

$query = "	SELECT w.*, strftime('%d.%m.%Y г.', w.date_retired, 'localtime') AS date_retired_h,
			(SELECT COUNT(*) FROM patient_charts c WHERE c.worker_id = w.worker_id AND (julianday(c.hospital_date_from) BETWEEN julianday('$date_from') AND julianday('$date_to'))) AS patient_charts_num,
			f.name AS firm_name,
			l.location_name,
			s.subdivision_name,
			p.wplace_name,
			i.position_name
			FROM workers w
			LEFT JOIN firms f ON (f.firm_id = w.firm_id)
			LEFT JOIN locations l ON (l.location_id = w.location_id)
			LEFT JOIN firm_struct_map m ON (m.map_id = w.map_id )
			LEFT JOIN subdivisions s ON (s.subdivision_id = m.subdivision_id)
			LEFT JOIN work_places p ON (p.wplace_id = m.wplace_id)
			LEFT JOIN firm_positions i ON (i.position_id = m.position_id)
			WHERE w.firm_id = $firm_id 
			AND w.is_active = '1'
			AND w.date_retired = ''
			".(($sickonly)?" AND patient_charts_num > 0 ":'')."
			ORDER BY w.date_retired, w.fname, w.sname, w.lname, w.egn, w.worker_id";

$rows = $dbInst->query($query);

?><html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=Generator content="Microsoft Word 11 (filtered)">
<title><?=((isset($stm_name))?HTMLFormat($stm_name):'СЛУЖБА ПО ТРУДОВА МЕДИЦИНА')?></title>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman";}
p.msoacetate0, li.msoacetate0, div.msoacetate0
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:8.0pt;
	font-family:Tahoma;}
@page Section1
	{size:595.3pt 841.9pt;
	margin:35.95pt 70.85pt 53.95pt 70.85pt;}
div.Section1
	{page:Section1;}
-->
</style>

</head>

<body lang=BG>

<div class=Section1>

<?php w_heading($s); ?>

</div>

<p class=MsoNormal><b><i><span style='font-size:20.0pt'>&nbsp;</span></i></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:20.0pt'>Справка</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:14.0pt'>на работещите в <?=((isset($f['firm_name']))?HTMLFormat($f['firm_name']):'')?></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:14.0pt'>с болнични листове от <?=date('d.m.Y', strtotime($date_from))?> г. до <?=date('d.m.Y', strtotime($date_to))?> г.</span></b></p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<?php  if (is_array($rows) && count($rows) > 0) { ?>
<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;margin-left:1.9pt;border-collapse:collapse'>
 <tr>
  <td width=53 style='width:39.5pt;border:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>№ по ред</b></p>
  </td>
  <td width=204 style='width:153.0pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Име</b></p>
  </td>
  <td width=115 style='width:86.1pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>ЕГН</b></p>
  </td>
  <td width=124 style='width:92.9pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Длъжност</b></p>
  </td>
  <td width=124 style='width:92.9pt;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Болнични листове</b></p>
  </td>
 </tr>
 <?php
 $i = 0;
 foreach ($rows as $row) {
 ?>
 <tr>
  <td width=53 valign=top style='width:39.5pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=++$i?>.</p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=HTMLFormat(trim($row['fname'].' '.$row['sname'].' '.$row['lname']))?></p>
  </td>
  <td width=115 valign=top style='width:86.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['egn']?></p>
  </td>
  <td width=124 valign=top style='width:92.9pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=HTMLFormat($row['position_name'])?></p>
  </td>
  <td width=124 valign=top style='width:92.9pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=HTMLFormat($row['patient_charts_num'])?></p>
  </td>
 </tr>
 <?php } ?>
</table>
<?php } else { ?>
<p class=MsoNormal>Няма работещи с регистрирани болнични за периода.</p>
<?php } ?>

<p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt'><?=date("d.m.Y")?> г.                                                                                                                                          Ръководител
СТМ:</span></p>

<p class=MsoNormal align=right style='text-align:right'><span style='font-size:
14.0pt'>(<?=HTMLFormat($s['chief'])?>)</span></p>

</div>

</body>

</html>
