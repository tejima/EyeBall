<?php

require_once "Gdata/Spreadsheets.php";
require_once "Gdata/ClientLogin.php";

$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($_ENV['ID'], $_ENV['PASSWORD'], $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

/*

$query = new Zend_Gdata_Spreadsheets_DocumentQuery();
$query->setSpreadSheetKey("0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE");
$feed = $spreadsheetService->getWorksheetFeed($query);

print_r($feed);
exit;
*/

$query = new Zend_Gdata_Spreadsheets_ListQuery();
$query->setSpreadSheetKey("0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE");
$query->setWorksheetId("od6");

$query->setSpreadsheetQuery($_ENV["QUERY_BETA"]);

$listFeed = $spreadsheetService->getListFeed($query);

$rowData = $listFeed->entries[0]->getCustom();
print_r($rowData);
$result = array();
foreach($rowData as $column){
  if($column->getColumnName() == "message"){
    $result["message"] = $column->getText();
  }
}

$result["status"] = "success";


//$spreadsheetService->updateRow($listFeed->entries[0],array("navi" => "DONE"));
/*
$updatedCell = $spreadsheetService->updateCell($row,
                                               $col,
                                               $inputValue,
                                               $spreadsheetKey,
                                               $worksheetId);
*/













echo json_encode($result);
