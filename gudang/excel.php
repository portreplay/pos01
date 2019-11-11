<?php 
	include 'core/init.php';
	if(sudah_login()===true and cek_gudang_access()===true or is_admin($_SESSION['kd_pegawai'])===true) {

	    if(isset($_GET['c']) and !empty($_GET['c']) and $_GET['c'] == 1) {

	    		$creator = get_nama($_SESSION['kd_pegawai']);
	    		
				error_reporting(E_ALL);
				ini_set('display_errors', TRUE);
				ini_set('display_startup_errors', TRUE);
				date_default_timezone_set('Asia/Jakarta');

				if (PHP_SAPI == 'cli')
					die('This example should only be run from a Web Browser');

				/** Include PHPExcel */
				require_once '../vendor/phpexcel/PHPExcel.php';


				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator('$creator')
											 ->setLastModifiedBy('$creator')
											 ->setTitle("Port Replay - Data Barang (".date('yyyy-mm-dd').")")
											 ->setSubject("Export Data Barang")
											 ->setDescription("Dokumen Excel Data Barang Port Replay")
											 ->setKeywords("data barang")
											 ->setCategory("barang");


				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A1', 'No')
				            ->setCellValue('B1', 'Kode Barang')
				            ->setCellValue('C1', 'Nama Barang')
				            ->setCellValue('D1', 'Stok')
				            ->setCellValue('E1', 'Harga Beli')
				            ->setCellValue('F1', 'Harga');

				$get_barang = $mysqli->query("SELECT * FROM tbl_barang");
				$no = 1;
				while($data_barang = $get_barang->fetch_array()) {    
					$no++;

					$objPHPExcel->setActiveSheetIndex(0)
					            ->setCellValue('A'.$no, ''.($no-1).'')
					            ->setCellValue('B'.$no, ''.$data_barang['kd_barang'].'')
					            ->setCellValue('C'.$no, ''.$data_barang['nm_barang'].'')
					            ->setCellValue('D'.$no, ''.$data_barang['stok'].'')
					            ->setCellValue('E'.$no, ''.$data_barang['harga_beli'].'')
					            ->setCellValue('F'.$no, ''.$data_barang['harga'].'');

				}

		
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Port Replay - Data Barang ('.date("yyyy-mm-dd").')".xls');
				header('Cache-Control: max-age=0');
				header('Cache-Control: max-age=1');
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
				header ('Cache-Control: cache, must-revalidate');
				header ('Pragma: public');
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
				exit;

	    }else {
	    	alihkan('index.php');
	    }
	}else {
		alihkan('index.php');
	}
?>