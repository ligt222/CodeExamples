<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arr = array();
$arrItem = [];
$arElemnts = [];

$resSku = CIBlockElement::GetList(
    array('ID' => 'ASC'),
    array(
        'IBLOCK_ID' => 4,
        'PROPERTY_CML2_LINK' => 558,
        'PROPERTY_COLOR_REF' => '',
        'PROPERTY_EXECUTIONS' => '',
        'PROPERTY_PATINA' => '',
        'PROPERTY_SIZE' => '',
        'PROPERTY_GLAZING' => ''
    ),
    false,
    false,
    array()
);
if ($obSku = $resSku->GetNextElement()){
    $el = $obSku->GetFields();
    $prop = $obSku->GetProperties();
    if ($resPrice = CPrice::GetBasePrice($el['ID'])){
        $arElemnts['price'] = (int)$resPrice['PRICE'];
    }
    $arElemnts['img'] = CFile::GetPath($el['PREVIEW_PICTURE']);

}


foreach ($arResult['ITEMS'] as $key=>$item)
{
    if ($item['IBLOCK_ID'] == 4) {

        foreach ($item['VALUES'] as $kes => $val) {


            if ($val['ELEMENT_COUNT'] > 0) {
                $arrItem[$key]['NAME'] = $item['NAME'];
                $arrItem[$key]['ITEMS'][$kes]['name'] = $val['CONTROL_NAME'];
                $arrItem[$key]['ITEMS'][$kes]['id'] = $val['CONTROL_ID'];
                $arrItem[$key]['ITEMS'][$kes]['value'] = $val['HTML_VALUE'];
                $arrItem[$key]['ITEMS'][$kes]['desc'] = $val['VALUE'];
                //$arrItem[$key]['ITEMS'][$kes]['cnt'] = $val['ELEMENT_COUNT'];
            }
        }
    }
}

if (!empty($arrItem)) {
    $arResult['FILTER_RESULT'] = $arrItem;
    $arResult['SKU_RESULT'] = $arElemnts;

    $this->__component->SetResultCacheKeys(['FILTER_RESULT', 'SKU_RESULT']);
}