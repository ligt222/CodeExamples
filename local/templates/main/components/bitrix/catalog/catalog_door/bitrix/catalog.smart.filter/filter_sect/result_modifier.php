<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arr = array();
$arrItem = [];
foreach ($arResult['ITEMS'] as $key=>$item)
{
    $i = 0;
    foreach ($item['VALUES'] as $k=>$value) {
        if ($_REQUEST[$value['CONTROL_ID']] == 'Y'){
            $arr['=PROPERTY_'.$key][] = $k;
        }
    $i++;
    }
    if ($item['IBLOCK_ID'] == 3) {

        foreach ($item['VALUES'] as $kes => $val) {

            if ($val['ELEMENT_COUNT'] > 0) {
                $arrItem[$key]['NAME'] = $item['NAME'];
                $arrItem[$key]['ITEMS'][$kes]['name'] = $val['CONTROL_NAME'];
                $arrItem[$key]['ITEMS'][$kes]['id'] = $val['CONTROL_ID'];
                $arrItem[$key]['ITEMS'][$kes]['value'] = $val['HTML_VALUE'];
                $arrItem[$key]['ITEMS'][$kes]['desc'] = $val['VALUE'];
                $arrItem[$key]['ITEMS'][$kes]['cnt'] = $val['ELEMENT_COUNT'];
            }
        }
    }
}

if (!empty($arr)) {
    $arResult['FILTER_RESULT'] = $arrItem;
    $arResult['FILTER_ELEM_SECT'] = $arr;

    $this->__component->SetResultCacheKeys(['FILTER_ELEM_SECT', 'FILTER_RESULT']);
}

