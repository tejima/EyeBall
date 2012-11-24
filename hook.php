<?php

//phpinfo();
require_once "Zend/Gdata/Spreadsheets.php";
require_once "Zend/Gdata/ClientLogin.php";

$key = "0Ao32NvF7NnotdHJlZWFDX2NyZVVQZEZLcWdqR2I4NUE";
$sheetid = "od6";

$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($_SERVER['ID'], $_SERVER['PASSWORD'], $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);

$data = json_decode($_REQUEST);

$target = $_REQUEST['target'] ? $_REQUEST['target'] : "none";
$message = "a";
switch($target){
	case "github":
		$project_name = $data["payload"]["repository"]["name"];
		$owner_name = $data["payload"]["repository"]["owner"]["name"];
		$message = "$project_name に $owner_name さんがコミットしました。";
	case "travis":
		$project_name = $data["payload"]["repository"]["name"];
		$owner_name = $data["payload"]["repository"]["owner"]["name"];
		$message = "$project_name に $owner_name さんのテスト";
}
$insertedListEntry = $spreadsheetService->insertRow(array("target"=>$target ,"theme"=>"success","body" => $message, "debug"=>$_REQUEST), $key, $sheetid);

