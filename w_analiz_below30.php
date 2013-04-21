<?php
// Test: http://localhost/stm2008/hipokrat/w_analiz_below30.php?firm_id=902&offline=1&date_from=01.01.2010&date_to=31.12.2010&offline=1
require('includes.php');
require('class.stmstats.php');

$offline = (isset($_GET['offline']) && $_GET['offline'] == '1') ? 1 : 0;

$firm_id = (isset($_GET['firm_id']) && is_numeric($_GET['firm_id'])) ? intval($_GET['firm_id']) : 0;
$f = $dbInst->getFirmInfo($firm_id);
if(!$f) {
	die('Липсва индентификатор на фирмата!');
}
$s = $dbInst->getStmInfo();

$stm_name = preg_replace('/\<br\s*\/?\>/', '', $s['stm_name']);

//$dbInst->makeAllMkbUpperCase();

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

$unchecked = 'unchecked.gif';
$checked = 'checked.gif';
$imgpath = "http://" . ((isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_ADDR'].':'.$_SERVER['SERVER_PORT'])) . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/img/";

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
<!--<link rel=File-List href="analiz_below30_02_files/filelist.xml">-->
<title><?=((isset($stm_name))?HTMLFormat($stm_name):'СЛУЖБА ПО ТРУДОВА МЕДИЦИНА')?></title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Plamen</o:Author>
  <o:Template>Normal</o:Template>
  <o:LastAuthor>Plamen</o:LastAuthor>
  <o:Revision>7</o:Revision>
  <o:TotalTime>224</o:TotalTime>
  <o:LastPrinted>2008-04-18T09:44:00Z</o:LastPrinted>
  <o:Created>2008-06-19T08:35:00Z</o:Created>
  <o:LastSaved>2008-06-19T08:45:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>230</o:Words>
  <o:Characters>1317</o:Characters>
  <o:Company>СТМ</o:Company>
  <o:Lines>10</o:Lines>
  <o:Paragraphs>3</o:Paragraphs>
  <o:CharactersWithSpaces>1544</o:CharactersWithSpaces>
  <o:Version>11.5606</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:Zoom>115</w:Zoom>
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
p.msoacetate0, li.msoacetate0, div.msoacetate0
	{mso-style-name:msoacetate;
	mso-style-noshow:yes;
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
	margin:35.95pt 70.85pt 53.95pt 70.85pt;
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
table.a
	{mso-style-name:"Нормална таблица";
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
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="5122"/>
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

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

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

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>2. Описание на боледувалите работещи по данни от болничните
листове</p>

<?php
$data = array();
$rows = $dbInst->getWorkersByCharts($firm_id, $date_from, $date_to);
if($rows) {
	$i = 0;
	$worker_id = -1;
	$line = array();
	foreach ($rows as $row) {
		if($worker_id != $row['worker_id']) {
			$worker_id = $row['worker_id'];
			$line['worker_id'] = $row['worker_id'];
			$line['sex'] = $row['sex'];
			$line['age'] = $row['age'].' г.';
			$line['position_name'] = $row['position_name'];
			$line['mkb_id'] = $row['mkb_id'];
			$data[$i++] = $line;
		} else {
			$data[$i-1]['mkb_id'] .= '; '.$row['mkb_id'];
		}
	}
}
if(count($data)) {
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
  <p class=MsoNormal align=center style='text-align:center'>Пол</p>
  </td>
  <td width=84 style='width:63.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal>Възраст</p>
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
  <p class=MsoNormal align=center style='text-align:center'>(код <span
  class=SpellE>по МКБ-</span>10)</p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($data as $row) {
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
  <p class=MsoNormal align=center style='text-align:center'><?=$row['sex']?></p>
  </td>
  <td width=84 valign=top style='width:63.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['age']?></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=HTMLFormat($row['position_name'])?></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$row['mkb_id']?></p>
  </td>
 </tr>
 <?php } ?>
</table>
<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>3. Често и дълго боледували работещи</p>

<?php
$rows = $dbInst->getWorkersByCharts3($firm_id, $date_from, $date_to);
if($rows) {
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
  <?php if($row['num_primary'] >= 4) { ?>
  <p class=MsoNormal> Често (<?=intval($row['num_primary'])?> бр. първ. болнични) -
  <?php
  if($row['num_primary']) {
  	$query = "	SELECT mkb_id FROM patient_charts
				WHERE worker_id = ".$row['w.worker_id']."
				AND (julianday(hospital_date_from) >= julianday('$date_from'))
				AND (julianday(hospital_date_from) <= julianday('$date_to'))
				AND medical_types LIKE '%\"1\"%'";

  	$fields = $dbInst->fnSelectRows($query);
  	$aMkb = array();
  	foreach ($fields as $field) {
  		$aMkb[] = $field['mkb_id'];
  	}
  	$aMkb = array_unique($aMkb);
  	echo implode('; ', $aMkb);
  } else { echo '0'; }
  ?></p>
  <?php } if($row['days_off'] >= 30) { ?>
  <p class=MsoNormal> Дълго (<?=intval($row['days_off'])?> дни с трудозагуби) -
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

<p class=MsoNormal style='text-indent:35.4pt'>По основни признаци, показателите на заболеваемостта с временна неработоспособност 
са представени в следната таблица:</p>
<?php
$objStats = new StmStats($firm_id, $date_from, $date_to);
echo $objStats->getAnaliticsTable();
?>

<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>4. Описание на работещите с експертно решение на ТЕЛК/НЕЛК
за <?=$dbInst->extractYear($date_from, $date_to)?> г.</p>

<?php
$rows = $dbInst->getWorkersByCharts4($firm_id, $date_from, $date_to);
if($rows) {
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
  <td width=168 style='width:126.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>брой работещи</p>
  </td>
  <td width=360 style='width:270.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Диагнози (код по <span
  class=SpellE>МКБ-</span>10)</p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($rows as $row) {
 ?>
 <tr style='mso-yfti-irow:<?=$i?>;mso-yfti-lastrow:yes'>
  <td width=91 valign=top style='width:68.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$i++?>.</p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['num_workers']?></p>
  </td>
  <td width=360 valign=top style='width:270.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['t.mkb_id_1']?></p>
  </td>
 </tr>
 <?php } ?>
</table>
<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>5. Описание на резултатите от проведените периодични
медицински прегледи</p>

<?php
$rows = $dbInst->query("	SELECT c.checkup_id, w.worker_id, w.sex, 
							(SELECT (strftime('%Y', '$date_to', 'localtime') - strftime('%Y', birth_date, 'localtime'))) AS age, 
							i.position_name
							FROM medical_checkups c 
							LEFT JOIN workers w ON (w.worker_id = c.worker_id) 
							LEFT JOIN firm_struct_map m ON (m.map_id = w.map_id) 
							LEFT JOIN firm_positions i ON (i.position_id = m.position_id) 
							WHERE c.firm_id = $firm_id 
							AND w.is_active = '1' 
							AND w.date_retired = ''
							AND (julianday(c.checkup_date) >= julianday('$date_from')) 
							AND (julianday(c.checkup_date) <= julianday('$date_to')) 
							ORDER BY w.sex, age, w.worker_id");
if(!empty($rows)) {
?>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none'>
 <tr>
  <td width="11%" style='width:11.3%;border:solid windowtext 1.0pt;padding:
  0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>№ по ред</p>
  </td>
  <td width="11%" style='width:11.3%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Пол</p>
  </td>
  <td width="11%" style='width:11.36%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Възраст</p>
  </td>
  <td width="13%" style='width:13.46%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Длъжност</p>
  </td>
  <td width="10%" style='width:10.3%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Фам. заб.</p>
  </td>
  <td width="13%" style='width:13.06%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Анамнеза</p>
  </td>
  <td width="16%" style='width:16.44%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Лаб. изследвания</p>
  </td>
  <td width="12%" style='width:12.76%;border:solid windowtext 1.0pt;border-left:
  none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Заболявания (диагнози)</p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($rows as $row) {
 
 ?>
 <tr>
  <td width="11%" valign=top style='width:11.3%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$i++?>.</p>
  </td>
  <td width="11%" valign=top style='width:11.3%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['sex']?></p>
  </td>
  <td width="11%" valign=top style='width:11.36%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['age']?> г.</p>
  </td>
  <td width="13%" valign=top style='width:13.46%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=HTMLFormat($row['position_name'])?></p>
  </td>
  <td width="10%" valign=top style='width:10.3%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?php
  $sql = "	SELECT d.* 
  			FROM `family_weights` d 
  			LEFT JOIN `medical_checkups` c ON ( c.`checkup_id` = d.`checkup_id` )
  			WHERE d.`worker_id` = $row[worker_id] 
  			AND c.`checkup_date` != ''
  			AND (julianday(c.checkup_date) >= julianday('$date_from')) 
			AND (julianday(c.checkup_date) <= julianday('$date_to')) 
  			ORDER BY `family_weight_id`";
  $flds = $dbInst->query($sql);
  if(!empty($flds)) {
  	$array = array();
  	foreach ($flds as $f) {
  		$array[] = $f['mkb_id'];
  	}
  	echo implode('; ', $array);
  }
  ?>&nbsp;</p>
  </td>
  <td width="13%" valign=top style='width:13.06%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?php
  $sql = "	SELECT d.* 
  			FROM `anamnesis` d 
  			LEFT JOIN `medical_checkups` c ON ( c.`checkup_id` = d.`checkup_id` )
  			WHERE d.`worker_id` = $row[worker_id] 
  			AND c.`checkup_date` != ''
  			AND (julianday(c.checkup_date) >= julianday('$date_from')) 
			AND (julianday(c.checkup_date) <= julianday('$date_to')) 
  			ORDER BY `anamnesis_id`";
  $flds = $dbInst->query($sql);
  if(!empty($flds)) {
  	$array = array();
  	foreach ($flds as $f) {
  		$array[] = $f['mkb_id'];
  	}
  	echo implode('; ', $array);
  }
  ?>&nbsp;</p>
  </td>
  <td width="16%" valign=top style='width:16.44%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?php
  $flds = $dbInst->getLabCheckups($row['checkup_id']);
  if(!empty($flds)) {
  	$array = array();
  	foreach ($flds as $f) {
  		$array[] = $f['indicator_type'].' ('.$f['indicator_name'].') '.$f['checkup_level'];
  	}
  	echo implode('; ', $array);
  }
  ?>&nbsp;</p>
  </td>
  <td width="12%" valign=top style='width:12.76%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?php
  $sql = "	SELECT d.* 
  			FROM `family_diseases` d 
  			LEFT JOIN `medical_checkups` c ON ( c.`checkup_id` = d.`checkup_id` )
  			WHERE d.`worker_id` = $row[worker_id] 
  			AND c.`checkup_date` != ''
  			AND (julianday(c.checkup_date) >= julianday('$date_from')) 
			AND (julianday(c.checkup_date) <= julianday('$date_to')) 
  			ORDER BY `disease_id`";
  $flds = $dbInst->query($sql);
  if(!empty($flds)) {
  	$array = array();
  	foreach ($flds as $f) {
  		$array[] = $f['mkb_id'];
  	}
  	echo implode('; ', $array);
  }
  ?>&nbsp;</p>
  </td>
 </tr>
 <?php } ?>
</table>

<?php } else { ?>

<p class=MsoNormal>Няма предоставени данни</p>

<?php } ?>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>6. Описание на трудовите злополуки за <?=$dbInst->extractYear($date_from, $date_to)?> година – брой и
причини.</p>

<?php
$rows = $dbInst->getWorkersByCharts6($firm_id, $date_from, $date_to);
if($rows && (($rows['reason_04'] > 0) || ($rows['reason_05'] > 0))) {
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
  <td width=180 style='width:135.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Брой трудови
  злополуки</p>
  </td>
  <td width=348 style='width:261.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Причини</p>
  </td>
 </tr>
 <?php
 $i = 1;
 if($rows['reason_04'] > 0) {
 ?>
 <tr style='mso-yfti-irow:<?=$i?>;mso-yfti-lastrow:yes'>
  <td width=91 valign=top style='width:68.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$i++?></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$rows['reason_04']?></p>
  </td>
  <td width=348 valign=top style='width:261.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>04 - Злополука - трудова по чл. 55 ал. 1 от КЗОО</p>
  </td>
 </tr>
 <?php } if($rows['reason_05'] > 0) { ?>
 <tr style='mso-yfti-irow:<?=$i?>;mso-yfti-lastrow:yes'>
  <td width=91 valign=top style='width:68.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$i++?></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$rows['reason_05']?></p>
  </td>
  <td width=348 valign=top style='width:261.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>05 - Злополука - трудова по чл. 55 ал. 2 от КЗООО</p>
  </td>
 </tr>
<?php }?>
</table>
<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>7. Описание на регистрираните професионални болести за <?=$dbInst->extractYear($date_from, $date_to)?>
г. – брой и диагнози.</p>

<?php
$rows = $dbInst->getWorkersByCharts7($firm_id, $date_from, $date_to);
if($rows) {
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
  <td width=180 style='width:135.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Брой регистрирани
  професионални болести</p>
  </td>
  <td width=348 style='width:261.0pt;border:solid windowtext 1.0pt;border-left:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'>Диагнози</p>
  </td>
 </tr>
 <?php
 $i = 1;
 foreach ($rows as $row) {
 ?>
 <tr style='mso-yfti-irow:<?=$i?>;mso-yfti-lastrow:yes'>
  <td width=91 valign=top style='width:68.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><?=$i++?>.</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['cnt']?></p>
  </td>
  <td width=348 valign=top style='width:261.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><?=$row['mkb_id_4']?></p>
  </td>
 </tr>
<?php }?>
</table>
<?php } else { ?>
 <p class=MsoNormal>Няма предоставени данни</p>
<?php } ?>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>8. Анализ на връзката между данните за <span class=SpellE>заболяемостта</span>
и трудовата дейност, изводи и препоръки:</p>

<p class=MsoNormal style='text-indent:35.4pt'>Няма пряка връзка между
регистрираните заболявания и условията на труд. Работодателят е предприел всички
необходими мерки за ЗБУТ.</p>

<?php w_footer($s); ?>

</div>

</body>

</html>
