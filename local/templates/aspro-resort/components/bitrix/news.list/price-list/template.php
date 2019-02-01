<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<h2 style="text-align: left">Цены на услуги отеля «Баден Баден» с 01.11.2018 до 31.12.2018</h2>
<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
	<?= $arResult["NAV_STRING"] ?><br/>
<? endif; ?>

<table class="table table-striped" id="top">
	<thead>
		<tr>
			<th>№</th>
			<th>Описание номера</th>
			<th>Цена на 1-го человека, руб./сут.</th>
			<th>Цена на 2-х человек, руб./сут.</th>
			<th>Цена номера руб./сут.</th>
		</tr>
	</thead>
	<tbody>
<? foreach ($arResult["SECTION_ITEMS"] as $key => $section){ ?>
	<tr height="21">
		<td colspan="5" class="title_centerzag big_size_table">
			<h4><?= $arResult['SECTIONS'][$key]?></h4>
		</td>
	</tr>
	<? foreach ($section as $item){?>
		<?
		$this->AddEditAction($item, $arResult['ITEMS'][$item]['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($item, $arResult['ITEMS'][$item]['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<tr id="<?=$this->GetEditAreaId($item);?>">
			<td class="title_center"><?= $arResult['ITEMS'][$item]['PROPERTIES']['NUMBER']['VALUE']?></td>
			<td class="title_left"><?= $arResult['ITEMS'][$item]['NAME']?></td>
			<td class="title_center"><?= $arResult['ITEMS'][$item]['PROPERTIES']['PRICE1']['VALUE']?></td>
			<td class="title_center"><?= $arResult['ITEMS'][$item]['PROPERTIES']['PRICE2']['VALUE']?></td>
			<td class="title_center"><?= $arResult['ITEMS'][$item]['PROPERTIES']['PRICE3']['VALUE']?></td>
		</tr>
	<? } ?>
<? } ?>
	</tbody>
</table>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<br/><?= $arResult["NAV_STRING"] ?>
<? endif; ?>
