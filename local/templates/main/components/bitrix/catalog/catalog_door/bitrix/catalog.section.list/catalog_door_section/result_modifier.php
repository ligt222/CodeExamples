<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arJsonResult = array();
foreach ($arResult['SECTIONS'] as $section) {

    $arJsonResult[] = [
        'link' => $section['SECTION_PAGE_URL'],
        'image' => $section['PICTURE']['SRC'],
        'name' => $section['NAME'],
    ];

}

$arResult['RESULT'] = $arJsonResult;

$this->__component->SetResultCacheKeys(['RESULT']);
