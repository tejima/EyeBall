<?php

require_once "Gdata/Spreadsheets.php";
require_once "Gdata/ClientLogin.php";

$key = "0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE";
$sheetid = "0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE";
$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($_ENV['ID'], $_ENV['PASSWORD'], $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

$insertedListEntry = $spreadsheetService->insertRow(array("message"=>"hook"), $key, $sheetid);

