<?php
	include '../init.php';
	if(isset($_GET['following']) and !empty($_GET['following'])) {
		$following = $_GET['following'];
		$pagenum = $_GET['pagenum'];
		$pagesize = $_GET['pagesize'];
		$start = $pagenum * $pagesize;
		$field_display = 'tbl_stok_toko.id_stok_barang, tbl_stok_toko.kd_barang, tbl_stok_toko.stok, tbl_stok_toko.kd_pelanggan, tbl_stok_toko.harga, tbl_stok_toko.biaya_expedisi, tbl_barang.nm_barang';
		$query = "SELECT SQL_CALC_FOUND_ROWS $field_display  FROM tbl_stok_toko INNER JOIN tbl_barang ON tbl_barang.kd_barang=tbl_stok_toko.kd_barang WHERE kd_pelanggan=$following LIMIT $start, $pagesize";
		// filter data.
		if (isset($_GET['filterscount']))
		{
			$filterscount = $_GET['filterscount'];
			
			if ($filterscount > 0)
			{
				$where = " WHERE kd_pelanggan=$following AND (";
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
			
				$query = "SELECT $field_display FROM tbl_stok_toko INNER JOIN tbl_barang ON tbl_barang.kd_barang=tbl_stok_toko.kd_barang ".$where." LIMIT $start, $total_rows";			
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
					$query = "SELECT $field_display FROM tbl_stok_toko INNER JOIN tbl_barang ON tbl_barang.kd_barang=tbl_stok_toko.kd_barang WHERE kd_pelanggan=$following ORDER BY" . " " . $sortfield . " DESC";
				}
				else if ($sortorder == "asc")
				{
					$query = "SELECT $field_display FROM tbl_stok_toko INNER JOIN tbl_barang ON tbl_barang.kd_barang=tbl_stok_toko.kd_barang WHERE kd_pelanggan=$following ORDER BY" . " " . $sortfield . " ASC";
				}			
			}
		}
		$result = $mysqli->query($query);
		$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
		$rows = $mysqli->query($sql);
		$rows = $rows->fetch_assoc();
		$total_rows = $rows['found_rows'];
		$data_toko = null;
		// get data and store in a json array
		while ($row = $result->fetch_array()) {
			$data_toko[] = array(
				'id_stok_barang' => $row['id_stok_barang'],
				'nm_barang' => $row['nm_barang'],
				'kd_pelanggan' => $row['kd_pelanggan'],
				'kd_barang' => $row['kd_barang'],
				'stok' =>$row['stok'],
				'harga' =>$row['harga'],
				'total_harga' =>rupiah($row['harga']*$row['stok']),
				'biaya_expedisi' => $row['biaya_expedisi']
			  );
		}
	      $data[] = array(
	       'TotalRows' => $total_rows,
		   'Rows' => $data_toko
		);
		echo json_encode($data);
	}
?>