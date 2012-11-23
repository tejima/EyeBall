<?php

require_once "Zend/Gdata/Spreadsheets.php";
require_once "Zend/Gdata/ClientLogin.php";

$sheetkey = "0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE";
$sheetid = "od6";
$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($_SERVER['ID'], $_SERVER['PASSWORD'], $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

$query = new Zend_Gdata_Spreadsheets_ListQuery();
$query->setSpreadSheetKey($sheetkey);
$query->setWorksheetId($sheetid);

$query->setSpreadsheetQuery($_ENV["QUERY"]);
$listFeed = $spreadsheetService->getListFeed($query);
$rowData = $listFeed->entries[0]->getCustom();

$result = array();

$data = $listFeed->entries[0]->getCustomByName("message");


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


/*
foreach($rowData as $column){
  if($column->getColumnName() == "message"){
    $result["message"] = $column->getText();
	$result["status"] = "success";
	echo json_encode($result);
	$spreadsheetService->deleteRow($listFeed->entries[0]);
	break;
  }
}
*/

