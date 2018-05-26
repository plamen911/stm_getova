<?php
// http://localhost/stm2008/hipokrat/acc_w_expired_contracts.php?date_from=01.01.2007&date_to=10.01.2007&offline=1
require('includes.php');

$s = $dbInst->getStmInfo();

$stm_name = preg_replace('/\<br\s*\/?\>/', '', $s['stm_name']);

if (!isset($_GET['date_from']) || trim($_GET['date_from']) == '') {
    $y = date('Y') - 1;
    $date_from = date('Y-m-d', mktime(0, 0, 0, 1, 1, $y));
    $date_to = date('Y-m-d', mktime(23, 59, 59, 12, 31, $y));
} else {
    $d = new ParseBGDate();
    if ($d->Parse($_GET['date_from']))
        $date_from = $d->year . '-' . $d->month . '-' . $d->day;
    else
        $date_from = '';
    if ($d->Parse($_GET['date_to']))
        $date_to = $d->year . '-' . $d->month . '-' . $d->day;
    else
        $date_to = '';
    if ($date_from == '' || $date_to == '') {
        $y = date('Y') - 1;
        $date_from = date('Y-m-d', mktime(0, 0, 0, 1, 1, $y));
        $date_to = date('Y-m-d', mktime(23, 59, 59, 12, 31, $y));
    }
}

$sql = "SELECT c.*, f.`name` AS `firm_name`, f.`address`, L.`location_name`,
        f.`phone1` AS `phone1`, f.`phone2` AS `phone2`
		FROM `acc_contracts` c
		LEFT JOIN `firms` f ON (f.`firm_id` = c.`firm_id`)
		LEFT JOIN `locations` L ON (L.`location_id` = f.`location_id`)
		WHERE c.`contract_halt` = '0' 
		AND f.`is_active` = '1'
		AND c.`contract_end_date` >= '$date_from'
		AND c.`contract_end_date` <= '$date_to'
		ORDER BY c.`contract_end_date`, c.`contract_start_date`, `firm_name`";
$rows = $dbInst->query($sql);
$num_rows = (!empty($rows)) ? count($rows) : 0;

$period = str_replace(', ', '_', $dbInst->extractYear($date_from, $date_to));
$period = str_replace(' и ', '_', $period);

require_once("cyrlat.class.php");
$cyrlat = new CyrLat;
$filename = 'Expired_Contracts_' . $cyrlat->cyr2lat($period) . '.doc';

$landscape = 1;
require('phprtflite/rtfbegin.php');

$sect->writeText('<b>С П Р А В К А</b>', $times20, $alignCenter);
$sect->addEmptyParagraph();
$sect->writeText('ОТНОСНО: Сключените договори, които изтичат през периода ' . date('d.m.Y', strtotime($date_from)) . ' – ' . date('d.m.Y', strtotime($date_to)) . ' г.', $times12, $alignLeft);

$sect->addEmptyParagraph();

$sect->writeText('Общ брой договори: ' . $num_rows, $times12, $alignLeft);

if (!empty($num_rows)) {
    $data = array();
    $data[] = array('N', 'Фирма', 'Нас. място', 'Адрес', 'Телефон', 'Дата на сключване', 'Дата на изтичане');
    $i = 1;
    foreach ($rows as $row) {
        $phones = array();
        if (!empty($row['phone1'])) {
            $phones[] = $row['phone1'];
        }
        if (!empty($row['phone2'])) {
            $phones[] = $row['phone2'];
        }

        $data[] = array(
            $i++,
            $row['firm_name'],
            $row['location_name'],
            $row['address'],
            (!empty($phones)) ? implode('; ', $phones) : '',
            (!empty($row['contract_start_date']) && '0000-00-00 00:00:00' !== $row['contract_start_date']) ? date('d.m.y', strtotime($row['contract_start_date'])) : '',
            (!empty($row['contract_end_date']) && '0000-00-00 00:00:00' !== $row['contract_end_date']) ? date('d.m.y', strtotime($row['contract_end_date'])) : ''
        );
    }

    $colWidts = array(1, 8, 3, 6, 4, 2, 2);
    $colAligns = array('center', 'left', 'left', 'left', 'left', 'left', 'left');
    fnGenerateTable($data, $colWidts, $colAligns, $tableType = 'plain');

} else {
    $sect->writeText('Няма договори, които да изтичат през периода от ' . date('d.m.Y', strtotime($date_from)) . ' г. до ' . date('d.m.Y', strtotime($date_to)) . ' г.', $times12, $alignLeft);
}

$timesFooter = $times14;
require('phprtflite/rtfend.php');
