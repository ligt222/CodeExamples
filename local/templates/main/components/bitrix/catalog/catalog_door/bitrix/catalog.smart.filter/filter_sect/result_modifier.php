<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['FILTER_RESULT'] = [];
//$arResult['FILTER_ELEM_SECT'] = [];

foreach ($arResult['ITEMS'] as $key => $item)
{
//    foreach ($item['VALUES'] as $k => $value)
//    {
//        if ($_REQUEST[$value['CONTROL_ID']] == 'Y')
//        {
//            $arResult['FILTER_ELEM_SECT']['=PROPERTY_'.$key][] = $k;
//        }
//    }

    if ($item['IBLOCK_ID'] == 3)
    {
        $items = [];
        foreach ($item['VALUES'] as $kes => $val)
        {
            $items[] = [
                'name' => $val['CONTROL_NAME'],
                'disabled' => !empty($val['DISABLED']),
                'id' => $val['CONTROL_ID'],
                'value' => $val['HTML_VALUE'],
                'desc' => $val['VALUE'],
//                'cnt' => $val['ELEMENT_COUNT'],
                'checked' => isset($val['CHECKED'])
            ];
        }

        if ($items)
        {
            $arResult['FILTER_RESULT'][] = [
                'NAME' => $item['NAME'],
                'ITEMS' => $items
            ];
        }
    }
}

$this->__component->SetResultCacheKeys(['FILTER_ELEM_SECT', 'FILTER_RESULT']);
