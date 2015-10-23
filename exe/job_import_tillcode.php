<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('Asia/Jakarta');

include_once('db.conf.php');

echo "start job at ", date("Y-m-d H:i:s"), EOL;

/** Include PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

$inputFileName = $tillcodePath . '/tillcode.xlsx';

echo "checking excel file.. ";
if (file_exists($inputFileName)) {
	echo "exist.", EOL;
	echo "reading..", EOL;
	
	/**  Identify the type of $inputFileName  **/
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	
	/** Create a new Reader of the type that has been identified **/
	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	
	/** Advise the Reader that we only want to load cell data **/
	//When setting read data only to true, PHPExcel doesn't read the cell format masks, so it is not possible to differentiate between dates/times and numbers.
	//$objReader->setReadDataOnly(true);
	
	/** Load $inputFileName to a PHPExcel Object **/
	$objPHPExcel = $objReader->load($inputFileName);
	
	$objWorksheet = $objPHPExcel->getActiveSheet();
	
	$highestRow = $objWorksheet->getHighestRow(); // e.g. 10
	$highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
	
	echo "make connection to database.. ";
			
	// make connection
	$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$pass");
	if (!$conn) {
		die ("Error: Could not establish a connection!");
	}
	echo "connected.", EOL;
	# eo make connection
	
	echo "start transaction.. ", EOL;
	# start transaction
	$res = pg_query($conn, "BEGIN");
	
	echo "start loop.", EOL;
	
	$lineNumber = 2; // start at 3
	$totalInsertedRow = 0;
			
	for ($row = 3; $row <= $highestRow; ++$row) {
		
		$lineNumber++;
		
		$tillcode = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
		$tillcodeDesc = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
		$catCode = $objWorksheet->getCellByColumnAndRow(7, $row)->getValue();
		$divCode = substr($catCode, 0, 1);
		$isActive = 1;
		$articleCode = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
		$articleCode = str_pad($articleCode, 13, "0", STR_PAD_LEFT);
		$articleType = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
		$suppCode = $objWorksheet->getCellByColumnAndRow(9, $row)->getValue();
		$brandDesc = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
		$margin = $objWorksheet->getCellByColumnAndRow(11, $row)->getValue();
		$margin = (is_numeric($margin) ? $margin : 0);
		$isPkp = $objWorksheet->getCellByColumnAndRow(12, $row)->getValue();
		$isPkp = ($isPkp == "PKP" ? 1 : 0);
		
		# check exist
		$aParams = array($tillcode);
		$sql = "select count(tillcode) cnt from mst_tillcode where tillcode = $1";
		$res2 = pg_query_params($conn, $sql, $aParams);
		$cnt = 0;
		if ($row2 = pg_fetch_array($res2)) {
			$cnt = $row2["cnt"];
		}
		
		# exist, update
		if ($cnt) {
			/*
			$aParams = array($tillcode, $tillcodeDesc, $divCode, $isActive, $articleCode, $catCode, $articleType, $suppCode, $brandDesc, $margin, $isPkp);
		
			# -- UPDATE TILLCODE --
			$sql =  "update mst_tillcode set disc_label = $2, division_code = $3, is_active = $4, article_code = $5, cat_code = $6, article_type = $7, " .
					"supp_code = $8, brand_desc = $9, margin = $10, is_pkp = $11 where tillcode = $1";
			$res = pg_query_params($conn, $sql, $aParams);
			if (!$res) {
				echo "failed at row ", $lineNumber, ", data: tillcode, disc_label, division_code, is_active, article_code, cat_code, article_type, supp_code, brand_desc, margin, is_pkp => ";
				echo $tillcode, ", ", $tillcodeDesc, ", ", $divCode, ", ", $isActive, ", ", $articleCode, ", ", $catCode, ", ", $articleType, ", ", $suppCode, ", ", $brandDesc, ", ", $margin, ", ", $isPkp, EOL;
				continue;
			}
			else {
				$totalInsertedRow++;
			}
			*/
		}
		# insert
		else {
			$aParams = array($tillcode, $tillcodeDesc, $divCode, $isActive, $articleCode, $catCode, $articleType, $suppCode, $brandDesc, $margin, $isPkp);
		
			# -- INSERT TILLCODE --
			$sql =  "insert into mst_tillcode (" .
						"tillcode, disc_label, division_code, is_active, created_date, article_code, cat_code, article_type, supp_code, brand_desc, margin, is_pkp" .
					") values ($1, $2, $3, $4, current_timestamp, $5, $6, $7, $8, $9, $10, $11)";
			
			$res = pg_query_params($conn, $sql, $aParams);
			if (!$res) {
				echo "failed at row ", $lineNumber, ", data: tillcode, disc_label, division_code, is_active, article_code, cat_code, article_type, supp_code, brand_desc, margin, is_pkp => ";
				echo $tillcode, ", ", $tillcodeDesc, ", ", $divCode, ", ", $isActive, ", ", $articleCode, ", ", $catCode, ", ", $articleType, ", ", $suppCode, ", ", $brandDesc, ", ", $margin, ", ", $isPkp, EOL;
				continue;
			}
			else {
				$totalInsertedRow++;
			}
		}
		
	}
	
	echo "end loop.", EOL;
	echo $totalInsertedRow . " rows inserted / updated.", EOL;
	
	echo "commit transaction.. ", EOL;
	# commit transaction
	$res = pg_query($conn, "COMMIT");
	
	echo "close connection.", EOL;			
	# php document said no need this call 
	pg_close($conn);
	
	echo "finished reading.", EOL;
}
else {
	echo "File does not exist." . EOL;
}

echo "job done.. leave job.", EOL;
echo "finished job at ", date("Y-m-d H:i:s"), EOL, EOL;

?>