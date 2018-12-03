<?php
if (file_exists(__DIR__."/include/constants.php"))
	include (__DIR__ . "/include/constants.php");

if (file_exists(__DIR__."/include/functions.php"))
	include (__DIR__ . "/include/functions.php");


if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php")) {
	include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");
}