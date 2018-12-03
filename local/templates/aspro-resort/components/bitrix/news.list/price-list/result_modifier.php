<?php
foreach ($arResult['ITEMS'] as $item) {
	$arResult['SECTION_ITEMS'][$item['IBLOCK_SECTION_ID']][] = $item['ID'];
}
$list = Bitrix\Iblock\SectionTable::getList(['filter' => ['ID' => array_keys($arResult['SECTION_ITEMS'])]]);
while($row = $list->fetch()){
	$arResult['SECTIONS'][$row['ID']] = $row['NAME'];
}

$items = $arResult['ITEMS'];
$arResult['ITEMS'] = [];
foreach ($items as $item) {
	$arResult['ITEMS'][$item['ID']] = $item;
}