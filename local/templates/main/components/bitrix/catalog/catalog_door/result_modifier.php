<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$resSect = CIBlockSection::GetList(
        array(),
    array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE']),
    false,
    array('UF_SIZE_MIN', 'UF_SIZE_MAX'),
    false
);
if ($arSect = $resSect->Fetch()){
    $arResult['SIZE']['MIN'] = $arSect['UF_SIZE_MIN'];
    $arResult['SIZE']['MAX'] = $arSect['UF_SIZE_MAX'];
}
?>



