<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$skuID = $_REQUEST['sku-id']; // получение по торг. предложению
$itemId = $_REQUEST['id']; // id товара

// Получаем наличие коробок и их id у модели
$resSku = CIBlockElement::GetList(
    ['ID' => 'ASC'],
    ['IBLOCK_ID' => 4, 'ID' => $skuID],
    false,
    false,
    ['ID', 'NAME', 'PROPERTY_COLOR_REF', 'PROPERTY_EXECUTIONS', 'PROPERTY_PATINA', 'PROPERTY_SIZE', 'PROPERTY_KIT', 'PROPERTY_GLAZING']
);
$resProductSku = $resSku->GetNext();
$resKit = CIBlockElement::GetList(
    array(),
    array('IBLOCK_SECTION_ID' => 16, 'PROPERTY_COLOR_REF' => $resProductSku['PROPERTY_COLOR_REF_VALUE']),
    false,
    false,
    array('ID', 'NAME', 'PROPERTY_COLOR_REF')
);


$arResult['BUFFER_FILTERS'] = [];
$jsonFilter = [];
$k = 0;
foreach ($arResult['ITEMS'] as $key => $arItem)
{
    if ($arItem['CODE'] == 'KIT'){
        $i = 0;
        foreach ($arItem['VALUES'] as $id => $arFilter)
        {

            if ( $_REQUEST['kit-id'] == $id ) {
                $jsonFilter[$k]['id'] = $key;
                $jsonFilter[$k]['filters'][$i]['checked'] = true;
                $jsonFilter[$k]['filters'][$i]['desc'] = $arFilter['VALUE'];
                $jsonFilter[$k]['filters'][$i]['id'] = $arFilter['CONTROL_ID'];
                $jsonFilter[$k]['filters'][$i]['image'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['image-style'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['value'] = $arFilter['HTML_VALUE'];

            } else {
                $jsonFilter[$k]['id'] = $key;
                $jsonFilter[$k]['filters'][$i]['checked'] = false;
                $jsonFilter[$k]['filters'][$i]['desc'] = $arFilter['VALUE'];
                $jsonFilter[$k]['filters'][$i]['id'] = $arFilter['CONTROL_ID'];
                $jsonFilter[$k]['filters'][$i]['image'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['image-style'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['value'] = $arFilter['HTML_VALUE'];
            }
            $i++;
        }
    } else {
        $i = 0;
        foreach ($arItem['VALUES'] as $id => $arFilter)
        {

            if ( $resProductSku['PROPERTY_' . $arItem['CODE'] . '_VALUE'] == $id ) {
                $jsonFilter[$k]['id'] = $key;
                $jsonFilter[$k]['filters'][$i]['checked'] = true;
                $jsonFilter[$k]['filters'][$i]['desc'] = $arFilter['VALUE'];
                $jsonFilter[$k]['filters'][$i]['id'] = $arFilter['CONTROL_ID'];
                $jsonFilter[$k]['filters'][$i]['image'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['image-style'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['value'] = $arFilter['HTML_VALUE'];

            } else {
                $jsonFilter[$k]['id'] = $key;
                $jsonFilter[$k]['filters'][$i]['checked'] = false;
                $jsonFilter[$k]['filters'][$i]['desc'] = $arFilter['VALUE'];
                $jsonFilter[$k]['filters'][$i]['id'] = $arFilter['CONTROL_ID'];
                $jsonFilter[$k]['filters'][$i]['image'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['image-style'] = $arFilter['FILE']['SRC'];
                $jsonFilter[$k]['filters'][$i]['value'] = $arFilter['HTML_VALUE'];
            }
            $i++;
        }
    }

    $k++;
}
//$arResult['BUFFER_FILTERS']['TEST3'] = $arResult;
$arResult['RESULT_FILTER'] = $jsonFilter;
$this->__component->SetResultCacheKeys(['RESULT_FILTER']);
?>