<?php

//phpinfo();
require_once "Zend/Gdata/Spreadsheets.php";
require_once "Zend/Gdata/ClientLogin.php";

$key = "0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE";
$sheetid = "od6";

$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($_SERVER['ID'], $_SERVER['PASSWORD'], $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

$get = json_encode($_REQUEST);
$insertedListEntry = $spreadsheetService->insertRow(array("message"=>$get), $key, $sheetid);

