<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?global $APPLICATION;?>
<?$APPLICATION->SetPageProperty("MENU","N")?>
<?$this->setFrameMode(true);?>

<?
// get section items count and subsections 
$arItemFilter = CResort::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams, false);
$arSubSectionFilter = CResort::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, false);
$itemsCnt = CCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSubSections = CCache::CIBlockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID"));
?>
<?if(!$itemsCnt && !$arSubSections):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	<?// sections?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"front-catalog-sections",
		Array(
			"COUNT_IN_LINE" => "2",
			"SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
			"VIEW_TYPE" => "list",
			"SHOW_TABS" => $arParams["SHOW_TABS"],
			"IMAGE_POSITION" => "left",
			"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
			"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
			"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
			"SORT_BY1"	=>	$arParams["SORT_BY1"],
			"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
			"SORT_BY2"	=>	$arParams["SORT_BY2"],
			"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
			"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
			"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
			"SET_TITLE"	=>	$arParams["SET_TITLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
			"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
			"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
			"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
			"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
			"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
			"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
			"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"INCLUDE_SUBSECTIONS" => "N",
		),
		$component
	);?>
	<div class="root-block">
		<?// section elements?>
		<?//include_once("include_filter.php");?>
		<?
		$frame = new \Bitrix\Main\Page\FrameHelper('catalog-elements-block');
		$frame->begin();
		// $frame->setAnimation(true);
		?>
		<?//include_once("include_sort.php");?>
		<?//$display_template = $display ? 'catalog-'.$display: 'catalog-list';?>
		<?//$display_template = 'catalog-table';?>

		<?if(!$arParams['FILTER_NAME'])
			$arParams['FILTER_NAME'] = 'arFilter';
		$GLOBALS[$arParams['FILTER_NAME']]['SECTION_ID'] = 0;
		?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			'catalog-list',
			array(
				"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
				"S_ORDER_PRODUCT" => $arParams["S_ORDER_PRODUCT"],
				"S_DETAIL_PRODUCT" => $arParams["S_DETAIL_PRODUCT"],
				"T_GALLERY" => $arParams["T_GALLERY"],
				"T_DOCS" => $arParams["T_DOCS"],
				"T_PROJECTS" => $arParams["T_PROJECTS"],
				"T_CHARACTERISTICS" => $arParams["T_CHARACTERISTICS"],
				"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
				"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
				"SORT_BY1"	=>	$arParams['SORT_PROP_DEFAULT'] ? $arParams['SORT_PROP_DEFAULT'] : 'name',
				"SORT_ORDER1"	=>	$arParams['SORT_DIRECTION'] ? $arParams['SORT_DIRECTION'] : 'asc',
				"SORT_BY2"	=>	$arParams["SORT_BY2"],
				"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
				"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
				"SHOW_SLIDE_PROP"	=>	$arParams["SHOW_SLIDE_PROP"],
				"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
				"SET_TITLE"	=>	$arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
				"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
				"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
				"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
				"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
				"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
				"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
				"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
				"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
				"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
				"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
				"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
				"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
				"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
				"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
				"INCLUDE_SUBSECTIONS" => "N",
				"SHOW_DETAIL_LINK" => $arParams["SHOW_DETAIL_LINK"],
				"COUNT_IN_LINE" => "3",
				"DEPTH_LEVEL" => "1",
				"IMAGE_POSITION" => "left",
			),
			$component
		);?>
		<?$frame->end();?>
	</div>
<?// intro text?>
<div class="text_before_items1">
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/catalog.php",
			"EDIT_TEMPLATE" => ""
		)
	);?>
</div>
	<script type="text/javascript">
		$('.container .maxwidth-theme .col-md-3').remove();
		$('.container .maxwidth-theme .content-md').removeClass('col-md-9');
		$('.container .maxwidth-theme .content-md').addClass('col-md-12');
	</script>
<?endif;?>