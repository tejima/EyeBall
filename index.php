<?php

require_once "Gdata/Spreadsheets.php";
require_once "Gdata/ClientLogin.php";

$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($_ENV['ID'], $_ENV['PASSWORD'], $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

$query = new Zend_Gdata_Spreadsheets_ListQuery();
$query->setSpreadSheetKey("0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE");
$query->setWorksheetId(0);

$listFeed = $spreadsheetService->getListFeed($query);

$rowData = $listFeed->entries[1]->getCustom();

foreach($rowData as $column){
  echo $column->getColumnName() . " = " . $column->getText() . "\n";
}

echo "DONE";
