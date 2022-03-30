<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$resultProduct = [];
$arElemnts = [];
//if ($_GET['edit'] == 'Y'){
    $resProduct = CIBlockElement::GetByID($_REQUEST['sku-id']);
    if ($obProduct = $resProduct->GetNextElement()){
        $el = $obProduct->GetFields();
        $prop = $obProduct->GetProperties();
        $cmLink = '';
        $color = '';
        $exec = '';
        $patina = '';
        $size = '';
        $galzing = '';
        $resultProduct = [
            'color' => $prop['COLOR_REF']['VALUE'],
            'executions' => $prop['EXECUTIONS']['VALUE'],
            'patina' => $prop['PATINA']['VALUE'],
            'size' => $prop['SIZE']['VALUE'],
            'glazing' => $prop['GLAZING']['VALUE']
        ];
    }
//}
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

if (!empty($resultProduct) || !empty($arElemnts)) {
    $arResult['RESULT_FILTER'] = $resultProduct;
    $arResult['SKU_RESULT'] = $arElemnts;
    $this->__component->SetResultCacheKeys(['RESULT_FILTER', 'SKU_RESULT']);
}