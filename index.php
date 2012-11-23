<?php

require_once "Zend/Gdata/Spreadsheets.php";
require_once "Zend/Gdata/ClientLogin.php";

$sheetkey = "0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE";
$sheetid = "od6";
$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
header("Access-Control-Allow-Origin: *");

try{


	$id = $_SERVER['ID'] ? $_SERVER['ID'] : $_ENV['ID'];
	$password = $_SERVER['PASSWORD'] ? $_SERVER['PASSWORD'] : $_ENV['ID'];
//	$query_string = $_SERVER['QUERY'] ? $_SERVER['QUERY'] : $_SERVER['QUERY'];
	$client = Zend_Gdata_ClientLogin::getHttpClient($id , $password, $service);
	$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

	$query_string = "";
	$query = new Zend_Gdata_Spreadsheets_ListQuery();
	$query->setSpreadSheetKey($sheetkey);
	$query->setWorksheetId($sheetid);
	$query->setSpreadsheetQuery($query_string);
	$listFeed = $spreadsheetService->getListFeed($query);

	$result = array();
	foreach ($listFeed->entries as $line) {
	  $status = $line->getCustomByName("status");
	  if($status == DONE){
	  	//skip
	  	continue;
	  }
	  $result["message"] = (string)$line->getCustomByName("message");
	  $result["theme"] = (string)$line->getCustomByName("theme");
	  $result["status"] = "success";

	  echo json_encode($result);
	  //$newline = $line->getCustom();
	  $newline["status"] = "DONE";
	  //$spreadsheetService->deleteRow($listFeed->entries[0]);
	  $spreadsheetService->updateRow($line,$newline);
	  exit();
	}
	$result["status"] = "none";
	echo json_encode($result);

}catch(Exception $e){
	echo $e->getMessage();
}
