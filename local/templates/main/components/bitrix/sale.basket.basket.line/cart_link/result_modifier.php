<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//$arResult['CNT_PRODUCT'] = $arResult['NUM_PRODUCTS'];
$arResult['CNT_PRODUCT'] = 0;
foreach ($arResult['CATEGORIES']['READY'] as $arItem) {
    $resElem = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => 4, 'ID' => $arItem['PRODUCT_ID']],
        false,
        false,
        ['ID']
    );

    if ( $arElem = $resElem->Fetch() ){
        $arResult['CNT_PRODUCT'] += $arItem['QUANTITY'];
    }
}
$this->__component->SetResultCacheKeys(['CNT_PRODUCT']);
?>