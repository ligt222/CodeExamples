<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$GLOBALS['RESULT'] = $arResult['RESULT'];

if ($arResult['OG_IMAGE'])
    $APPLICATION->AddViewContent('og_image', $arResult['OG_IMAGE']);

