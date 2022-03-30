<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;

$res = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'SECTION_CODE' => $arParams['SECTION_CODE']), false, array(), array());
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arFile = CFile::GetPath($arFields['PREVIEW_PICTURE']);
    $arDetalFile = CFile::GetPath($arFields['DETAIL_PICTURE']);
    $arResult['ITEMS'][$arFields['ID']] = $arFields;
    $arResult['ITEMS'][$arFields['ID']]['PREV_PICTURE_URL'] = $arFile;
    $arResult['ITEMS'][$arFields['ID']]['DETAIL_PICTURE_URL'] = $arDetalFile;

}

