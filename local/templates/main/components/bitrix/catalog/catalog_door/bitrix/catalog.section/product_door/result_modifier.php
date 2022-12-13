<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$box_price = 0;

if ( $arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['BOX_NOT_TRESHOLD'] ) {

    if ($resPrice = CPrice::GetBasePrice($arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['BOX_NOT_TRESHOLD']['VALUE'])){
        $box_price = (int)$resPrice['PRICE'];
    }

    $arResult['RESULT'][] = [
        'ID' => $arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['BOX_NOT_TRESHOLD']['VALUE'],
        'PRICE' => $box_price,
    ];
}
if ( $arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['BOX_TRESHOLD'] ) {
    if ($resPrice = CPrice::GetBasePrice($arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['BOX_TRESHOLD']['VALUE'])){
        $box_price = (int)$resPrice['PRICE'];
    }
    $arResult['RESULT'][] = [
        'ID' => $arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['BOX_TRESHOLD']['VALUE'],
        'PRICE' => $box_price,
    ];
}

$arResult['OG_IMAGE'] = ($arResult['UF_OG_IMAGE'] ? CFile::GetPath($arResult['UF_OG_IMAGE']) : false);


$this->__component->SetResultCacheKeys([
    'RESULT',
    'OG_IMAGE'
]);
?>
