// Функция определения ид ИБ от его симв.кода
function getIdIBFromXML_ID($xmlID) {
	Loader::includeModule("iblock");
	$idIB = '';
	if ($xmlID) {
		// Запрос для получения ид
		$getIdIB = \Bitrix\Iblock\IblockTable::getList(array(
			'select' => array('ID', 'CODE'),
			'filter' => array('CODE' => $xmlID),
			'cache' => array(
			'ttl' => 60,
			'cache_joins' => true,
		)
		))->fetch();
		if ($getIdIB['ID']) {
		  $idIB = $getIdIB['ID'];
		}
	}
	// Обработка ошибок
	if (!$xmlID) {
		try
		{
		    throw new SystemException("Не заполнен символьный код инфоблока");
		}
		catch (SystemException $exception)
		{
		    echo $exception->getMessage();
		    die();
		}
	}
	if (!$idIB) {
		try
		{
		    throw new SystemException($xmlID." Неверный символьный код инфоблока");
		}
		catch (SystemException $exception)
		{
		    echo $exception->getMessage();
		    die();
		}
	}

	return $idIB;
}
