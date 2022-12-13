<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$resSect = CIBlockSection::GetList(
        array(),
    array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'CODE' => $arResult['VARIABLES']['SECTION_CODE']),
    false,
    array('UF_SIZE_MIN', 'UF_SIZE_MAX'),
    false
);
if ($arSect = $resSect->Fetch()){

    $resElement = CIBlockElement::GetList([], ['IBLOCK_ID' => $arSect['IBLOCK_ID'], 'IBLOCK_SECTION_ID' => $arSect['ID']], false, false, ['ID']);
    if ($arElement = $resElement->Fetch()){
        $arResult['ID_FIRST_ELEM'] = $arElement['ID'];
        $arResult['SIZE']['MIN'] = $arSect['UF_SIZE_MIN'];
        $arResult['SIZE']['MAX'] = $arSect['UF_SIZE_MAX'];
    }

}




