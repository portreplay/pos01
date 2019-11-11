<?php
	include '../init.php';
	
	$pagenum = $_GET['pagenum'];
	$pagesize = $_GET['pagesize'];
	$start = $pagenum * $pagesize;
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM tbl_penjualan_header  LIMIT $start, $pagesize";
	// filter data.
	if (isset($_GET['filterscount']))
	{
		$filterscount = $_GET['filterscount'];
		
		if ($filterscount > 0)
		{
			$where = " WHERE (";
			$tmpdatafield = "";
			$tmpfilteroperator = "";
			for ($i=0; $i < $filterscount; $i++)
		    {
				// get the filter's value.
				$filtervalue = $_GET["filtervalue" . $i];
				// get the filter's condition.
				$filtercondition = $_GET["filtercondition" . $i];
				// get the filter's column.
				$filterdatafield = $_GET["filterdatafield" . $i];
				// get the filter's operator.
				$filteroperator = $_GET["filteroperator" . $i];
				
				if ($tmpdatafield == "")
				{
					$tmpdatafield = $filterdatafield;			
				}
				else if ($tmpdatafield <> $filterdatafield)
				{
					$where .= ")AND(";
				}
				else if ($tmpdatafield == $filterdatafield)
				{
					if ($tmpfilteroperator == 0)
					{
						$where .= " AND ";
					}
					else $where .= " OR ";	
				}
				
				// build the "WHERE" clause depending on the filter's condition, value and datafield.
				switch($filtercondition)
				{
					case "CONTAINS":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
						break;
					case "DOES_NOT_CONTAIN":
						$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
						break;
					case "EQUAL":
						$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
						break;
					case "NOT_EQUAL":
						$where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
						break;
					case "GREATER_THAN":
						$where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
						break;
					case "LESS_THAN":
						$where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
						break;
					case "GREATER_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
						break;
					case "LESS_THAN_OR_EQUAL":
						$where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
						break;
					case "STARTS_WITH":
						$where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
						break;
					case "ENDS_WITH":
						$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
						break;
				}
								
				if ($i == $filterscount - 1)
				{
					$where .= ")";
				}
				
				$tmpfilteroperator = $filteroperator;
				$tmpdatafield = $filterdatafield;			
			}
			// build the query.
			$result = $mysqli->query($query);
			$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
			$rows = $mysqli->query($sql);
			$rows = $rows->fetch_assoc();
			$total_rows = $rows['found_rows'];
		
			$query = "SELECT * FROM tbl_penjualan_header ".$where."  LIMIT $start, $total_rows";			
		}
	}
	// sort data.
	if (isset($_GET['sortdatafield']))
	{
		$sortfield = $_GET['sortdatafield'];
		$sortorder = $_GET['sortorder'];
		
		if ($sortfield != NULL)
		{
			if ($sortorder == "desc")
			{
				$query = "SELECT * FROM tbl_penjualan_header  ORDER BY" . " " . $sortfield . " DESC";
			}
			else if ($sortorder == "asc")
			{
				$query = "SELECT * FROM tbl_penjualan_header  ORDER BY" . " " . $sortfield . " ASC";
			}			
		}
	}
	
	$result = $mysqli->query($query);
	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
	$rows = $mysqli->query($sql);
	$rows = $rows->fetch_assoc();
	$total_rows = $rows['found_rows'];
	$data_penjualan = null;
	// get data and store in a json array
	while ($row = $result->fetch_array()) {
		$get_item = $mysqli->query("SELECT COUNT(kd_penjualan) as total_item FROM tbl_penjualan_detail WHERE kd_penjualan='".$row['kd_penjualan']."'");
		$data_item = $get_item->fetch_array();
		$data_penjualan[] = array(
			'kd_penjualan' => $row['kd_penjualan'],
			'kd_pelanggan' => $row['kd_pelanggan'],
			'total_harga' => rupiah($row['total_harga']),
			'tanggal_penjualan' =>$row['tanggal_penjualan'],
			'kd_pegawai' => $row['kd_pegawai'],
			'total_item' => $data_item['total_item'].' items'
		  );
	}
      $data[] = array(
       'TotalRows' => $total_rows,
	   'Rows' => $data_penjualan
	);
	echo json_encode($data);
?>