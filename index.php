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

$query->setSpreadsheetQuery("NAVI=ACTIVE and TIME <= now()");

$listFeed = $spreadsheetService->getListFeed($query);

$rowData = $listFeed->entries[1]->getCustom();

foreach($rowData as $column){
  echo $column->getColumnName() . " = " . $column->getText() . "\n";
}

echo "DONE";
