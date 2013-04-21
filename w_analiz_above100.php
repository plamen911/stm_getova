<?php
// To test: http://localhost/stm2008/hipokrat/w_analiz_above100.php?firm_id=227&date_from=01.01.2010&date_to=31.12.2010&offline=1
require('includes.php');
require('class.stmstats.php');
set_time_limit(120);

$offline = (isset($_GET['offline']) && $_GET['offline'] == '1') ? 1 : 0;

$firm_id = (isset($_GET['firm_id']) && is_numeric($_GET['firm_id'])) ? intval($_GET['firm_id']) : 0;
$f = $dbInst->getFirmInfo($firm_id);
if(!$f) {
	die('Липсва индентификатор на фирмата!');
}
$s = $dbInst->getStmInfo();

$stm_name = preg_replace('/\<br\s*\/?\>/', '', $s['stm_name']);

$dbInst->makeAllMkbUpperCase();

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
$r = $dbInst->getAnnualReport($firm_id, $date_from, $date_to);
$objStats = new StmStats($firm_id, $date_from, $date_to);

$unchecked = 'unchecked.gif';
$checked = 'checked.gif';
$imgpath = "http://" . ((isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'])) . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/img/";

$filename = $f['firm_name'];

if(!$offline) {
	$firm_name = str_replace(' ', '_', $filename);
	$firm_name = str_replace('"', '', $firm_name);
	$firm_name = str_replace('\'', '', $firm_name);
	$firm_name = str_replace('”', '', $firm_name);
	$firm_name = str_replace('„', '', $firm_name);
	$firm_name = str_replace('_-_', '_', $firm_name);

	$period = str_replace(', ', '_', $dbInst->extractYear($date_from, $date_to));
	$period = str_replace(' и ', '_', $period);

	require_once("cyrlat.class.php");
	$cyrlat = new CyrLat;
	$filename = 'Analiz_'.$cyrlat->cyr2lat($period.'_'.$firm_name).'.doc';

	header("Pragma: public");
	header("Content-Disposition: attachment; filename=\"$filename\";");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	//header("Cache-Control: private", false);
	header("Content-Type: application/octet-stream");
	//header("Content-type: application/msword;");
	//$imgpath = str_replace('/','\\',str_replace(basename($_SERVER['PHP_SELF']),'',$_SERVER["SCRIPT_FILENAME"])).'img\\';
}

if(is_file('Analiz_2010_PIRIN_TEKS_PRODAKShYN.doc') && 'Analiz_2010_PIRIN_TEKS_PRODAKShYN.doc' == $filename) {
	die(file_get_contents('Analiz_2010_PIRIN_TEKS_PRODAKShYN.doc'));
}

$avgWorkers = (isset($r)) ? ($r['anual_workers'] + (($r['joined_workers'] + $r['retired_workers']) / 2)) : 0;
$cnt_2_1 = $dbInst->getSickWorkers($firm_id, $date_from, $date_to);
$cnt_2_2 = $dbInst->getAbsSickWorkers($firm_id, $date_from, $date_to);
$cnt_2_3 = $dbInst->getChartDaysOff($firm_id, $date_from, $date_to);
$cnt_2_8 = $dbInst->getProDiseaseWorkers($firm_id, $date_from, $date_to);
$cnt_2_9 = $dbInst->getDurableDiseases($firm_id, $date_from, $date_to);
$workersWithProDiseases = $dbInst->getWorkersWithProDiseases($firm_id, $date_from, $date_to);

$location_type = '';
switch ($f['location_type']) {
	case '0':
		$location_type = 'с.';
		break;
	case '1':
		$location_type = 'гр.';
		break;
	case '2':
		$location_type = 'жк';
		break;
	case '3':
		$location_type = 'кв.';
		break;
	default:
		$location_type = '';
		break;
}
$firm_address = trim($location_type.$f['location_name'].((!empty($f['address'])) ? ', '.$f['address'] : ''));

?><html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<title><?=((isset($stm_name))?HTMLFormat($stm_name):'СЛУЖБА ПО ТРУДОВА МЕДИЦИНА')?></title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>STM</o:Author>
  <o:LastAuthor>STM</o:LastAuthor>
  <o:Revision>3</o:Revision>
  <o:TotalTime>27</o:TotalTime>
  <o:LastPrinted>2008-04-18T09:44:00Z</o:LastPrinted>
  <o:Created>2008-06-17T06:44:00Z</o:Created>
  <o:LastSaved>2008-06-17T06:45:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>498</o:Words>
  <o:Characters>2840</o:Characters>
  <o:Company>STM</o:Company>
  <o:Lines>23</o:Lines>
  <o:Paragraphs>6</o:Paragraphs>
  <o:CharactersWithSpaces>3332</o:CharactersWithSpaces>
  <o:Version>11.5606</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:HyphenationZone>21</w:HyphenationZone>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
 </w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" LatentStyleCount="156">
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:204;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:1627421319 -2147483648 8 0 66047 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:Tahoma;
	mso-fareast-font-family:"Times New Roman";}
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
@page Section1
	{size:595.3pt 841.9pt;
	margin:70.85pt 70.85pt 70.85pt 70.85pt;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-paper-source:0;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=BG style='tab-interval:35.4pt'>

<div class=Section1>

<?php w_heading($s); ?>

</div>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><i style='mso-bidi-font-style:
normal'><span style='font-size:20.0pt'><o:p>&nbsp;</o:p></span></i></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-size:20.0pt'>Обобщен анализ на здравното състояние<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-size:14.0pt'>на работещите в <o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-size:14.0pt'><?=((isset($f['firm_name']))?HTMLFormat($f['firm_name']):'')?> за <?=$dbInst->extractYear($date_from, $date_to)?> г.<o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-size:14.0pt'><?=HTMLFormat($firm_address)?><o:p></o:p></span></b></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal>1. Данни за работещите в предприятието</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:11.95pt'>
  <td width=295 rowspan=2 style='width:221.4pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.95pt'>
  <p class=MsoNormal align=center style='text-align:center'>Средно-списъчен
  състав на работещите:</p>
  <p class=MsoNormal align=center style='text-align:center'><o:p>&nbsp;</o:p></p>
  </td>
  <td width=324 colspan=2 style='width:243.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.95pt'>
  <p class=MsoNormal align=center style='text-align:center'>Пол</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:9.0pt'>
  <td width=169 style='width:126.9pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:9.0pt'>
  <p class=MsoNormal align=center style='text-align:center'>М </p>
  </td>
  <td width=155 style='width:116.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:9.0pt'>
  <p class=MsoNormal align=center style='text-align:center'>Ж </p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
  <td width=295 valign=top style='width:221.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><?=((isset($r))?($r['anual_workers']+(($r['joined_workers']+$r['retired_workers'])/2)):'')?></b></p>
  </td>
  <td width=169 valign=top style='width:126.9pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><?=((isset($r))?($r['anual_men']+(($r['joined_men']+$r['retired_men'])/2)):'')?></b></p>
  </td>
  <td width=155 valign=top style='width:116.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><?=((isset($r))?($r['anual_women']+(($r['joined_women']+$r['retired_women'])/2)):'')?></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal style='text-align:justify;'>2. Данни за
боледувалите работещи за съответната календарна година:</p>

<p class=MsoNormal style='text-align:justify;'>2.1. Брой
работещи с регистрирани заболявания (по данни от болничните листове): <b
style='mso-bidi-font-weight:normal'><?php echo $cnt_2_1; ?></b>.</p>

<?php
$condition = "medical_types LIKE '%\"1\"%'
AND ((julianday(hospital_date_from) >= julianday('$date_from'))
AND (julianday(hospital_date_from) <= julianday('$date_to')))";
$_data = $dbInst->getNosologicTable($calc='COUNT(*)', $table='patient_charts', $join='', $condition, $firm_id, $date_from, $date_to);
$_table = $_data['table'];
$_cnt = $_data['total'];
?>
<p class=MsoNormal style='text-align:justify;'>2.2. Абсолютен
брой случаи (първични болнични листове) – общо и по <span class=SpellE>нозологична</span>
структура, съгласно <span class=SpellE>МКБ-</span>10 – <?=(($_cnt)?'общо <b>'.$_cnt.'</b>':'Няма предоставени данни')?>.</p>

<?php
if($_cnt) {
	echo $_table;
	echo "<p class=MsoNormal style='text-align:justify;'><o:p>&nbsp;</o:p></p>";
}

$condition = "(medical_types LIKE '%\"1\"%' OR medical_types LIKE '%\"2\"%')
AND ((julianday(hospital_date_from) >= julianday('$date_from'))
AND (julianday(hospital_date_from) <= julianday('$date_to')))";
//$_data = $dbInst->getNosologicTable($fields='*, SUM(days_off) AS cnt', $table='patient_charts', $join='', $condition, $firm_id, $date_from, $date_to);
$_data = $dbInst->getNosologicTable($calc='SUM(days_off)', $table='patient_charts', $join='', $condition, $firm_id, $date_from, $date_to);
$_table = $_data['table'];
$_cnt = $_data['total'];
?>
<p class=MsoNormal style='text-align:justify;'>2.3. Брой на
дните с временна неработоспособност (общо от всички болнични листове – първични
и продължения) – общо и по <span class=SpellE>нозологична</span> структура,
съгласно <span class=SpellE>МКБ-</span>10 – <?=(($_cnt)?'общо <b>'.$_cnt.'</b>':'Няма предоставени данни')?>.</p>

<?php
if($_cnt) {
	echo $_table;
	echo "<p class=MsoNormal style='text-align:justify;'><o:p>&nbsp;</o:p></p>";
}
?>

<p class=MsoNormal style='text-align:justify;'>2.4. Брой случаи
с временна неработоспособност с продължителност до 3 дни (първични болнични
листове): <b style='mso-bidi-font-weight:normal'><?php
$_cnt = $dbInst->getDaysOffUpTo3($firm_id, $date_from, $date_to);
echo (($_cnt)?$_cnt:'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>2.5. Брой на
работещите с 4 и повече случаи с временна неработоспособност (първични болнични
листове): <b style='mso-bidi-font-weight:normal'><?php
$_cnt = $dbInst->getSickWorkers4Up($firm_id, $date_from, $date_to);
echo (!empty($_cnt)) ? $_cnt : 0; ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>2.6. Брой на
работещите с 30 и повече дни временна неработоспособност от заболявания: <b
style='mso-bidi-font-weight:normal'><?php
$_cnt = $dbInst->getSickWorkers30Up($firm_id, $date_from, $date_to);
echo (($_cnt)?$_cnt:'Няма предоставени данни'); ?></b>.</p>

<?php
if($_cnt) {
	$rows = $dbInst->getWorkersByCharts3($firm_id, $date_from, $date_to);
	?>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=91 style='width:68.4pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>№ по ред</p>
  </td>
  <td width=84 style='width:63.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>пол</p>
  </td>
  <td width=84 style='width:63.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>възраст</p>
  </td>
  <td width=180 style='width:135.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Длъжност</p>
  </td>
  <td width=180 style='width:135.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Диагнози</p>
  <p class=MsoNormal align=center style='text-align:center'>(код по <span
  class=SpellE>МКБ-</span>10)</p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($rows as $row) {
 	if($row['days_off'] < 30) continue;
 ?>
 <tr style='mso-yfti-irow:<?=$i?>;mso-yfti-lastrow:yes'>
  <td width=91 valign=top style='width:68.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$i++?>.</p>
  </td>
  <td width=84 valign=top style='width:63.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['w.sex']?></p>
  </td>
  <td width=84 valign=top style='width:63.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=(($row['age']!='')?$row['age'].' г.':'')?></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=HTMLFormat($row['i.position_name'])?></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <?php if($row['days_off'] >= 30) { ?>
  <p class=MsoNormal> <?=intval($row['days_off'])?> дни с трудозагуби -
  <?php
  if($row['days_off']) {
  	$query = "	SELECT mkb_id FROM patient_charts
				WHERE worker_id = ".$row['w.worker_id']."
				AND (julianday(hospital_date_from) >= julianday('$date_from'))
				AND (julianday(hospital_date_from) <= julianday('$date_to'))";

  	$fields = $dbInst->fnSelectRows($query);
  	$aMkb = array();
  	foreach ($fields as $field) {
  		$aMkb[] = $field['mkb_id'];
  	}
  	$aMkb = array_unique($aMkb);
  	echo implode('; ', $aMkb);
  } else { echo '0'; }
  ?></p>
  <?php } ?>
  </td>
 </tr>
 <?php } ?>
</table>
<?php } ?>

<p class=MsoNormal style='text-align:justify;'>2.7. Брой регистрирани
професионални болести: <b style='mso-bidi-font-weight:normal'><?php
$_cnt = $dbInst->getProDiseases($firm_id, $date_from, $date_to);
echo (($_cnt)?$_cnt:'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>2.8. Брой
работещи с регистрирани професионални болести: <b style='mso-bidi-font-weight:
normal'><?php echo (($cnt_2_8)?$cnt_2_8:'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>2.9. Брой на
работещите с експертно решение на ТЕЛК за заболяване с трайна
неработоспособност: <b style='mso-bidi-font-weight:normal'><?php echo (($cnt_2_9)?$cnt_2_9:'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>3. Данни за проведените
задължителни периодични медицински прегледи през съответната календарна година:</p>

<p class=MsoNormal style='text-align:justify;'>3.1. Брой на
работещите, подлежащи на задължителни периодични медицински прегледи: <b
style='mso-bidi-font-weight:normal'><?php echo (($avgWorkers)?$avgWorkers:'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>3.2. Брой на
работещите, обхванати със задължителни периодични медицински прегледи: <b
style='mso-bidi-font-weight:normal'><?php
$_cnt = $dbInst->getPassedCheckupsWorkers($firm_id, $date_from, $date_to);
echo (($_cnt)?$_cnt:'Няма предоставени данни'); ?></b>.</p>

<?php
$condition = "(julianday(c.checkup_date) >= julianday('$date_from'))
AND (julianday(c.checkup_date) <= julianday('$date_to'))";
$_data = $dbInst->getNosologicTable($calc='COUNT(*)', $table='family_diseases', $join='LEFT JOIN medical_checkups c ON (c.checkup_id = d.checkup_id)', $condition, $firm_id, $date_from, $date_to);
$_table = $_data['table'];
$_cnt = $_data['total'];
?>
<p class=MsoNormal style='text-align:justify;'>3.3. Брой
заболявания, открити при проведените задължителни периодични медицински
прегледи – <?=(($_cnt)?'общо '.$_cnt:'Няма предоставени данни')?>.</p>

<?php
if($_cnt) {
	echo $_table;
	echo "<p class=MsoNormal style='text-align:justify;'><o:p>&nbsp;</o:p></p>";
}

$_data = $dbInst->getNosologicTableW($firm_id, $date_from, $date_to);
$_table = $_data['table'];
$_cnt = $_data['total'];
?>
<p class=MsoNormal style='text-align:justify;'>3.4. Брой
работещи със заболявания, открити при проведените задължителни периодични
медицински прегледи – <?=(($_cnt)?'общо '.$_cnt:'Няма предоставени данни')?></b>.</p>

<?php
if($_cnt) {
	echo $_table;
	echo "<p class=MsoNormal style='text-align:justify;'><o:p>&nbsp;</o:p></p>";
}
?>

<p class=MsoNormal style='text-align:justify;'>II. Анализ и
оценка на показателите, характеризиращи здравното състояние на работещите</p>

<p class=MsoNormal style='text-align:justify;'>1. Честота на
боледувалите работещи със заболяемост с временна
неработоспособност: <?=$objStats->freqSickWorkersTempDisability()?>.</p>

<p class=MsoNormal style='text-align:justify;'>2. Честота на
случаите с временна неработоспособност: <?=$objStats->freqCasesTempDisability()?>.</p>

<p class=MsoNormal style='text-align:justify;'>3. Честота на 
трудозагубите с временна неработоспособност: <?=$objStats->freqDaysOffTempDisability()?>.</p>

<p class=MsoNormal style='text-align:justify;'>4. Средна
продължителност на един случай с временна неработоспособност: <b
style='mso-bidi-font-weight:normal'><?=((!empty($objStats->avg_length_of_chart)) ? $objStats->avg_length_of_chart : 'Няма предоставени данни')?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>5. Структура на
случаите/дните с временна неработоспособност по <span class=SpellE>нозологична</span>
принадлежност:</p>

<?php
$rows = $dbInst->getTmpUnableToWorkStruct($firm_id, $date_from, $date_to);
if($rows) {
	if(false === strpos($s['stm_name'], 'МАРС-2001')) {
?>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;margin-left:1.9pt;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=154 style='width:115.4pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Брой случаи с
  временна неработоспособност</p>
  </td>
  <td width=154 style='width:115.4pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Брой дни с временна
  неработоспособност<span lang=EN-US style='mso-ansi-language:EN-US'><o:p></o:p></span></p>
  </td>
  <td width=154 style='width:115.15pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span class=SpellE>Нозологична</span>
  принадлежност <span lang=EN-US style='mso-ansi-language:EN-US'>(</span>код по</p>
  <p class=MsoNormal align=center style='text-align:center'><span class=SpellE>МКБ-</span>10<span
  lang=EN-US style='mso-ansi-language:EN-US'>)<o:p></o:p></span></p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($rows as $row) {
 ?>
 <tr style='mso-yfti-irow:<?php echo $i++; ?>'>
  <td width=154 style='width:115.4pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo $row['num_cases']; ?></p>
  </td>
  <td width=154 style='width:115.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo $row['num_days_off']; ?></p>
  </td>
  <td width=154 style='width:115.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
  style='mso-ansi-language:EN-US'><?php echo $row['mkb_id']; ?></span></p>
  </td>
 </tr>
 <?php } ?>
</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>
<?php } ?>
<p class=MsoNormal style='text-indent:35.4pt'>По основни признаци, показателите на заболеваемостта с временна неработоспособност 
са представени в следната таблица:</p>
<?php
echo $objStats->getAnaliticsTable();
?>

<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<?php

$numRelative = 0;
if($rows = $dbInst->getWorkersByCharts3($firm_id, $date_from, $date_to)) {
	$numRelative = count($rows);
}

?>
<p class=MsoNormal style='text-align:justify;'>6. Относителен
дял на често и дълго боледувалите работещи: <?php
$_cnt = $objStats->rel_cdb_off;
if(!$_cnt) {
	echo "<b style='mso-bidi-font-weight:normal'>Няма предоставени данни</b>";
} else {
	echo "<b style='mso-bidi-font-weight:normal'>".$_cnt.'%</b> (';
	if($_cnt < 30) {
		echo 'нисък';
	} elseif ($_cnt >= 30 && $_cnt <= 60) {
		echo 'среден';
	} else {
		echo 'висок';
	}
	echo ')';
}
?>.</p>

<?php
$cnt = $dbInst->getWorkersWithTmpWorkLoss($firm_id, $date_from, $date_to);
?>
<p class=MsoNormal style='text-align:justify;'>7. Относителен
дял на краткосрочната временна неработоспособност: <?php
$_cnt = round(($cnt['cnt'] / $avgWorkers) * 100, 1);
if(!$_cnt) {
	echo "<b style='mso-bidi-font-weight:normal'>Няма предоставени данни</b>";
} else {
	echo "<b style='mso-bidi-font-weight:normal'>".$_cnt.'%</b> (';
	if($_cnt < 40) {
		echo 'нисък';
	} elseif ($_cnt >= 40 && $_cnt <= 60) {
		echo 'среден';
	} else {
		echo 'висок';
	}
	echo ')';
}
?>.</p>

<p class=MsoNormal style='text-align:justify;'>8. Честота на
работещите с професионални болести: <b style='mso-bidi-font-weight:normal'><?php
$_cnt = ($cnt_2_8 / $avgWorkers) * 100;
echo (($_cnt)?round($_cnt, 2):'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>9. Структура на
работещите с професионална <span class=SpellE>заболяемост</span> по <span
class=SpellE>нозология.</span></p>

<?php
$rows = $dbInst->getWorkersProDiseasesStruct($firm_id, $date_from, $date_to);
if($rows) {
?>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;margin-left:1.9pt;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;mso-padding-alt:
 0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid windowtext;mso-border-insidev:
 .5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=154 style='width:115.4pt;border:solid windowtext 1.0pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>№ по ред</p>
  </td>
  <td width=154 style='width:115.4pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Длъжност на работещите с професионална заболяемост</p>
  </td>
  <td width=154 style='width:115.15pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span class=SpellE>Нозологична</span>
  принадлежност <span lang=EN-US style='mso-ansi-language:EN-US'>(</span>код по</p>
  <p class=MsoNormal align=center style='text-align:center'><span class=SpellE>МКБ-</span>10<span
  lang=EN-US style='mso-ansi-language:EN-US'>)<o:p></o:p></span></p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($rows as $row) {
 ?>
 <tr style='mso-yfti-irow:<?php echo $i; ?>'>
  <td width=154 style='width:115.4pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo $i++; ?></p>
  </td>
  <td width=154 style='width:115.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?php echo $row['position_name']; ?></p>
  </td>
  <td width=154 style='width:115.15pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
  style='mso-ansi-language:EN-US'><?php echo (($row['mkb_id']!='')?$row['mkb_id']:$row['mkb_id_4']); ?></span></p>
  </td>
 </tr>
 <?php } ?>
</table>
<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal style='text-align:justify;'><span
lang=EN-US style='mso-ansi-language:EN-US'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify;'>10. Честота на
работещите с трудови злополуки: <b style='mso-bidi-font-weight:normal'><?php
$_cnt = ($workersWithProDiseases / $avgWorkers) * 100;
echo (($_cnt)?round($_cnt, 2):'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>11. Честота на
работещите със <span class=SpellE>заболяемост</span> с трайна
неработоспособност: <b style='mso-bidi-font-weight:normal'><?php
$_cnt = ($cnt_2_9 / $avgWorkers) * 100;
echo (($_cnt)?round($_cnt, 2):'0'); ?></b>.</p>

<?php
$workersWithCatchedDiseases = $dbInst->getWorkersWithCatchedDiseases($firm_id, $date_from, $date_to);
$workersPassedPreCheckups = $dbInst->getPassedCheckupsWorkers($firm_id, $date_from, $date_to);
?>
<p class=MsoNormal style='text-align:justify;'>12. Честота на
лицата със заболявания, открити при проведените периодични медицински прегледи:
<b style='mso-bidi-font-weight:normal'><?php
$_cnt = ($workersPassedPreCheckups) ? ($workersWithCatchedDiseases / $workersPassedPreCheckups) * 100 : 0;
echo (($_cnt) ? round($_cnt, 2) : 'Няма предоставени данни'); ?></b>.</p>

<p class=MsoNormal style='text-align:justify;'>13. Работещи с
експертно решение на ТЕЛК/НЕЛК – брой и честота на заболяванията с трайна
неработоспособност, професионални болести и трудови злополуки:</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.08%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:
 .5pt solid windowtext;mso-border-insidev:.5pt solid windowtext'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=143 rowspan=2 style='width:107.15pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Професия</p>
  </td>
  <td width=159 colspan=2 style='width:119.2pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-pagination:none;
  mso-layout-grid-align:none;text-autospace:none'><span class=SpellE>Заболяемост</span>
  с трайна</p>
  <p class=MsoNormal align=center style='text-align:center'>неработоспособност</p>
  </td>
  <td width=159 colspan=2 style='width:119.2pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-pagination:none;
  mso-layout-grid-align:none;text-autospace:none'>Професионална</p>
  <p class=MsoNormal align=center style='text-align:center'><span class=SpellE>заболяемост</span></p>
  </td>
  <td width=159 colspan=2 style='width:119.2pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Трудова злополука</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>брой</p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>честота</p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>брой</p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>честота</p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>брой</p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>честота</p>
  </td>
 </tr>

 <?php
 $i = 2;
 $j = 1;
 $totalCnt1 = 0;
 $totalCnt2 = 0;
 $totalCnt3 = 0;
 $totalPercentCnt1 = 0;
 $totalPercentCnt2 = 0;
 $totalPercentCnt3 = 0;

 if(preg_match('/ЛАЛОВА/is', $s['stm_name'])) {
 	$rows = $dbInst->getTelkListDetails_Lalova($firm_id, $date_from, $date_to);
 } else {
 	$rows = $dbInst->getTelkListDetails($firm_id, $date_from, $date_to);
 }

 if($rows) {
 	foreach ($rows as $row) {
 		$totalCnt1 += $row['cnt1'];
 		$totalCnt2 += $row['cnt2'];
 		$totalCnt3 += $row['cnt3'];

 		$percentCnt1 = ($row['cnt1'] / $avgWorkers) * 100;
 		$percentCnt2 = ($row['cnt2'] / $avgWorkers) * 100;
 		$percentCnt3 = ($row['cnt3'] / $avgWorkers) * 100;

 		$totalPercentCnt1 += $percentCnt1;
 		$totalPercentCnt2 += $percentCnt2;
 		$totalPercentCnt3 += $percentCnt3;
 ?>
 <tr style='mso-yfti-irow:<?php echo $i++; ?>'>
  <td width=143 style='width:107.15pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$j++?>. <?=HTMLFormat($row['position_name'])?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['cnt1']?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=round($percentCnt1, 2)?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['cnt2']?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=round($percentCnt2, 2)?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['cnt3']?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=round($percentCnt3, 2)?></p>
  </td>
 </tr>
 <?php }/* end foreach */ ?>
 <tr style='mso-yfti-irow:<?php echo $i++; ?>;mso-yfti-lastrow:yes'>
  <td width=143 style='width:107.15pt;border:solid windowtext 1.0pt;border-top:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal>Общо</p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$totalCnt1?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=round($totalPercentCnt1, 2)?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$totalCnt2?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=round($totalPercentCnt2, 2)?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$totalCnt3?></p>
  </td>
  <td width=79 style='width:59.6pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=round($totalPercentCnt3, 2)?></p>
  </td>
 </tr>
 <?php } ?>
</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal>14. Анализ на връзката между данните за <span class=SpellE>заболяемостта</span>
и трудовата дейност, изводи и препоръки:</p>

<p class=MsoNormal style='text-indent:35.4pt'>Няма пряка връзка между
регистрираните заболявания и условията на труд. Работодателят е предприел всички
необходими мерки за ЗБУТ.</p>

<?php w_footer($s); ?>

</div>

</body>

</html>
