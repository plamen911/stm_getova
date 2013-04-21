<?

class StmStats extends SqliteDB {
	var $firm_id = 0;

	var $anual_workers = 0;		// anual_workers
	var $joined_workers = 0;	// joined_workers
	var $retired_workers = 0;	// retired_workers
	var $anual_men = 0;			// anual_men
	var $joined_men = 0;		// joined_men
	var $retired_men = 0;		// retired_men
	var $anual_women = 0;		// anual_women
	var $joined_women = 0;		// joined_women
	var $retired_women = 0;		// retired_women

	var $avg_workers = 0;
	var $avg_men = 0;
	var $avg_women = 0;

	var $age_25down = 0;
	var $age_25_35 = 0;
	var $age_36_45 = 0;
	var $age_46_55 = 0;
	var $age_55up = 0;

	var $service_5down = 0;
	var $service_5_10 = 0;
	var $service_10up = 0;

	var $worker_ids = '';

	var $sick_anual_workers = 0;
	var $sick_anual_men = 0;
	var $sick_anual_women = 0;
	var $sick_age_25down = 0;
	var $sick_age_25_35 = 0;
	var $sick_age_36_45 = 0;
	var $sick_age_46_55 = 0;
	var $sick_age_55up = 0;
	var $sick_age_25down_men = 0;
	var $sick_age_25_35_men = 0;
	var $sick_age_36_45_men = 0;
	var $sick_age_46_55_men = 0;
	var $sick_age_55up_men = 0;
	var $sick_age_25down_women = 0;
	var $sick_age_25_35_women = 0;
	var $sick_age_36_45_women = 0;
	var $sick_age_46_55_women = 0;
	var $sick_age_55up_women = 0;

	var $no_sick_anual_workers = 0;
	var $no_sick_anual_men = 0;
	var $no_sick_anual_women = 0;
	var $no_sick_age_25down = 0;
	var $no_sick_age_25_35 = 0;
	var $no_sick_age_36_45 = 0;
	var $no_sick_age_46_55 = 0;
	var $no_sick_age_55up = 0;
	var $no_sick_age_25down_men = 0;
	var $no_sick_age_25_35_men = 0;
	var $no_sick_age_36_45_men = 0;
	var $no_sick_age_46_55_men = 0;
	var $no_sick_age_55up_men = 0;
	var $no_sick_age_25down_women = 0;
	var $no_sick_age_25_35_women = 0;
	var $no_sick_age_36_45_women = 0;
	var $no_sick_age_46_55_women = 0;
	var $no_sick_age_55up_women = 0;

	var $primary_charts = 0;
	var $primary_charts_men = 0;
	var $primary_charts_women = 0;
	var $primary_charts_age_25down = 0;
	var $primary_charts_age_25_35 = 0;
	var $primary_charts_age_36_45 = 0;
	var $primary_charts_age_46_55 = 0;
	var $primary_charts_age_55up = 0;

	var $days_off = 0;
	var $days_off_men = 0;
	var $days_off_women = 0;
	var $days_off_age_25down = 0;
	var $days_off_age_25_35 = 0;
	var $days_off_age_36_45 = 0;
	var $days_off_age_46_55 = 0;
	var $days_off_age_55up = 0;

	var $progroup_0 = 0;
	var $progroup_1 = 0;
	var $progroup_2 = 0;
	var $progroup_3 = 0;
	var $progroup_4 = 0;
	var $progroup_5 = 0;
	var $sick_progroup_0 = 0;
	var $sick_progroup_1 = 0;
	var $sick_progroup_2 = 0;
	var $sick_progroup_3 = 0;
	var $sick_progroup_4 = 0;
	var $sick_progroup_5 = 0;
	var $no_sick_progroup_0 = 0;
	var $no_sick_progroup_1 = 0;
	var $no_sick_progroup_2 = 0;
	var $no_sick_progroup_3 = 0;
	var $no_sick_progroup_4 = 0;
	var $no_sick_progroup_5 = 0;
	var $primary_charts_progroup_0 = 0;
	var $primary_charts_progroup_1 = 0;
	var $primary_charts_progroup_2 = 0;
	var $primary_charts_progroup_3 = 0;
	var $primary_charts_progroup_4 = 0;
	var $primary_charts_progroup_5 = 0;
	var $days_off_progroup_0 = 0;
	var $days_off_progroup_1 = 0;
	var $days_off_progroup_2 = 0;
	var $days_off_progroup_3 = 0;
	var $days_off_progroup_4 = 0;
	var $days_off_progroup_5 = 0;
	var $cdb_off_progroup_0 = 0;
	var $cdb_off_progroup_1 = 0;
	var $cdb_off_progroup_2 = 0;
	var $cdb_off_progroup_3 = 0;
	var $cdb_off_progroup_4 = 0;
	var $cdb_off_progroup_5 = 0;
	var $positions_progroup_0 = array();
	var $positions_progroup_1 = array();
	var $positions_progroup_2 = array();
	var $positions_progroup_3 = array();
	var $positions_progroup_4 = array();
	var $positions_progroup_5 = array();

	// dyn. progroups
	var $progroups = array();
	var $sick_progroups = array();
	var $no_sick_progroups = array();
	var $primary_charts_progroups = array();
	var $days_off_progroups = array();
	var $cdb_off_progroups = array();

	// ЧДБ - с 4 и повече случаи с временна неработоспособност (първични болнични листове)
	// и/или с 30 и повече дни с трудозагуби от заболявания за съответния период
	var $cdb_off = 0;
	var $cdb_off_men = 0;
	var $cdb_off_women = 0;
	var $cdb_off_age_25down = 0;
	var $cdb_off_age_25_35 = 0;
	var $cdb_off_age_36_45 = 0;
	var $cdb_off_age_46_55 = 0;
	var $cdb_off_age_55up = 0;

	// Calculated fields
	var $rel_sick_anual_workers = 0;
	var $rel_sick_anual_men = 0;
	var $rel_sick_anual_women = 0;
	var $freq_primary_charts = 0;
	var $freq_primary_charts_men = 0;
	var $freq_primary_charts_women = 0;
	var $freq_days_off = 0;
	var $freq_days_off_men = 0;
	var $freq_days_off_women = 0;
	var $avg_length_of_chart = 0;
	var $avg_length_of_chart_men = 0;
	var $avg_length_of_chart_women = 0;
	var $rel_charts_per_worker = 0;
	var $rel_charts_per_worker_men = 0;
	var $rel_charts_per_worker_women = 0;
	var $rel_charts_per_worker_age_25down = 0;
	var $rel_charts_per_worker_age_25_35 = 0;
	var $rel_charts_per_worker_age_36_45 = 0;
	var $rel_charts_per_worker_age_46_55 = 0;
	var $rel_charts_per_worker_age_55up = 0;
	var $rel_days_off_per_worker = 0;
	var $rel_days_off_per_worker_men = 0;
	var $rel_days_off_per_worker_women = 0;
	var $rel_days_off_per_worker_25down = 0;
	var $rel_days_off_per_worker_25_35 = 0;
	var $rel_days_off_per_worker_36_45 = 0;
	var $rel_days_off_per_worker_46_55 = 0;
	var $rel_days_off_per_worker_55up = 0;
	var $rel_cdb_off = 0;
	var $rel_cdb_off_men = 0;
	var $rel_cdb_off_women = 0;
	var $rel_cdb_off_age_25down = 0;
	var $rel_cdb_off_age_25_35 = 0;
	var $rel_cdb_off_age_36_45 = 0;
	var $rel_cdb_off_age_46_55 = 0;
	var $rel_cdb_off_age_55up = 0;
	var $rel_sick_age_25down = 0;
	var $rel_sick_age_25_35 = 0;
	var $rel_sick_age_36_45 = 0;
	var $rel_sick_age_46_55 = 0;
	var $rel_sick_age_55up = 0;
	var $freq_primary_charts_age_25down = 0;
	var $freq_primary_charts_age_25_35 = 0;
	var $freq_primary_charts_age_36_45 = 0;
	var $freq_primary_charts_age_46_55 = 0;
	var $freq_primary_charts_age_55up = 0;
	var $freq_days_off_age_25down = 0;
	var $freq_days_off_age_25_35 = 0;
	var $freq_days_off_age_36_45 = 0;
	var $freq_days_off_age_46_55 = 0;
	var $freq_days_off_age_55up = 0;
	var $avg_length_of_chart_age_25down = 0;
	var $avg_length_of_chart_age_25_35 = 0;
	var $avg_length_of_chart_age_36_45 = 0;
	var $avg_length_of_chart_age_46_55 = 0;
	var $avg_length_of_chart_age_55up = 0;
	var $rel_sick_progroup_0 = 0;
	var $rel_sick_progroup_1 = 0;
	var $rel_sick_progroup_2 = 0;
	var $rel_sick_progroup_3 = 0;
	var $rel_sick_progroup_4 = 0;
	var $rel_sick_progroup_5 = 0;
	var $freq_primary_charts_progroup_0 = 0;
	var $freq_primary_charts_progroup_1 = 0;
	var $freq_primary_charts_progroup_2 = 0;
	var $freq_primary_charts_progroup_3 = 0;
	var $freq_primary_charts_progroup_4 = 0;
	var $freq_primary_charts_progroup_5 = 0;
	var $freq_days_off_progroup_0 = 0;
	var $freq_days_off_progroup_1 = 0;
	var $freq_days_off_progroup_2 = 0;
	var $freq_days_off_progroup_3 = 0;
	var $freq_days_off_progroup_4 = 0;
	var $freq_days_off_progroup_5 = 0;
	var $avg_length_of_chart_progroup_0 = 0;
	var $avg_length_of_chart_progroup_1 = 0;
	var $avg_length_of_chart_progroup_2 = 0;
	var $avg_length_of_chart_progroup_3 = 0;
	var $avg_length_of_chart_progroup_4 = 0;
	var $avg_length_of_chart_progroup_5 = 0;
	var $rel_cdb_off_progroup_0 = 0;
	var $rel_cdb_off_progroup_1 = 0;
	var $rel_cdb_off_progroup_2 = 0;
	var $rel_cdb_off_progroup_3 = 0;
	var $rel_cdb_off_progroup_4 = 0;
	var $rel_cdb_off_progroup_5 = 0;
	var $rel_charts_per_worker_progroup_0 = 0;
	var $rel_charts_per_worker_progroup_1 = 0;
	var $rel_charts_per_worker_progroup_2 = 0;
	var $rel_charts_per_worker_progroup_3 = 0;
	var $rel_charts_per_worker_progroup_4 = 0;
	var $rel_charts_per_worker_progroup_5 = 0;
	var $rel_days_off_per_worker_progroup_0 = 0;
	var $rel_days_off_per_worker_progroup_1 = 0;
	var $rel_days_off_per_worker_progroup_2 = 0;
	var $rel_days_off_per_worker_progroup_3 = 0;
	var $rel_days_off_per_worker_progroup_4 = 0;
	var $rel_days_off_per_worker_progroup_5 = 0;

	// dyn. progroups
	var $rel_sick_progroups = array();
	var $freq_primary_charts_progroups = array();
	var $freq_days_off_progroups = array();
	var $avg_length_of_chart_progroups = array();
	var $rel_cdb_off_progroups = array();
	var $rel_charts_per_worker_progroups = array();
	var $rel_days_off_per_worker_progroups = array();

	function __construct($firm_id = 0, $date_from = '2010-01-01 00:00:00', $date_to = '2011-12-31 23:59:59') {
		$this->firm_id = $firm_id;

		$date_from = (!empty($date_from) && false !== $ts = strtotime($date_from)) ? date('Y-m-d H:i:s', $ts) : date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 1, (date('Y') - 1)));
		$date_to = (!empty($date_to) && false !== $ts = strtotime($date_to)) ? date('Y-m-d H:i:s', $ts) : date('Y-m-d H:i:s', mktime(23, 59, 59, 12, 31, date('Y')));
		$dt = substr($date_to, 0, 10);
		list($last_year, $last_month, $last_day) = explode('-', $dt);
		$ts_date_from = strtotime($date_from);
		$ts_date_to = strtotime($date_to);

		$IDs = array();
		$sql = "SELECT w.`worker_id` , w.`sex` , w.`egn` , w.`birth_date`, w.`map_id` ,
				w.`date_curr_position_start` , w.`date_career_start` , w.`date_retired` , i.`position_name` , 
				g.id AS progroup_id, g.parent AS parent_id, g.num AS `progroup`, g.name AS progroup_name
				FROM `workers` w 
				LEFT JOIN `firm_struct_map` m ON ( m.`map_id` = w.`map_id` )
				LEFT JOIN `firm_positions` i ON ( i.`position_id` = m.`position_id` )
				LEFT JOIN `pro_groups` g ON ( g.`id` = i.`progroup` )
				WHERE w.`firm_id` = $firm_id 
				AND w.`is_active` = '1'
				AND ( date_retired = '' OR julianday(date_retired) >= julianday('$date_from') )
				AND ( date_curr_position_start = '' OR julianday(date_curr_position_start) <= julianday('$date_to') )";
		$rows = $this->query($sql);
		$is_joined = 0;
		if(!empty($rows)) {
			$wIDs = array();
			$sIDs = array();
			$_row = array();
			foreach ($rows as $row) {
				$IDs[] = $row['worker_id'];
				$date_retired = strtotime($row['date_retired']);
				$date_curr_position_start = strtotime($row['date_curr_position_start']);
				$sex = $row['sex'];
				$worker_age = 0;
				if(!empty($row['birth_date'])) {
					list($birth_year, $birth_month, $birth_day) = explode('-', substr($row['birth_date'], 0, 10)) ;
					$worker_age = calculate_age($birth_day, $birth_month, $birth_year, $last_day, $last_month, $last_year);
				}
				// anual_workers
				if(( empty($row['date_retired']) || $date_retired >= $ts_date_to ) && ( $date_curr_position_start <= $ts_date_from || empty($row['date_curr_position_start']) )) {
					$this->anual_workers++;
				}
				$is_joined = 0;
				$count_as = 1;
				// joined_workers
				if(( $date_curr_position_start > $ts_date_from ) && ( $date_curr_position_start <= $ts_date_to )) {
					$this->joined_workers++;
					$is_joined = 1;
					$count_as = 0.5;
				}
				// retired_workers
				if(!$is_joined && ( $date_retired >= $ts_date_from ) && ( $date_retired <= $ts_date_to )) {
					$this->retired_workers++;
					$count_as = 0.5;
				}
				// anual_men
				if(( empty($row['date_retired']) || $date_retired >= $ts_date_to ) && ( $date_curr_position_start <= $ts_date_from || empty($row['date_curr_position_start']) ) && ( $sex == 'М' || $sex == '' )) {
					$this->anual_men++;
				}
				$is_joined = 0;
				// joined_men
				if(( $date_curr_position_start > $ts_date_from ) && ( $date_curr_position_start <= $ts_date_to ) && ( $sex == 'М' || $sex == '' )) {
					$this->joined_men++;
					$is_joined = 1;
				}
				// retired_men
				if(!$is_joined && ( $date_retired >= $ts_date_from ) && ( $date_retired <= $ts_date_to ) && ( $sex == 'М' || $sex == '' )) {
					$this->retired_men++;
				}

				// anual_women
				if(( empty($row['date_retired']) || $date_retired >= $ts_date_to ) && ( $date_curr_position_start <= $ts_date_from || empty($row['date_curr_position_start']) ) && ( $sex == 'Ж' )) {
					$this->anual_women++;
				}
				$is_joined = 0;
				// joined_women
				if(( $date_curr_position_start > $ts_date_from ) && ( $date_curr_position_start <= $ts_date_to ) && ( $sex == 'Ж' )) {
					$this->joined_women++;
					$is_joined = 1;
				}
				// retired_women
				if(!$is_joined && ( $date_retired >= $ts_date_from ) && ( $date_retired <= $ts_date_to ) && ( $sex == 'Ж' )) {
					$this->retired_women++;
				}
				// ages
				if($worker_age < 25) { $this->age_25down += $count_as; }
				elseif ($worker_age >= 25 && $worker_age <= 35 ) { $this->age_25_35 += $count_as; }
				elseif ($worker_age > 35 && $worker_age <= 45 ) { $this->age_36_45 += $count_as; }
				elseif ($worker_age > 45 && $worker_age <= 55 ) { $this->age_46_55 += $count_as; }
				else { $this->age_55up += $count_as; }
				// service lengths
				$date_curr_position_start = $row['date_curr_position_start'];
				if(empty($date_curr_position_start)) $this->service_5down += $count_as;
				else {
					$dt = substr($date_curr_position_start, 0, 10);
					list($position_year, $position_month, $position_day) = explode('-', $dt);
					$t = calculate_age($position_day, $position_month, $position_year, $last_day, $last_month, $last_year);
					if($t < 5) { $this->service_5down += $count_as; }
					elseif ($t >= 5 && $t < 10) { $this->service_5_10 += $count_as; }
					elseif ($t >= 10) { $this->service_10up += $count_as; }
				}
				$wIDs[$row['worker_id']] = $count_as;
				$sIDs[$row['worker_id']] = $sex;
				if(empty($row['progroup'])) $row['progroup'] = 0;
				$row['age'] = $worker_age;
				$row['count_as'] = $count_as;
				$_row[$row['worker_id']] = $row;

				if(!isset($this->progroups[$row['progroup']])) $this->progroups[$row['progroup']] = 0;
				$this->progroups[$row['progroup']] += $count_as;

				$this->{'progroup_'.$row['progroup']} += $count_as;
				$this->{'positions_progroup_'.$row['progroup']}[$row['position_name']] = $row['position_name'];
			}
			if(isset($this->progroups[0])) unset($this->progroups[0]);
			ksort($this->progroups);
			for($i = 0; $i <= 5; $i++) {
				$this->{'positions_progroup_'.$i} = array_map(array('SqliteDB', 'my_mb_ucfirst'), $this->{'positions_progroup_'.$i});
			}
			$this->avg_workers = $this->anual_workers + (($this->joined_workers + $this->retired_workers) / 2);
			$this->avg_men = $this->anual_men + (($this->joined_men + $this->retired_men) / 2);
			$this->avg_women = $this->anual_women + (($this->joined_women + $this->retired_women) / 2);
			$this->worker_ids = implode(',', $IDs);

			$sql = "SELECT * FROM `patient_charts` WHERE `worker_id` IN (".implode(',', $IDs).") AND ((julianday(`hospital_date_from`) >= julianday('$date_from'))
AND (julianday(`hospital_date_from`) <= julianday('$date_to')))";
			$rows = $this->query($sql);
			// Sick workers
			$sick_wIDs = array();
			$primaries = array();
			if(!empty($rows)) {
				$sick_anual_workers = array();
				$sick_anual_men = array();
				$sick_anual_women = array();
				$cdb = array();
				foreach ($rows as $row) {
					$sick_anual_workers[$row['worker_id']] = $row['worker_id'];
					if($sIDs[$row['worker_id']] == 'Ж') { $sick_anual_women[$row['worker_id']] = $row['worker_id']; }
					else { $sick_anual_men[$row['worker_id']] = $row['worker_id']; }
					$sick_wIDs[$row['worker_id']] = $row['worker_id'];
					if(!empty($row['medical_types']) && $medical_types = unserialize($row['medical_types'])) {
						if(in_array(1, $medical_types)) {
							$primaries[] = $row;

							(isset($cdb[$row['worker_id']]['primary'])) ? $cdb[$row['worker_id']]['primary'] += 1 : $cdb[$row['worker_id']]['primary'] = 1;
						}
					}
					$this->days_off += $row['days_off'];
					$this->{'days_off_progroup_'.$_row[$row['worker_id']]['progroup']} += $row['days_off'];

					if(!isset($this->days_off_progroups[$_row[$row['worker_id']]['progroup']])) $this->days_off_progroups[$_row[$row['worker_id']]['progroup']] =0;
					$this->days_off_progroups[$_row[$row['worker_id']]['progroup']] += $row['days_off'];

					if($sIDs[$row['worker_id']] == 'Ж') { $this->days_off_women += $row['days_off']; }
					else { $this->days_off_men += $row['days_off']; }
					$this->_assignWorkerAgeToGroup($_row[$row['worker_id']]['age'], $row['days_off'], 'days_off_age', '');
					(isset($cdb[$row['worker_id']]['days_off'])) ? $cdb[$row['worker_id']]['days_off'] += $row['days_off'] : $cdb[$row['worker_id']]['days_off'] = $row['days_off'];
				}
				foreach ($sick_anual_workers as $worker_id) {
					$this->sick_anual_workers += $wIDs[$worker_id];
					$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], $wIDs[$worker_id], 'sick_age', '');
					$this->{'sick_progroup_'.$_row[$worker_id]['progroup']} += $wIDs[$worker_id];

					if(!isset($this->sick_progroups[$_row[$worker_id]['progroup']])) $this->sick_progroups[$_row[$worker_id]['progroup']] = 0;
					$this->sick_progroups[$_row[$worker_id]['progroup']] += $wIDs[$worker_id];
				}
				foreach ($sick_anual_women as $worker_id) {
					$this->sick_anual_women += $wIDs[$worker_id];
					$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], $wIDs[$worker_id], 'sick_age', '_women');
				}
				foreach ($sick_anual_men as $worker_id) {
					$this->sick_anual_men += $wIDs[$worker_id];
					$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], $wIDs[$worker_id], 'sick_age', '_men');
				}
			}
			// No sick workers
			$no_sick_wIDs = array_diff($IDs, $sick_wIDs);
			if(!empty($no_sick_wIDs)) {
				$no_sick_anual_workers = array();
				$no_sick_anual_men = array();
				$no_sick_anual_women = array();
				foreach ($no_sick_wIDs as $worker_id) {
					$row = $_row[$worker_id];
					$no_sick_anual_workers[$row['worker_id']] = $row['worker_id'];
					if($sIDs[$row['worker_id']] == 'Ж') { $no_sick_anual_women[$row['worker_id']] = $row['worker_id']; }
					else { $no_sick_anual_men[$row['worker_id']] = $row['worker_id']; }
				}
				foreach ($no_sick_anual_workers as $worker_id) {
					$this->no_sick_anual_workers += $wIDs[$worker_id];
					$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], $wIDs[$worker_id], 'no_sick_age', '');
					$this->{'no_sick_progroup_'.$_row[$worker_id]['progroup']} += $wIDs[$worker_id];

					if(!isset($this->no_sick_progroups[$_row[$worker_id]['progroup']])) $this->no_sick_progroups[$_row[$worker_id]['progroup']] = 0;
					$this->no_sick_progroups[$_row[$worker_id]['progroup']] += $wIDs[$worker_id];
				}
				foreach ($no_sick_anual_women as $worker_id) {
					$this->no_sick_anual_women += $wIDs[$worker_id];
					$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], $wIDs[$worker_id], 'no_sick_age', '_women');
				}
				foreach ($no_sick_anual_men as $worker_id) {
					$this->no_sick_anual_men += $wIDs[$worker_id];
					$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], $wIDs[$worker_id], 'no_sick_age', '_men');
				}
			}
			// Calc. primary cases
			$this->primary_charts = count($primaries);
			if(!empty($primaries)) {
				foreach ($primaries as $row) {
					if($sIDs[$row['worker_id']] == 'Ж') { $this->primary_charts_women += 1; }
					else { $this->primary_charts_men += 1; }
					$this->_assignWorkerAgeToGroup($_row[$row['worker_id']]['age'], 1, 'primary_charts_age', '');
					$this->{'primary_charts_progroup_'.$_row[$row['worker_id']]['progroup']} += 1;

					if(!isset($this->primary_charts_progroups[$_row[$row['worker_id']]['progroup']])) $this->primary_charts_progroups[$_row[$row['worker_id']]['progroup']] = 0;
					$this->primary_charts_progroups[$_row[$row['worker_id']]['progroup']] += 1;
				}
			}
			//
			if(!empty($cdb)) {
				// 1st pass - get rid redundant records
				foreach ($cdb as $worker_id => $row) {
					if(!isset($row['primary'])) {
						$cdb[$worker_id]['primary'] = $row['primary'] = 0;
					}
					if($row['primary'] >= 4 || $row['days_off'] >= 30) { /*It's OK!*/ }
					else { unset($cdb[$worker_id]); }
				}
				$this->cdb_off = count($cdb);
				// 2nd pass
				if(!empty($cdb)) {
					foreach ($cdb as $worker_id => $row) {
						if($sIDs[$worker_id] == 'Ж') { $this->cdb_off_women += 1; }
						else { $this->cdb_off_men += 1; }
						$this->_assignWorkerAgeToGroup($_row[$worker_id]['age'], 1, 'cdb_off_age', '');
						$this->{'cdb_off_progroup_'.$_row[$worker_id]['progroup']} += 1;

						if(!isset($this->cdb_off_progroups[$_row[$worker_id]['progroup']])) $this->cdb_off_progroups[$_row[$worker_id]['progroup']] = 0;
						$this->cdb_off_progroups[$_row[$worker_id]['progroup']] += 1;
					}
				}
			}
			unset($rows);
		}
		// Calculations
		$this->rel_sick_anual_workers = (!empty($this->avg_workers)) ? number_format($this->sick_anual_workers / $this->avg_workers * 100, 1, '.', '') : '0.0';
		$this->rel_sick_anual_men = (!empty($this->avg_men)) ? number_format($this->sick_anual_men / $this->avg_men * 100, 1, '.', '') : '0.0';
		$this->rel_sick_anual_women = (!empty($this->avg_women)) ? number_format($this->sick_anual_women / $this->avg_women * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts = (!empty($this->avg_workers)) ? number_format($this->primary_charts / $this->avg_workers * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_men = (!empty($this->avg_men)) ? number_format($this->primary_charts_men / $this->avg_men * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_women = (!empty($this->avg_women)) ? number_format($this->primary_charts_women / $this->avg_women * 100, 1, '.', '') : '0.0';

		$this->freq_days_off = (!empty($this->avg_workers)) ? number_format($this->days_off / $this->avg_workers * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_men = (!empty($this->avg_men)) ? number_format($this->days_off_men / $this->avg_men * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_women = (!empty($this->avg_women)) ? number_format($this->days_off_women / $this->avg_women * 100, 1, '.', '') : '0.0';

		$this->avg_length_of_chart = (!empty($this->primary_charts)) ? number_format($this->days_off / $this->primary_charts, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_men = (!empty($this->primary_charts_men)) ? number_format($this->days_off_men / $this->primary_charts_men, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_women = (!empty($this->primary_charts_women)) ? number_format($this->days_off_women / $this->primary_charts_women, 1, '.', '') : '0.0';

		$this->rel_charts_per_worker = (!empty($this->sick_anual_workers)) ? number_format($this->primary_charts / $this->sick_anual_workers, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_men = (!empty($this->sick_anual_men)) ? number_format($this->primary_charts_men / $this->sick_anual_men, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_women = (!empty($this->sick_anual_women)) ? number_format($this->primary_charts_women / $this->sick_anual_women, 1, '.', '') :'0.0';
		$this->rel_charts_per_worker_age_25down = (!empty($this->sick_age_25down)) ? number_format($this->primary_charts_age_25down / $this->sick_age_25down, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_age_25_35 = (!empty($this->sick_age_25_35)) ? number_format($this->primary_charts_age_25_35 / $this->sick_age_25_35, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_age_36_45 = (!empty($this->sick_age_36_45)) ? number_format($this->primary_charts_age_36_45 / $this->sick_age_36_45, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_age_46_55 = (!empty($this->sick_age_46_55)) ? number_format($this->primary_charts_age_46_55 / $this->sick_age_46_55, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_age_55up = (!empty($this->sick_age_55up)) ? number_format($this->primary_charts_age_55up / $this->sick_age_55up, 1, '.', '') : '0.0';

		$this->rel_days_off_per_worker = (!empty($this->sick_anual_workers)) ? number_format($this->days_off / $this->sick_anual_workers, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_men = (!empty($this->sick_anual_men)) ? number_format($this->days_off_men / $this->sick_anual_men, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_women = (!empty($this->sick_anual_women)) ? number_format($this->days_off_women / $this->sick_anual_women, 1, '.', ''):'0.0';
		$this->rel_days_off_per_worker_25down = (!empty($this->sick_age_25down)) ? number_format($this->days_off_age_25down / $this->sick_age_25down, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_25_35 = (!empty($this->sick_age_25_35)) ? number_format($this->days_off_age_25_35 / $this->sick_age_25_35, 1, '.', ''):'0.0';
		$this->rel_days_off_per_worker_36_45 = (!empty($this->sick_age_36_45)) ? number_format($this->days_off_age_36_45 / $this->sick_age_36_45, 1, '.', ''):'0.0';
		$this->rel_days_off_per_worker_46_55 = (!empty($this->sick_age_46_55)) ? number_format($this->days_off_age_46_55 / $this->sick_age_46_55, 1, '.', ''):'0.0';
		$this->rel_days_off_per_worker_55up = (!empty($this->sick_age_55up)) ? number_format($this->days_off_age_55up / $this->sick_age_55up, 1, '.', '') : '0.0';

		$this->rel_cdb_off = (!empty($this->avg_workers)) ? number_format($this->cdb_off / $this->avg_workers * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_men = (!empty($this->avg_men)) ? number_format($this->cdb_off_men / $this->avg_men * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_women = (!empty($this->avg_women)) ? number_format($this->cdb_off_women / $this->avg_women * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_age_25down = (!empty($this->age_25down)) ? number_format($this->cdb_off_age_25down / $this->age_25down * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_age_25_35 = (!empty($this->age_25_35)) ? number_format($this->cdb_off_age_25_35 / $this->age_25_35 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_age_36_45 = (!empty($this->age_36_45)) ? number_format($this->cdb_off_age_36_45 / $this->age_36_45 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_age_46_55 = (!empty($this->age_46_55)) ? number_format($this->cdb_off_age_46_55 / $this->age_46_55 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_age_55up = (!empty($this->age_55up)) ? number_format($this->cdb_off_age_55up / $this->age_55up * 100, 1, '.', '') : '0.0';

		$this->rel_sick_age_25down = (!empty($this->age_25down)) ? number_format($this->sick_age_25down / $this->age_25down * 100, 1, '.', '') : '0.0';
		$this->rel_sick_age_25_35 = (!empty($this->age_25_35)) ? number_format($this->sick_age_25_35 / $this->age_25_35 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_age_36_45 = (!empty($this->age_36_45)) ? number_format($this->sick_age_36_45 / $this->age_36_45 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_age_46_55 = (!empty($this->age_46_55)) ? number_format($this->sick_age_46_55 / $this->age_46_55 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_age_55up = (!empty($this->age_55up)) ? number_format($this->sick_age_55up / $this->age_55up * 100, 1, '.', '') : '0.0';

		$this->freq_primary_charts_age_25down = (!empty($this->age_25down)) ? number_format($this->primary_charts_age_25down / $this->age_25down * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_age_25_35 =(!empty($this->age_25_35))?number_format($this->primary_charts_age_25_35 / $this->age_25_35 * 100, 1, '.', '') :'0.0';
		$this->freq_primary_charts_age_36_45 =(!empty($this->age_36_45))?number_format($this->primary_charts_age_36_45 / $this->age_36_45 * 100, 1, '.', '') :'0.0';
		$this->freq_primary_charts_age_46_55 =(!empty($this->age_46_55))?number_format($this->primary_charts_age_46_55 / $this->age_46_55 * 100, 1, '.', '') :'0.0';
		$this->freq_primary_charts_age_55up = (!empty($this->age_55up)) ? number_format($this->primary_charts_age_55up / $this->age_55up * 100, 1, '.', '') : '0.0';

		$this->freq_days_off_age_25down = (!empty($this->age_25down)) ? number_format($this->days_off_age_25down / $this->age_25down * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_age_25_35 = (!empty($this->age_25_35)) ? number_format($this->days_off_age_25_35 / $this->age_25_35 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_age_36_45 = (!empty($this->age_36_45)) ? number_format($this->days_off_age_36_45 / $this->age_36_45 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_age_46_55 = (!empty($this->age_46_55)) ? number_format($this->days_off_age_46_55 / $this->age_46_55 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_age_55up = (!empty($this->age_55up)) ? number_format($this->days_off_age_55up / $this->age_55up * 100, 1, '.', '') : '0.0';

		$this->avg_length_of_chart_age_25down = (!empty($this->primary_charts_age_25down)) ? number_format($this->days_off_age_25down / $this->primary_charts_age_25down, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_age_25_35 = (!empty($this->primary_charts_age_25_35)) ? number_format($this->days_off_age_25_35 / $this->primary_charts_age_25_35, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_age_36_45 = (!empty($this->primary_charts_age_36_45)) ? number_format($this->days_off_age_36_45 / $this->primary_charts_age_36_45, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_age_46_55 = (!empty($this->primary_charts_age_46_55)) ? number_format($this->days_off_age_46_55 / $this->primary_charts_age_46_55, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_age_55up = (!empty($this->primary_charts_age_55up)) ? number_format($this->days_off_age_55up / $this->primary_charts_age_55up, 1, '.', '') : '0.0';
		// Professional groups
		$this->rel_sick_progroup_0 = (!empty($this->progroup_0)) ? number_format($this->sick_progroup_0 / $this->progroup_0 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_progroup_1 = (!empty($this->progroup_1)) ? number_format($this->sick_progroup_1 / $this->progroup_1 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_progroup_2 = (!empty($this->progroup_2)) ? number_format($this->sick_progroup_2 / $this->progroup_2 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_progroup_3 = (!empty($this->progroup_3)) ? number_format($this->sick_progroup_3 / $this->progroup_3 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_progroup_4 = (!empty($this->progroup_4)) ? number_format($this->sick_progroup_4 / $this->progroup_4 * 100, 1, '.', '') : '0.0';
		$this->rel_sick_progroup_5 = (!empty($this->progroup_5)) ? number_format($this->sick_progroup_5 / $this->progroup_5 * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_progroup_0 = (!empty($this->progroup_0)) ? number_format($this->primary_charts_progroup_0 / $this->progroup_0 * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_progroup_1 = (!empty($this->progroup_1)) ? number_format($this->primary_charts_progroup_1 / $this->progroup_1 * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_progroup_2 = (!empty($this->progroup_2)) ? number_format($this->primary_charts_progroup_2 / $this->progroup_2 * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_progroup_3 = (!empty($this->progroup_3)) ? number_format($this->primary_charts_progroup_3 / $this->progroup_3 * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_progroup_4 = (!empty($this->progroup_4)) ? number_format($this->primary_charts_progroup_4 / $this->progroup_4 * 100, 1, '.', '') : '0.0';
		$this->freq_primary_charts_progroup_5 = (!empty($this->progroup_5)) ? number_format($this->primary_charts_progroup_5 / $this->progroup_5 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_progroup_0 = (!empty($this->progroup_0)) ? number_format($this->days_off_progroup_0 / $this->progroup_0 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_progroup_1 = (!empty($this->progroup_1)) ? number_format($this->days_off_progroup_1 / $this->progroup_1 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_progroup_2 = (!empty($this->progroup_2)) ? number_format($this->days_off_progroup_2 / $this->progroup_2 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_progroup_3 = (!empty($this->progroup_3)) ? number_format($this->days_off_progroup_3 / $this->progroup_3 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_progroup_4 = (!empty($this->progroup_4)) ? number_format($this->days_off_progroup_4 / $this->progroup_4 * 100, 1, '.', '') : '0.0';
		$this->freq_days_off_progroup_5 = (!empty($this->progroup_5)) ? number_format($this->days_off_progroup_5 / $this->progroup_5 * 100, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_progroup_0 = (!empty($this->primary_charts_progroup_0)) ? number_format($this->days_off_progroup_0 / $this->primary_charts_progroup_0, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_progroup_1 = (!empty($this->primary_charts_progroup_1)) ? number_format($this->days_off_progroup_1 / $this->primary_charts_progroup_1, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_progroup_2 = (!empty($this->primary_charts_progroup_2)) ? number_format($this->days_off_progroup_2 / $this->primary_charts_progroup_2, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_progroup_3 = (!empty($this->primary_charts_progroup_3)) ? number_format($this->days_off_progroup_3 / $this->primary_charts_progroup_3, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_progroup_4 = (!empty($this->primary_charts_progroup_4)) ? number_format($this->days_off_progroup_4 / $this->primary_charts_progroup_4, 1, '.', '') : '0.0';
		$this->avg_length_of_chart_progroup_5 = (!empty($this->primary_charts_progroup_5)) ? number_format($this->days_off_progroup_5 / $this->primary_charts_progroup_5, 1, '.', '') : '0.0';
		$this->rel_cdb_off_progroup_0 = (!empty($this->progroup_0)) ? number_format($this->cdb_off_progroup_0 / $this->progroup_0 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_progroup_1 = (!empty($this->progroup_1)) ? number_format($this->cdb_off_progroup_1 / $this->progroup_1 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_progroup_2 = (!empty($this->progroup_2)) ? number_format($this->cdb_off_progroup_2 / $this->progroup_2 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_progroup_3 = (!empty($this->progroup_3)) ? number_format($this->cdb_off_progroup_3 / $this->progroup_3 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_progroup_4 = (!empty($this->progroup_4)) ? number_format($this->cdb_off_progroup_4 / $this->progroup_4 * 100, 1, '.', '') : '0.0';
		$this->rel_cdb_off_progroup_5 = (!empty($this->progroup_5)) ? number_format($this->cdb_off_progroup_5 / $this->progroup_5 * 100, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_progroup_0 = (!empty($this->sick_progroup_0)) ? number_format($this->primary_charts_progroup_0 / $this->sick_progroup_0, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_progroup_1 = (!empty($this->sick_progroup_1)) ? number_format($this->primary_charts_progroup_1 / $this->sick_progroup_1, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_progroup_2 = (!empty($this->sick_progroup_2)) ? number_format($this->primary_charts_progroup_2 / $this->sick_progroup_2, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_progroup_3 = (!empty($this->sick_progroup_3)) ? number_format($this->primary_charts_progroup_3 / $this->sick_progroup_3, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_progroup_4 = (!empty($this->sick_progroup_4)) ? number_format($this->primary_charts_progroup_4 / $this->sick_progroup_4, 1, '.', '') : '0.0';
		$this->rel_charts_per_worker_progroup_5 = (!empty($this->sick_progroup_5)) ? number_format($this->primary_charts_progroup_5 / $this->sick_progroup_5, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_progroup_0 = (!empty($this->sick_progroup_0)) ? number_format($this->days_off_progroup_0 / $this->sick_progroup_0, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_progroup_1 = (!empty($this->sick_progroup_1)) ? number_format($this->days_off_progroup_1 / $this->sick_progroup_1, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_progroup_2 = (!empty($this->sick_progroup_2)) ? number_format($this->days_off_progroup_2 / $this->sick_progroup_2, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_progroup_3 = (!empty($this->sick_progroup_3)) ? number_format($this->days_off_progroup_3 / $this->sick_progroup_3, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_progroup_4 = (!empty($this->sick_progroup_4)) ? number_format($this->days_off_progroup_4 / $this->sick_progroup_4, 1, '.', '') : '0.0';
		$this->rel_days_off_per_worker_progroup_5 = (!empty($this->sick_progroup_5)) ? number_format($this->days_off_progroup_5 / $this->sick_progroup_5, 1, '.', '') : '0.0';

		if($this->_hasProGroups()) {
			foreach ($this->progroups as $key => $progroup) {
				$sick_progroup = (isset($this->sick_progroups[$key])) ? $this->sick_progroups[$key] : 0;
				$primary_charts_progroup = (isset($this->primary_charts_progroups[$key])) ? $this->primary_charts_progroups[$key] : 0;
				$days_off_progroup = (isset($this->days_off_progroups[$key])) ? $this->days_off_progroups[$key] : 0;
				$cdb_off_progroup = (isset($this->cdb_off_progroups[$key])) ? $this->cdb_off_progroups[$key] : 0;

				$this->rel_sick_progroups[$key] = (!empty($progroup)) ? number_format($sick_progroup / $progroup * 100, 1, '.', '') : '0.0';
				$this->freq_primary_charts_progroups[$key] = (!empty($progroup)) ? number_format($primary_charts_progroup / $progroup * 100, 1, '.', '') : '0.0';
				$this->freq_days_off_progroups[$key] = (!empty($progroup)) ? number_format($days_off_progroup / $progroup * 100, 1, '.', '') : '0.0';
				$this->avg_length_of_chart_progroups[$key] = (!empty($primary_charts_progroup)) ? number_format($days_off_progroup / $primary_charts_progroup, 1, '.', '') : '0.0';
				$this->rel_cdb_off_progroups[$key] = (!empty($progroup)) ? number_format($cdb_off_progroup / $progroup * 100, 1, '.', '') : '0.0';
				$this->rel_charts_per_worker_progroups[$key] = (!empty($sick_progroup)) ? number_format($primary_charts_progroup / $sick_progroup, 1, '.', '') : '0.0';
				$this->rel_days_off_per_worker_progroups[$key] = (!empty($sick_progroup)) ? number_format($days_off_progroup / $sick_progroup, 1, '.', '') : '0.0';
			}
		}
	}

	private function _assignWorkerAgeToGroup($worker_age = 0, $count_as = 1, $pref = 'no_sick_age', $suf = '_men') {
		// ages
		if($worker_age < 25) { $this->{$pref.'_25down'.$suf} += $count_as; }
		elseif ($worker_age >= 25 && $worker_age <= 35 ) { $this->{$pref.'_25_35'.$suf} += $count_as; }
		elseif ($worker_age > 35 && $worker_age <= 45 ) { $this->{$pref.'_36_45'.$suf} += $count_as; }
		elseif ($worker_age > 45 && $worker_age <= 55 ) { $this->{$pref.'_46_55'.$suf} += $count_as; }
		else { $this->{$pref.'_55up'.$suf} += $count_as; }
	}

	private function _hasProGroups() {
		return !empty($this->progroups);
	}

	public function getHtmlTables() {
		ob_start();
		?>
		<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td rowspan="2">&nbsp;</td>
		    <td colspan="3"><div align="center"><strong>средно списъчен състав</strong></div></td>
		    <td colspan="5"><div align="center"><strong>възрастови групи</strong></div></td>
		    <td colspan="3"><div align="center"><strong>групи по общ трудов стаж</strong></div></td>
		    <td colspan="3"><div align="center"><strong>групи по специален трудов стаж</strong></div></td>
		    <td colspan="5"><div align="center"><strong>основни професионални групи</strong></div></td>
		    <?php if($cnt = count($this->progroups)) { ?>
		    <td colspan="<?=$cnt?>"><div align="center"><strong>основни професионални групи</strong></div></td>		
		    <?php } ?>
		  </tr>
		  <tr>
		    <td><div align="center"><strong>общ брой</strong></div></td>
		    <td><div align="center"><strong>мъже</strong></div></td>
		    <td><div align="center"><strong>жени</strong></div></td>
		    <td><div align="center"><strong>до 25</strong></div></td>
		    <td><div align="center"><strong>25-35</strong></div></td>
		    <td><div align="center"><strong>36-45</strong></div></td>
		    <td><div align="center"><strong>46-55</strong></div></td>
		    <td><div align="center"><strong>над 55</strong></div></td>
		    <td><div align="center"><strong>до 5</strong></div></td>
		    <td><div align="center"><strong>5-10</strong></div></td>
		    <td><div align="center"><strong>над 10</strong></div></td>
		    <td><div align="center"><strong>до 3</strong></div></td>
		    <td><div align="center"><strong>3-10</strong></div></td>
		    <td><div align="center"><strong>над 10</strong></div></td>
		    <td><div align="center"><strong>1ва</strong></div></td>
		    <td><div align="center"><strong>2ра</strong></div></td>
		    <td><div align="center"><strong>3та</strong></div></td>
		    <td><div align="center"><strong>4та</strong></div></td>
		    <td><div align="center"><strong>5та</strong></div></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		$converter = new ConvertRoman($key);
		    		echo '<td><div align="center"><strong>'.$converter->result().'</strong></div></td>';
		    	}
		    }
		    ?>
		  </tr>
		  <tr>
		    <td>общ брой</td>
		    <td align="right"><?=$this->avg_workers?></td>
		    <td align="right"><?=$this->avg_men?></td>
		    <td align="right"><?=$this->avg_women?></td>
		    <td align="right"><?=$this->age_25down?></td>
		    <td align="right"><?=$this->age_25_35?></td>
		    <td align="right"><?=$this->age_36_45?></td>
		    <td align="right"><?=$this->age_46_55?></td>
		    <td align="right"><?=$this->age_55up?></td>
		    <td align="right"><?=$this->service_5down?></td>
		    <td align="right"><?=$this->service_5_10?></td>
		    <td align="right"><?=$this->service_10up?></td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right"><?=$this->progroup_1?></td>
		    <td align="right"><?=$this->progroup_2?></td>
		    <td align="right"><?=$this->progroup_3?></td>
		    <td align="right"><?=$this->progroup_4?></td>
		    <td align="right"><?=$this->progroup_5?></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		echo '<td align="right">'.$val.'</td>';
		    	}
		    }
		    ?>
		  </tr>
		  <tr>
		    <td>боледували</td>
		    <td align="right"><?=$this->sick_anual_workers?></td>
		    <td align="right"><?=$this->sick_anual_men?></td>
		    <td align="right"><?=$this->sick_anual_women?></td>
		    <td align="right"><?=$this->sick_age_25down?></td>
		    <td align="right"><?=$this->sick_age_25_35?></td>
		    <td align="right"><?=$this->sick_age_36_45?></td>
		    <td align="right"><?=$this->sick_age_46_55?></td>
		    <td align="right"><?=$this->sick_age_55up?></td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right"><?=$this->sick_progroup_1?></td>
		    <td align="right"><?=$this->sick_progroup_2?></td>
		    <td align="right"><?=$this->sick_progroup_3?></td>
		    <td align="right"><?=$this->sick_progroup_4?></td>
		    <td align="right"><?=$this->sick_progroup_5?></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		$val = (isset($this->sick_progroups[$key])) ? $this->sick_progroups[$key] : 0;
		    		echo '<td align="right">'.$val.'</td>';
		    	}
		    }
		    ?>
		  </tr>
		  <tr>
		    <td>неболедували</td>
		    <td align="right"><?=$this->no_sick_anual_workers?></td>
		    <td align="right"><?=$this->no_sick_anual_men?></td>
		    <td align="right"><?=$this->no_sick_anual_women?></td>
		    <td align="right"><?=$this->no_sick_age_25down?></td>
		    <td align="right"><?=$this->no_sick_age_25_35?></td>
		    <td align="right"><?=$this->no_sick_age_36_45?></td>
		    <td align="right"><?=$this->no_sick_age_46_55?></td>
		    <td align="right"><?=$this->no_sick_age_55up?></td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right"><?=$this->no_sick_progroup_1?></td>
		    <td align="right"><?=$this->no_sick_progroup_2?></td>
		    <td align="right"><?=$this->no_sick_progroup_3?></td>
		    <td align="right"><?=$this->no_sick_progroup_4?></td>
		    <td align="right"><?=$this->no_sick_progroup_5?></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		$val = (isset($this->no_sick_progroups[$key])) ? $this->no_sick_progroups[$key] : 0;
		    		echo '<td align="right">'.$val.'</td>';
		    	}
		    }
		    ?>
		  </tr>
		  <tr>
		    <td>брой първични случаи</td>
		    <td align="right"><?=$this->primary_charts?></td>
		    <td align="right"><?=$this->primary_charts_men?></td>
		    <td align="right"><?=$this->primary_charts_women?></td>
		    <td align="right"><?=$this->primary_charts_age_25down?></td>
		    <td align="right"><?=$this->primary_charts_age_25_35?></td>
		    <td align="right"><?=$this->primary_charts_age_36_45?></td>
		    <td align="right"><?=$this->primary_charts_age_46_55?></td>
		    <td align="right"><?=$this->primary_charts_age_55up?></td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right"><?=$this->primary_charts_progroup_1?></td>
		    <td align="right"><?=$this->primary_charts_progroup_2?></td>
		    <td align="right"><?=$this->primary_charts_progroup_3?></td>
		    <td align="right"><?=$this->primary_charts_progroup_4?></td>
		    <td align="right"><?=$this->primary_charts_progroup_5?></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		$val = (isset($this->primary_charts_progroups[$key])) ? $this->primary_charts_progroups[$key] : 0;
		    		echo '<td align="right">'.$val.'</td>';
		    	}
		    }
		    ?>
		  </tr>
		  <tr>
		    <td>дни трудозагуба</td>
		    <td align="right"><?=$this->days_off?></td>
		    <td align="right"><?=$this->days_off_men?></td>
		    <td align="right"><?=$this->days_off_women?></td>
		    <td align="right"><?=$this->days_off_age_25down?></td>
		    <td align="right"><?=$this->days_off_age_25_35?></td>
		    <td align="right"><?=$this->days_off_age_36_45?></td>
		    <td align="right"><?=$this->days_off_age_46_55?></td>
		    <td align="right"><?=$this->days_off_age_55up?></td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right"><?=$this->days_off_progroup_1?></td>
		    <td align="right"><?=$this->days_off_progroup_2?></td>
		    <td align="right"><?=$this->days_off_progroup_3?></td>
		    <td align="right"><?=$this->days_off_progroup_4?></td>
		    <td align="right"><?=$this->days_off_progroup_5?></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		$val = (isset($this->days_off_progroups[$key])) ? $this->days_off_progroups[$key] : 0;
		    		echo '<td align="right">'.$val.'</td>';
		    	}
		    }
		    ?>
		  </tr>
		  <tr>
		    <td>брой ЧДБ</td>
		    <td align="right"><?=$this->cdb_off?></td>
		    <td align="right"><?=$this->cdb_off_men?></td>
		    <td align="right"><?=$this->cdb_off_women?></td>
		    <td align="right"><?=$this->cdb_off_age_25down?></td>
		    <td align="right"><?=$this->cdb_off_age_25_35?></td>
		    <td align="right"><?=$this->cdb_off_age_36_45?></td>
		    <td align="right"><?=$this->cdb_off_age_46_55?></td>
		    <td align="right"><?=$this->cdb_off_age_55up?></td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right">-</td>
		    <td align="right"><?=$this->cdb_off_progroup_1?></td>
		    <td align="right"><?=$this->cdb_off_progroup_2?></td>
		    <td align="right"><?=$this->cdb_off_progroup_3?></td>
		    <td align="right"><?=$this->cdb_off_progroup_4?></td>
		    <td align="right"><?=$this->cdb_off_progroup_5?></td>
		    <?php
		    if($this->_hasProGroups()) {
		    	foreach ($this->progroups as $key => $val) {
		    		$val = (isset($this->cdb_off_progroups[$key])) ? $this->cdb_off_progroups[$key] : 0;
		    		echo '<td align="right">'.$val.'</td>';
		    	}
		    }
		    ?>
		  </tr>
		</table>
		<hr />
		<table border="1" cellpadding="0" cellspacing="0">
		  <tr align="center" valign="middle">
		    <td><strong>Показатели
		      / признаци</strong></td>
		    <td><strong>Относителен дял на боледувалите лица </strong></td>
		    <td><strong>Честота на случаите </strong></td>
		    <td><strong>Честота на дните </strong></td>
		    <td><strong>Средна продължителност на един случай </strong></td>
		    <td><strong>Относителен дял на ЧДБЛ в % </strong></td>
		    <td><strong>Случаи на едно боледувало лице </strong></td>
		    <td><strong>Дни на едно боледувало лице </strong></td>
		  </tr>
		  <tr>
		    <td valign="top"><p> общ брой</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_anual_workers?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker?></p></td>
		  </tr>		  
		  <tr>
		    <td valign="top"><p> мъже</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_anual_men?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_men?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_men?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_men?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_men?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_men?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_men?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p> жени</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_anual_women?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_women?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_women?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_women?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_women?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_women?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_women?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p><strong>Възрастови групи:</strong></p></td>
		    <td valign="top" colspan="8"><p align="right">&nbsp;</p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>до 25 години</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_age_25down?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_age_25down?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_age_25down?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_age_25down?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_age_25down?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_age_25down?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_25down?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>25 – 35 години</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_age_25_35?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_age_25_35?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_age_25_35?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_age_25_35?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_age_25_35?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_age_25_35?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_25_35?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>36 – 45 години</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_age_36_45?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_age_36_45?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_age_36_45?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_age_36_45?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_age_36_45?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_age_36_45?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_36_45?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>46 – 55 години</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_age_46_55?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_age_46_55?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_age_46_55?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_age_46_55?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_age_46_55?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_age_46_55?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_46_55?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>над 55 години</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_age_55up?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_age_55up?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_age_55up?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_age_55up?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_age_55up?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_age_55up?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_55up?></p></td>
		  </tr>
		  <?php if($this->_hasProGroups()) { ?>
		  <tr>
		    <td valign="top"><p><strong>Професионални групи:</strong></p></td>
		    <td valign="top" colspan="8"><p align="right">&nbsp;</p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>І – ва група</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_progroup_1?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_progroup_1?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_progroup_1?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_progroup_1?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_progroup_1?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_progroup_1?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_progroup_1?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>ІІ – ра група</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_progroup_2?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_progroup_2?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_progroup_2?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_progroup_2?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_progroup_2?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_progroup_2?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_progroup_2?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>ІІІ – та група</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_progroup_3?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_progroup_3?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_progroup_3?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_progroup_3?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_progroup_3?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_progroup_3?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_progroup_3?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>ІV – та група</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_progroup_4?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_progroup_4?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_progroup_4?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_progroup_4?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_progroup_4?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_progroup_4?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_progroup_4?></p></td>
		  </tr>
		  <tr>
		    <td valign="top"><p>V – та група</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_progroup_5?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_progroup_5?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_progroup_5?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_progroup_5?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_progroup_5?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_progroup_5?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_progroup_5?></p></td>
		  </tr>
		  <tr>
		    <td valign="top" colspan="8">&nbsp;</td>
		  </tr>
		  <?php foreach ($this->progroups as $key => $val) { ?>
		  <tr>
		    <td valign="top"><p><?php $converter = new ConvertRoman($key); echo $converter->result(); ?> група</p></td>
		    <td valign="top"><p align="right"><?=$this->rel_sick_progroups[$key]?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_primary_charts_progroups[$key]?></p></td>
		    <td valign="top"><p align="right"><?=$this->freq_days_off_progroups[$key]?></p></td>
		    <td valign="top"><p align="right"><?=$this->avg_length_of_chart_progroups[$key]?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_cdb_off_progroups[$key]?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_charts_per_worker_progroups[$key]?></p></td>
		    <td valign="top"><p align="right"><?=$this->rel_days_off_per_worker_progroups[$key]?></p></td>
		  </tr>
		  <?php } ?>
		  <?php } ?>
		</table>
		<?php
		return ob_get_clean();
	}

	public function getBasicTable() {
		ob_start();
		?>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="111%"
 style='width:111.62%;border-collapse:collapse;border:none'>
    <tr>
      <td width="18%" rowspan=2 style='width:18.52%;border:solid windowtext 1.0pt;
  background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>&nbsp;</span></p></td>
      <td width="20%" colspan=3 style='width:20.86%;border:solid windowtext 1.0pt;
  border-left:none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>средно списъчен състав</span></p></td>
      <td width="34%" colspan=5 style='width:34.68%;border:solid windowtext 1.0pt;
  border-left:none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>възрастови групи</span></p></td>
      <td width="25%" colspan=5 style='width:25.92%;border:solid windowtext 1.0pt;
  border-left:none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>основни професионални групи</span></p></td>
    </tr>
    <tr>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>общ брой</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>мъже</span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>жени</span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>до 25</span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>25-35</span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>36-45</span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>46-55</span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>над 55</span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>1ва</span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>2ра</span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>3та</span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;background:#CCFFCC;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>4та</span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>5та</span></p></td>
    </tr>
    <tr>
      <td width="18%" style='width:18.52%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>общ брой</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_workers?></span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_men?></span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_women?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->age_25down?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->age_25_35?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->age_36_45?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->age_46_55?></span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->age_55up?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->progroup_1?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->progroup_2?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->progroup_3?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->progroup_4?></span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->progroup_5?></span></p></td>
    </tr>
    <tr>
      <td width="18%" style='width:18.52%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>боледували</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_anual_workers?></span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_anual_men?></span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_anual_women?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_age_25down?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_age_25_35?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_age_36_45?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_age_46_55?></span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_age_55up?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_progroup_1?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_progroup_2?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_progroup_3?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_progroup_4?></span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->sick_progroup_5?></span></p></td>
    </tr>
    <tr>
      <td width="18%" style='width:18.52%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>неболедували</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_anual_workers?></span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_anual_men?></span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_anual_women?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_age_25down?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_age_25_35?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_age_36_45?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_age_46_55?></span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_age_55up?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_progroup_1?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_progroup_2?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_progroup_3?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_progroup_4?></span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->no_sick_progroup_5?></span></p></td>
    </tr>
    <tr>
      <td width="18%" style='width:18.52%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>брой първични случаи</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts?></span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_men?></span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_women?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_age_25down?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_age_25_35?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_age_36_45?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_age_46_55?></span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_age_55up?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_progroup_1?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_progroup_2?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_progroup_3?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_progroup_4?></span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->primary_charts_progroup_5?></span></p></td>
    </tr>
    <tr>
      <td width="18%" style='width:18.52%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>дни трудозагуба</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off?></span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_men?></span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_women?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_age_25down?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_age_25_35?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_age_36_45?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_age_46_55?></span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_age_55up?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_progroup_1?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_progroup_2?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_progroup_3?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_progroup_4?></span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->days_off_progroup_5?></span></p></td>
    </tr>
    <tr>
      <td width="18%" style='width:18.52%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>брой ЧДБ</span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off?></span></p></td>
      <td width="6%" style='width:6.94%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_men?></span></p></td>
      <td width="6%" style='width:6.98%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_women?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_age_25down?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_age_25_35?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_age_36_45?></span></p></td>
      <td width="6%" style='width:6.6%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_age_46_55?></span></p></td>
      <td width="8%" style='width:8.3%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_age_55up?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_progroup_1?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_progroup_2?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_progroup_3?></span></p></td>
      <td width="5%" style='width:5.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_progroup_4?></span></p></td>
      <td width="5%" style='width:5.12%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->cdb_off_progroup_5?></span></p></td>
    </tr>
  </table>
		<?php
		return ob_get_clean();
	}

	public function getAnaliticsTable() {
		ob_start();
		?>
  <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="111%"
 style='width:111.8%;border-collapse:collapse;border:none'>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;background:
  #CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Показатели / признаци</span></p></td>
      <td width="13%" style='width:13.24%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Относителен дял на боледувалите лица</span></p></td>
      <td width="9%" style='width:9.42%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><strong><span
  style='font-size:10.0pt;font-weight:normal'>Честота на случаите</span></strong></p></td>
      <td width="8%" style='width:8.56%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Честота на дните</span></p></td>
      <td width="16%" style='width:16.68%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Средна продължителност на един случай</span></p></td>
      <td width="12%" style='width:12.74%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Относителен дял на ЧДБЛ в %</span></p></td>
      <td width="11%" style='width:11.48%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Случаи на едно боледувало лице</span></p></td>
      <td width="11%" style='width:11.48%;border:solid windowtext 1.0pt;border-left:
  none;background:#CCFFCC;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:10.0pt'>Дни на едно боледувало лице</span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>общ брой</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_anual_workers?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker?></span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>мъже</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_anual_men?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_men?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_men?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_men?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_men?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_men?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_men?></span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>жени</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_anual_women?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_women?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_women?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_women?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_women?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_women?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_women?></span></p></td>
    </tr>
    <tr>
      <td width="100%" colspan=8 style='width:100.0%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:10.0pt'>Възрастови групи</span></b></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>до 25 години</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_age_25down?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_age_25down?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_age_25down?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_age_25down?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_age_25down?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_age_25down?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_25down?></span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>25 – 35 години</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_age_25_35?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_age_25_35?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_age_25_35?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_age_25_35?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_age_25_35?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_age_25_35?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_25_35?></span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>36 – 45 години</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_age_36_45?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_age_36_45?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_age_36_45?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_age_36_45?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_age_36_45?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_age_36_45?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_36_45?></span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>46 – 55 години</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_age_46_55?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_age_46_55?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_age_46_55?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_age_46_55?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_age_46_55?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_age_46_55?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_46_55?></span></p></td>
    </tr>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'>над 55 години</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_age_55up?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_age_55up?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_age_55up?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_age_55up?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_age_55up?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_age_55up?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_55up?></span></p></td>
    </tr>
    <?php if($this->_hasProGroups()) { ?>
    <tr>
      <td width="100%" colspan=8 style='width:100.0%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:10.0pt'>Професионални групи</span></b></p></td>
    </tr>
    <?php foreach ($this->progroups as $key => $val) { ?>
    <tr>
      <td width="16%" style='width:16.4%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal><span style='font-size:10.0pt'><?php $converter = new ConvertRoman($key); echo $converter->result(); ?> група</span></p></td>
      <td width="13%" style='width:13.24%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_sick_progroups[$key]?></span></p></td>
      <td width="9%" style='width:9.42%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_primary_charts_progroups[$key]?></span></p></td>
      <td width="8%" style='width:8.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->freq_days_off_progroups[$key]?></span></p></td>
      <td width="16%" style='width:16.68%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->avg_length_of_chart_progroups[$key]?></span></p></td>
      <td width="12%" style='width:12.74%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_cdb_off_progroups[$key]?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_charts_per_worker_progroups[$key]?></span></p></td>
      <td width="11%" style='width:11.48%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:10.0pt'><?=$this->rel_days_off_per_worker_progroups[$key]?></span></p></td>
    </tr>
    <?php } ?>
    <?php } ?>
  </table>
  	  <?php
  	  if($this->_hasProGroups()) {
  	  	echo '<p class=MsoNormal><u>Легенда:</u></p>';
  	  	$sql = "SELECT g.num AS num , g.name AS progroup_name
				FROM firm_positions p
				LEFT JOIN pro_groups g ON ( g.id = p.progroup )
				WHERE p.firm_id = $this->firm_id 
				AND p.progroup != 0
				GROUP BY g.num
				ORDER BY g.num";
  	  	$rows = $this->query($sql);
  	  	if(!empty($rows)) {
  	  		foreach ($rows as $row) {
  	  			$converter = new ConvertRoman($row['num']);
  	  			$num = $converter->result();
  	  			echo '<p class=MsoNormal><span style=\'font-size:10.0pt\'>'.$num.' група: '.HTMLFormat($row['progroup_name']).'</span></p>';
  	  		}
  	  	}
  	  }
  	  
  	  return ob_get_clean();
	}

	public function freqSickWorkersTempDisability() {
		if(empty($this->rel_sick_anual_workers)) {
			return "<b style='mso-bidi-font-weight:normal'>Няма предоставени данни</b>";
		}
		$str = '';
		$freq = $this->rel_sick_anual_workers;
		if($freq < 45) {
			$str .= 'ниска';
		} elseif ($freq >= 45 && $freq <= 55) {
			$str .= 'средна';
		} else {
			$str .= 'висока';
		}
		return "<b style='mso-bidi-font-weight:normal'>$freq</b> ($str)";
	}
	
	public function freqCasesTempDisability() {
		if(empty($this->freq_primary_charts)) {
			return "<b style='mso-bidi-font-weight:normal'>Няма предоставени данни</b>";
		}
		$str = '';
		$freq = $this->freq_primary_charts;
		if($freq < 60) {
			$str .= 'много ниска';
		} elseif ($freq >= 60 && $freq < 80) {
			$str .= 'ниска';
		} elseif ($freq >= 80 && $freq < 100) {
			$str .= 'средна';
		} elseif ($freq >= 100 && $freq < 120) {
			$str .= 'висока';
		} else {
			$str .= 'много висока';
		}
		return "<b style='mso-bidi-font-weight:normal'>$freq</b> ($str)";
	}
	
	public function freqDaysOffTempDisability() {
		if(empty($this->freq_days_off)) {
			return "<b style='mso-bidi-font-weight:normal'>Няма предоставени данни</b>";
		}
		$str = '';
		$freq = $this->freq_days_off;
		if($freq < 600) {
			$str .= 'много ниска';
		} elseif ($freq >= 600 && $freq < 800) {
			$str .= 'ниска';
		} elseif ($freq >= 800 && $freq < 1000) {
			$str .= 'средна';
		} elseif ($freq >= 1000 && $freq < 1200) {
			$str .= 'висока';
		} else {
			$str .= 'много висока';
		}
		return "<b style='mso-bidi-font-weight:normal'>$freq</b> ($str)";
	}
}

