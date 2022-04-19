Первым делом проверяем в файле init.php порядок подключения файлов, важно чтобы файл functions.php располагался выше файла constants.php

Это необходимо для того чтобы функция динамического проставления ID инфоблока работала в файле с константами

# CMain.php

```php
use Bitrix\Main\SystemException;
...
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
```

# Использование функции в файле констант:

```php
define("IBLOCK_ID_SKU_CATALOG", getIdIBFromXML_ID('catalog')); // ID инфоблока предложений каталога
````
