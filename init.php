if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/CMain.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/CMain.php");
}

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php");
}
